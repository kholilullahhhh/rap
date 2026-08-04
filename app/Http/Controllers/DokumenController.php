<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Folder;
use App\Models\JenisUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    protected $menu;

    public function __construct()
    {
        $this->menu = 'dokumen';
    }

    /**
     * Query folder yang dapat diakses user berdasarkan role.
     * Logika sama seperti dokumen: admin/kepala_kantor melihat semua folder
     * (opsional difilter per role), role lain hanya melihat foldernya sendiri.
     */
    private function foldersQuery()
    {
        $user = Auth::user();
        $query = Folder::query();

        if (in_array($user->role, ['admin', 'kepala_kantor'], true)) {
            $filterRole = request()->get('role');
            if ($filterRole && $filterRole !== 'all') {
                $query->whereHas('user', function ($q) use ($filterRole) {
                    $q->where('role', $filterRole);
                });
            }
        } else {
            $query->where('user_id', $user->id);
        }

        return $query;
    }

    /**
     * Terapkan filter visibilitas dokumen sesuai role.
     * Dipakai untuk daftar dokumen dan penghitungan jumlah dokumen per folder.
     */
    private function applyDocVisibility($query)
    {
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'kepala_kantor'], true)) {
            $filterRole = request()->get('role');
            if ($filterRole && $filterRole !== 'all') {
                $query->whereHas('user', function ($q) use ($filterRole) {
                    $q->where('role', $filterRole);
                });
            }
        } else {
            $query->where('user_id', $user->id);
        }

        return $query;
    }

    public function index(Request $request)
    {
        $menu = $this->menu;
        $user = Auth::user();
        $kategori = JenisUsaha::all();

        // Filter
        $filterRole = $request->get('role');
        $folderId = $request->get('folder');

        // Current folder (hanya jika dapat diakses user sesuai role)
        $currentFolder = null;
        if ($folderId) {
            $currentFolder = $this->foldersQuery()->find($folderId);
        }

        // Query dasar dokumen
        $query = Dokumen::with(['kategori', 'user', 'folder']);

        // Filter dokumen berdasarkan role user
        $this->applyDocVisibility($query);

        // Filter berdasarkan folder
        if ($currentFolder) {
            $query->where('folder_id', $currentFolder->id);
        }

        $datas = $query->latest()->get();

        // Folder sesuai role, jumlah dokumen dihitung dari dokumen yang terlihat role tsb
        $folders = $this->foldersQuery()
            ->withCount(['dokumen' => function ($q) {
                $this->applyDocVisibility($q);
            }])
            ->latest()
            ->get();

        /*
    |--------------------------------------------------------------------------
    | View Berdasarkan Role
    |--------------------------------------------------------------------------
    */
        $view = match ($user->role) {
            'admin', 'kepala_kantor' => 'pages.admin.umkm.index',
            'inteldaktim' => 'pages.admin.umkm.inteldaktim',
            'verdokjal' => 'pages.admin.umkm.verdokjal',
            'tu' => 'pages.admin.umkm.tu',
            default => abort(403),
        };

        return view($view, compact(
            'datas',
            'user',
            'menu',
            'kategori',
            'filterRole',
            'folders',
            'currentFolder'
        ));
    }

    public function viewFile($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $this->authorize('view', $dokumen);

        if (! $dokumen->file_path) {
            abort(404);
        }

        $path = storage_path('app/public/'.$dokumen->file_path);

        if (! file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    // ===== FOLDER METHODS =====

    /**
     * Store a new folder
     */
    public function storeFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:folders,name,NULL,id,user_id,'.Auth::id(),
            'color' => 'nullable|integer|min:1|max:8',
        ]);

        $folder = Folder::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'color' => $request->color ?? 1,
        ]);

        return redirect()->back()->with('folder_success', 'Folder "'.$folder->name.'" berhasil dibuat');
    }

    /**
     * Update a folder
     */
    public function updateFolder(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);

        $this->authorize('update', $folder);

        $request->validate([
            'name' => 'required|string|max:100|unique:folders,name,'.$id.',id,user_id,'.Auth::id(),
            'color' => 'nullable|integer|min:1|max:8',
        ]);

        $folder->update([
            'name' => $request->name,
            'color' => $request->color ?? $folder->color,
        ]);

        return redirect()->back()->with('message', 'Folder "'.$folder->name.'" berhasil diupdate');
    }

    /**
     * Delete a folder
     */
    public function deleteFolder($id)
    {
        $folder = Folder::findOrFail($id);

        $this->authorize('delete', $folder);

        // Pindahkan dokumen ke root (folder_id = null)
        Dokumen::where('folder_id', $id)->update(['folder_id' => null]);

        $folderName = $folder->name;
        $folder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Folder "'.$folderName.'" berhasil dihapus',
        ]);
    }

    /**
     * Move document to another folder
     */
    public function moveDocument(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $this->authorize('update', $dokumen);

        $request->validate([
            'folder_id' => 'nullable|exists:folders,id',
            'remove_from_folder' => 'nullable|boolean',
        ]);

        if ($request->has('remove_from_folder') && $request->remove_from_folder) {
            $dokumen->folder_id = null;
        } else {
            // Pastikan folder tujuan dapat diakses user (sesuai role)
            if ($request->filled('folder_id')) {
                $folder = $this->foldersQuery()->find($request->folder_id);

                if (! $folder) {
                    return back()->withErrors(['folder_id' => 'Folder tidak valid.'])->withInput();
                }
            }

            $dokumen->folder_id = $request->folder_id;
        }

        $dokumen->save();

        $folderName = $dokumen->folder ? $dokumen->folder->name : 'Root';

        return redirect()->back()->with('message', 'Dokumen berhasil dipindahkan ke "'.$folderName.'"');
    }

    // ===== DOKUMEN CRUD METHODS =====

    /**
     * Show form create dokumen
     */
    public function create(Request $request)
    {
        $menu = $this->menu;
        $kategori = JenisUsaha::all();
        $folders = $this->foldersQuery()->get();

        // Folder yang sedang dipilih (dari query "folder" atau input yang gagal validasi)
        $selectedFolder = $request->query('folder', old('folder_id'));

        return view('pages.admin.umkm.create', compact('menu', 'kategori', 'folders', 'selectedFolder'));
    }

    /**
     * Store new dokumen
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:jenis_usahas,id',
            // 'nomor_dokumen' => 'required|string|unique:dokumens',
            'judul' => 'required|string|max:255',
            // 'deskripsi' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal_dokumen' => 'required|date',
            // 'versi' => 'nullable|string|max:20',
            // 'status' => 'nullable|in:draft,review,approved,obsolete',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        // Pastikan folder yang dipilih dapat diakses user yang sedang login
        if ($request->filled('folder_id')) {
            $folder = $this->foldersQuery()->find($request->folder_id);

            if (! $folder) {
                return back()->withInput()->withErrors(['folder_id' => 'Folder tidak valid.']);
            }
        }

        // Upload file
        $file = $request->file('file_path');
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs('dokumen', $fileName, 'public');

        Dokumen::create([
            'kategori_id' => $request->kategori_id,
            'user_id' => Auth::id(),
            'folder_id' => $request->folder_id,
            'nomor_dokumen' => $request->nomor_dokumen,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'versi' => $request->versi ?? '1.0',
            'status' => $request->status ?? 'draft',
        ]);

        return redirect()->route('umkm.index')->with('message', 'Dokumen berhasil ditambahkan');
    }

    /**
     * Show form edit dokumen
     */
    public function edit($id)
    {
        $menu = $this->menu;
        $data = Dokumen::findOrFail($id);

        $this->authorize('update', $data);

        $kategori = JenisUsaha::all();
        $folders = $this->foldersQuery()->get();

        return view('pages.admin.umkm.edit', compact('menu', 'data', 'kategori', 'folders'));
    }

    /**
     * Update dokumen
     */
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $this->authorize('update', $dokumen);

        $request->validate([
            'kategori_id' => 'required|exists:jenis_usahas,id',
            // 'nomor_dokumen' => 'required|string|unique:dokumens,nomor_dokumen,' . $id,
            'judul' => 'required|string|max:255',
            // 'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal_dokumen' => 'required|date',
            // 'versi' => 'nullable|string|max:20',
            // 'status' => 'nullable|in:draft,review,approved,obsolete',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $data = $request->except('file_path');

        // Pastikan folder tujuan dapat diakses user (jika folder diubah)
        if ($request->filled('folder_id')) {
            $folder = $this->foldersQuery()->find($request->folder_id);

            if (! $folder) {
                return back()->withErrors(['folder_id' => 'Folder tidak valid.'])->withInput();
            }
        }

        $data['folder_id'] = $request->filled('folder_id') ? $request->folder_id : null;

        // Upload file baru jika ada
        if ($request->hasFile('file_path')) {
            // Hapus file lama
            if ($dokumen->file_path) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file_path');
            $fileName = time().'_'.$file->getClientOriginalName();
            $data['file_path'] = $file->storeAs('dokumen', $fileName, 'public');
        }

        $dokumen->update($data);

        return redirect()->route('umkm.index')->with('message', 'Dokumen berhasil diupdate');
    }

    /**
     * Delete dokumen
     */
    public function destroy(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // AJAX dari jQuery selalu mengirim X-Requested-With; pengujian/API
        // biasanya memakai Accept: application/json.
        $isAjax = $request->ajax() || $request->wantsJson();

        // Admin & Kepala Kantor boleh menghapus semua dokumen, selain itu hanya miliknya.
        $user = Auth::user();
        $canManage = $user && in_array($user->role, ['admin', 'kepala_kantor'], true);
        if (! $canManage && (! $user || (int) $user->id !== (int) $dokumen->user_id)) {
            return $isAjax
                ? response()->json(['success' => false, 'message' => 'Anda tidak berhak menghapus dokumen ini.'], 403)
                : abort(403);
        }

        // Delete file if exists
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        if ($isAjax) {
            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil dihapus',
            ]);
        }

        return redirect()->back()->with('message', 'Dokumen berhasil dihapus');
    }
}
