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

    public function index(Request $request)
    {
        $menu = $this->menu;
        $user = Auth::user();
        $kategori = JenisUsaha::all();

        // Ambil parameter filter
        $filterRole = $request->get('role');
        $folderId = $request->get('folder');

        // Query dasar
        $query = Dokumen::with(['kategori', 'user', 'folder']);

        // Filter berdasarkan role user
        if (in_array($user->role, ['admin', 'kepala_kantor'])) {
            if ($filterRole && $filterRole != 'all') {
                $query->whereHas('user', function ($q) use ($filterRole) {
                    $q->where('role', $filterRole);
                });
            }
            // Admin dan Kepala Kantor melihat semua
        } else {
            // User lain hanya melihat dokumen miliknya
            $query->where('user_id', $user->id);
        }

        // Filter berdasarkan folder
        if ($folderId) {
            $query->where('folder_id', $folderId);
        }

        // Ambil data
        $datas = $query->latest()->get();

        // Ambil folder untuk user
        $folders = Folder::where('user_id', $user->id)
                        ->withCount('dokumen')
                        ->get();

        // Current folder
        $currentFolder = null;
        if ($folderId) {
            $currentFolder = Folder::find($folderId);
        }

        // Menentukan view berdasarkan role
        $view = match ($user->role) {
            'admin', 'kepala_kantor' => 'pages.admin.umkm.index',
            'inteldaktim' => 'pages.admin.umkm.inteldaktim',
            'user' => 'pages.admin.umkm.user',
            default => abort(403),
        };

        return view($view, compact(
            'datas',
            'menu',
            'kategori',
            'filterRole',
            'folders',
            'currentFolder'
        ));
    }

    // ===== FOLDER METHODS =====

    /**
     * Store a new folder
     */
    public function storeFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:folders,name,NULL,id,user_id,' . Auth::id(),
            'color' => 'nullable|integer|min:1|max:8',
        ]);

        $folder = Folder::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'color' => $request->color ?? 1,
        ]);

        return redirect()->back()->with('folder_success', 'Folder "' . $folder->name . '" berhasil dibuat');
    }

    /**
     * Update a folder
     */
    public function updateFolder(Request $request, $id)
    {
        $folder = Folder::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:folders,name,' . $id . ',id,user_id,' . Auth::id(),
            'color' => 'nullable|integer|min:1|max:8',
        ]);

        $folder->update([
            'name' => $request->name,
            'color' => $request->color ?? $folder->color,
        ]);

        return redirect()->back()->with('message', 'Folder "' . $folder->name . '" berhasil diupdate');
    }

    /**
     * Delete a folder
     */
    public function deleteFolder($id)
    {
        $folder = Folder::where('user_id', Auth::id())->findOrFail($id);

        // Pindahkan dokumen ke root (folder_id = null)
        Dokumen::where('folder_id', $id)->update(['folder_id' => null]);

        $folderName = $folder->name;
        $folder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Folder "' . $folderName . '" berhasil dihapus'
        ]);
    }

    /**
     * Move document to another folder
     */
    public function moveDocument(Request $request, $id)
    {
        $dokumen = Dokumen::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'folder_id' => 'nullable|exists:folders,id',
            'remove_from_folder' => 'nullable|boolean',
        ]);

        if ($request->has('remove_from_folder') && $request->remove_from_folder) {
            $dokumen->folder_id = null;
        } else {
            $dokumen->folder_id = $request->folder_id;
        }

        $dokumen->save();

        $folderName = $dokumen->folder ? $dokumen->folder->name : 'Root';
        return redirect()->back()->with('message', 'Dokumen berhasil dipindahkan ke "' . $folderName . '"');
    }

    // ===== DOKUMEN CRUD METHODS =====

    /**
     * Show form create dokumen
     */
    public function create()
    {
        $menu = $this->menu;
        $kategori = JenisUsaha::all();
        $folders = Folder::where('user_id', Auth::id())->get();

        return view('pages.admin.umkm.create', compact('menu', 'kategori', 'folders'));
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

        // Upload file
        $file = $request->file('file_path');
        $fileName = time() . '_' . $file->getClientOriginalName();
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
        $dokumen = Dokumen::where('user_id', Auth::id())->findOrFail($id);
        $kategori = JenisUsaha::all();
        $folders = Folder::where('user_id', Auth::id())->get();

        return view('pages.admin.umkm.edit', compact('menu', 'dokumen', 'kategori', 'folders'));
    }

    /**
     * Update dokumen
     */
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:jenis_usahas,id',
            'nomor_dokumen' => 'required|string|unique:dokumens,nomor_dokumen,' . $id,
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal_dokumen' => 'required|date',
            'versi' => 'nullable|string|max:20',
            'status' => 'nullable|in:draft,review,approved,obsolete',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $data = $request->except('file_path');

        // Upload file baru jika ada
        if ($request->hasFile('file_path')) {
            // Hapus file lama
            if ($dokumen->file_path) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $data['file_path'] = $file->storeAs('dokumen', $fileName, 'public');
        }

        $dokumen->update($data);

        return redirect()->route('umkm.index')->with('message', 'Dokumen berhasil diupdate');
    }

    /**
     * Delete dokumen
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::where('user_id', Auth::id())->findOrFail($id);

        // Hapus file
        if ($dokumen->file_path) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }
}