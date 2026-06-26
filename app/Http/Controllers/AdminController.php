<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\JenisUsaha;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $selectedYear = $request->year ?? date('Y');

        // ========== DATA DOKUMEN ==========
        $totalDokumen = Dokumen::count();
        
        // Dokumen berdasarkan status
        $dokumenAktif = Dokumen::where('status', 'aktif')->count();
        $dokumenPending = Dokumen::where('status', 'pending')->count();
        $dokumenArsip = Dokumen::where('status', 'arsip')->count();

        // Dokumen baru bulan ini
        $dokumenBaru = Dokumen::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // Dokumen revisi (versi > 1)
        $dokumenRevisi = Dokumen::where('versi', '>', 1)->count();

        // Total versi dokumen
        $totalVersi = Dokumen::sum('versi');

        // ========== DATA KATEGORI ==========
        $totalKategori = JenisUsaha::count();
        $kategoriAktif = JenisUsaha::count();

        // Top 5 kategori dengan dokumen terbanyak
        $topKategori = JenisUsaha::withCount('dokumen')
            ->orderBy('dokumen_count', 'desc')
            ->take(5)
            ->get();

        // ========== DATA PENGGUNA ==========
        $totalUsers = User::count();
        $userBaru = User::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // Top 5 pengguna dengan dokumen terbanyak
        $topUsers = User::withCount('dokumen')
            ->orderBy('dokumen_count', 'desc')
            ->take(5)
            ->get();

        // ========== CHART DATA ==========
        // Monthly upload trend
        $monthlyUploads = [];
        $monthLabels = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create($selectedYear, $i, 1);
            $monthLabels[] = $month->format('M');
            
            $count = Dokumen::whereYear('created_at', $selectedYear)
                ->whereMonth('created_at', $i)
                ->count();
            $monthlyUploads[] = $count;
        }

        // Category distribution
        $categoryData = [];
        $categoryLabels = [];
        $categories = JenisUsaha::withCount('dokumen')
            ->orderBy('dokumen_count', 'desc')
            ->take(8)
            ->get();
        
        foreach ($categories as $category) {
            $categoryLabels[] = $category->nama;
            $categoryData[] = $category->dokumen_count;
        }

        // Top users data for chart
        $topUsersData = [];
        $topUsersLabels = [];
        $topUsersList = User::withCount('dokumen')
            ->orderBy('dokumen_count', 'desc')
            ->take(5)
            ->get();
        
        foreach ($topUsersList as $user) {
            $topUsersLabels[] = $user->name;
            $topUsersData[] = $user->dokumen_count;
        }

        // Version distribution
        $versionData = [];
        $versionLabels = [];
        $versionGroups = Dokumen::selectRaw('versi, count(*) as total')
            ->groupBy('versi')
            ->orderBy('versi')
            ->get();
        
        foreach ($versionGroups as $group) {
            $versionLabels[] = 'v' . $group->versi;
            $versionData[] = $group->total;
        }

        // Monthly statistics
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthName = $month->format('M Y');
            
            $uploads = Dokumen::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            
            $revisions = Dokumen::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('versi', '>', 1)
                ->count();
            
            $monthlyStats[] = [
                'month' => $monthName,
                'uploads' => $uploads,
                'revisions' => $revisions,
                'total' => $uploads + $revisions
            ];
        }

        // Activity statistics
        $uploadBulanIni = Dokumen::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // Recent documents
        $recentDocuments = Dokumen::with(['kategori', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('pages.admin.dashboard.index', [
            'menu' => 'dashboard',
            
            // Document data
            'totalDokumen' => $totalDokumen,
            'dokumenAktif' => $dokumenAktif,
            'dokumenPending' => $dokumenPending,
            'dokumenArsip' => $dokumenArsip,
            'dokumenBaru' => $dokumenBaru,
            'dokumenRevisi' => $dokumenRevisi,
            'totalVersi' => $totalVersi,
            
            // Category data
            'totalKategori' => $totalKategori,
            'kategoriAktif' => $kategoriAktif,
            'topKategori' => $topKategori,
            
            // User data
            'totalUsers' => $totalUsers,
            'userBaru' => $userBaru,
            
            // Chart data
            'monthlyUploads' => $monthlyUploads,
            'monthLabels' => $monthLabels,
            'categoryData' => $categoryData,
            'categoryLabels' => $categoryLabels,
            'topUsersData' => $topUsersData,
            'topUsersLabels' => $topUsersLabels,
            'versionData' => $versionData,
            'versionLabels' => $versionLabels,
            'monthlyStats' => $monthlyStats,
            
            // Activity data
            'uploadBulanIni' => $uploadBulanIni,
            'downloadBulanIni' => rand(50, 200), // Placeholder
            'viewBulanIni' => rand(100, 500), // Placeholder
            
            // Recent data
            'recentDocuments' => $recentDocuments,
            
            // Filter
            'selectedYear' => $selectedYear
        ]);
    }
}