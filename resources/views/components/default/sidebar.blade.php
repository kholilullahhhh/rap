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

            <!-- MASTER DATA (untuk admin & kepala_kantor) -->
            @if($hasMasterData)
                <li class="nav-item dropdown {{ $menu == 'dokumen' || $menu == 'jenis_usaha' || $menu == 'pembinaan' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-sitemap"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Dokumen dengan 3 sub-menu berdasarkan role penginput -->
                        <li class="{{ $menu == 'dokumen' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('umkm.index') }}?role=all">
                                 Semua Dokumen
                            </a>
                        </li>
                        <li class="{{ $menu == 'dokumen_user' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('umkm.index') }}?role=user">
                                 Tata Usaha
                            </a>
                        </li>
                        <li class="{{ $menu == 'dokumen_user' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('umkm.index') }}?role=user">
                                 Pelayanan & Verdokjal
                            </a>
                        </li>
                        <li class="{{ $menu == 'dokumen_inteldaktim' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('umkm.index') }}?role=inteldaktim">
                                 Inteldaktim
                            </a>
                        </li>
                       
                    </ul>
                     @if($showKategori)
                            <li class="{{ $menu == 'jenis_usaha' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('jenis_usaha.index') }}">
                                    <i class="fas fa-tags"></i> Kategori Dokumen
                                </a>
                            </li>
                        @endif
                        @if($showKegiatan)
                            <li class="{{ $menu == 'pembinaan' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('pembinaan.index') }}">
                                    <i class="fas fa-calendar-alt"></i> Kegiatan
                                </a>
                            </li>
                        @endif
                </li>
            @endif

            <!-- MENU DOKUMEN UNTUK USER (hanya lihat dokumen user) -->
            @if($role == 'user')
                <li class="nav-item {{ $menu == 'dokumen' ? 'active' : '' }}">
                    <a href="{{ route('umkm.index') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span>Dokumen</span>
                    </a>
                </li>
            @endif

            <!-- MENU DOKUMEN UNTUK INTELDAKTIM (hanya lihat dokumen inteldaktim) -->
            @if($role == 'inteldaktim')
                <li class="nav-item {{ $menu == 'dokumen' ? 'active' : '' }}">
                    <a href="{{ route('umkm.index') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span>Dokumen</span>
                    </a>
                </li>
                <!-- Kegiatan untuk inteldaktim -->
                <li class="nav-item {{ $menu == 'pembinaan' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pembinaan.index') }}">
                        <i class="fas fa-calendar-alt"></i> 
                        <span>Kegiatan</span>
                    </a>
                </li>
            @endif

            <!-- DATA AKUN (khusus admin) -->
            @if($showAkun)
                <li class="nav-item {{ $menu == 'akun' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akun.index') }}">
                        <i class="fas fa-users-cog"></i> 
                        <span>Data Akun</span>
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