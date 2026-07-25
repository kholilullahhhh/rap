<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">IMIGRASI BANTAENG</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">BOSS</a>
        </div>

        <ul class="sidebar-menu">

            <!-- DASHBOARD -->
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            @php
                $role = session('role');
                $hasMasterData = in_array($role, ['admin', 'kepala_kantor']);
                $showDokumen = in_array($role, ['admin', 'user', 'inteldaktim', 'kepala_kantor']);
                $showKegiatan = in_array($role, ['admin', 'inteldaktim', 'kepala_kantor']);
                $showKategori = in_array($role, ['admin', 'kepala_kantor']);
                $showAkun = ($role == 'admin');
            @endphp

            <!-- MASTER DATA -->
            @if($hasMasterData)
                <li class="nav-item dropdown {{ $menu == 'dokumen' || $menu == 'jenis_usaha' || $menu == 'pembinaan' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-sitemap"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="dropdown-menu">
                        @if($showDokumen)
                            <li class="{{ $menu == 'dokumen' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('umkm.index') }}">Dokumen</a>
                            </li>
                        @endif
                        @if($showKategori)
                            <li class="{{ $menu == 'jenis_usaha' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('jenis_usaha.index') }}">Kategori Dokumen</a>
                            </li>
                        @endif
                        @if($showKegiatan)
                            <li class="{{ $menu == 'pembinaan' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('pembinaan.index') }}">Kegiatan</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- DOKUMEN (untuk user & inteldaktim tanpa master data) -->
            @if($showDokumen && !$hasMasterData)
                <li class="{{ $menu == 'dokumen' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('umkm.index') }}">
                        <i class="fas fa-file-alt"></i> <span>Dokumen</span>
                    </a>
                </li>
            @endif

            <!-- KEGIATAN (untuk inteldaktim tanpa master data) -->
            @if($showKegiatan && $role == 'inteldaktim' && !$hasMasterData)
                <li class="{{ $menu == 'pembinaan' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pembinaan.index') }}">
                        <i class="fas fa-calendar-alt"></i> <span>Kegiatan</span>
                    </a>
                </li>
            @endif

            <!-- DATA AKUN (khusus admin) -->
            @if($showAkun)
                <li class="{{ $menu == 'akun' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akun.index') }}">
                        <i class="fas fa-users-cog"></i> <span>Data Akun</span>
                    </a>
                </li>
            @endif

            <!-- LANDING PAGE -->
            <li class="menu-header">Landing Page</li>

        </ul>

        <!-- LOGOUT BUTTON -->
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>