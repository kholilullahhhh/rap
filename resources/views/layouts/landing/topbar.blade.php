    <!-- Header start -->
    <header id="header" class="header-one">
        <!-- Logo Area -->
        <div class="bg-white" style="background: #ffffff !important; border-bottom: 1px solid rgba(0,0,0,0.04);">
            <div class="container">
                <div style="padding:15px 0;" class="logo-area">
                    <div class="row align-items-center">
                        <!-- Logo Section - 2 Logo Berdampingan -->
                        <div class="col-lg-2 col-md-12 text-center text-lg-left mb-3 mb-md-4 mb-lg-0">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-start gap-4"
                                style="gap: 1rem;">
                                <!-- Logo 1 -->
                                <a class="d-block" href="/">
                                    <img style="width: auto; height: 70px;"
                                        src="{{ asset('landing/images/footer/rapp.png') }}" alt="RAP Kementerian">
                                </a>
                                <!-- Divider -->
                                <div style="width: 1px; height: 50px; background: rgba(0,0,0,0.08);"></div>
                                <!-- Logo 2 -->
                                <a class="d-block" href="/">
                                    <img style="width: auto; height: 70px;"
                                        src="{{ asset('landing/images/footer/logoimig.png') }}" alt="RAP Kementerian">
                                </a>
                            </div>
                        </div><!-- logo end -->

                        <!-- Info Box -->
                        <div class="col-lg-10 col-md-12">
                            <ul class="top-info-box"
                                style="list-style: none; padding: 0; margin: 0; display: flex; align-items: center; justify-content: flex-end; gap: 1rem; flex-wrap: wrap;">
                                <li>
                                    <div class="info-box" style="display: flex; align-items: center; gap: 0.8rem;">
                                        <div
                                            style="width: 40px; height: 40px; border-radius: 50%; background: rgba(11,31,58,0.06); display: flex; align-items: center; justify-content: center; color: #123E73; font-size: 1rem;">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <p class="info-box-title"
                                                style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6C757D; margin: 0;">
                                                Hubungi</p>
                                            <p class="info-box-subtitle"
                                                style="font-size: 0.95rem; font-weight: 600; color: #0B1F3A; margin: 0;">
                                                (0411) 0889 0992 009</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="last">
                                    <div class="info-box last" style="display: flex; align-items: center; gap: 0.8rem;">
                                        <div
                                            style="width: 40px; height: 40px; border-radius: 50%; background: rgba(11,31,58,0.06); display: flex; align-items: center; justify-content: center; color: #123E73; font-size: 1rem;">
                                            <i class="fab fa-instagram"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <p class="info-box-title"
                                                style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6C757D; margin: 0;">
                                                Instagram
                                            </p>
                                            <p class="info-box-subtitle"
                                                style="font-size: 0.95rem; font-weight: 600; color: #0B1F3A; margin: 0;">
                                                <a href="https://www.instagram.com/imigrasi_bantaeng_/" target="_blank"
                                                    style="color: inherit; text-decoration: none;">
                                                    @imigrasi_bantaeng_

                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-box" style="display: flex; align-items: center; gap: 0.8rem;">
                                        <div
                                            style="width: 40px; height: 40px; border-radius: 50%; background: rgba(11,31,58,0.06); display: flex; align-items: center; justify-content: center; color: #123E73; font-size: 1rem;">
                                            <i class="fas fa-globe"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <p class="info-box-title"
                                                style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6C757D; margin: 0;">
                                                Website
                                            </p>
                                            <p class="info-box-subtitle"
                                                style="font-size: 0.95rem; font-weight: 600; color: #0B1F3A; margin: 0;">
                                                <a href="https://bantaeng.imigrasi.go.id" target="_blank"
                                                    style="color: inherit; text-decoration: none;">
                                                    bantaeng.imigrasi.go.id
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- header right end -->
                    </div><!-- logo area end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div>

        <!-- Navigation with Gradient -->
        <div class="site-navigation" 
            style="background: linear-gradient(135deg, #0B1F3A 0%, #123E73 50%, #1E5AA8 100%); border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 position-relative">
                        <nav class="navbar navbar-expand-lg navbar-dark p-0"
                            style="background: transparent !important;">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                aria-label="Toggle navigation"
                                style="border-color: rgba(255,255,255,0.2); padding: 0.5rem 0.8rem;">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div id="navbar-collapse" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav mr-auto" style="display: flex; flex-wrap: wrap; gap: 0.2rem;">
                                    <li class="nav-item {{ $menu == 'profil' ? 'active' : '' }}">
                                        <a class="nav-link" href="/"
                                            style="color: rgba(255,255,255,0.8); font-weight: 500; padding: 0.8rem 1.2rem; transition: all 0.3s ease; border-radius: 8px; font-size: 0.85rem;">
                                            <i class="fas fa-home"
                                                style="margin-right: 0.4rem; font-size: 0.75rem;"></i> Profil
                                        </a>
                                    </li>

                                    <li class="nav-item {{ $menu == 'kontak' ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('user.kontak') }}"
                                            style="color: rgba(255,255,255,0.8); font-weight: 500; padding: 0.8rem 1.2rem; transition: all 0.3s ease; border-radius: 8px; font-size: 0.85rem;">
                                            <i class="fas fa-phone"
                                                style="margin-right: 0.4rem; font-size: 0.75rem;"></i> Kontak
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}"
                                            style="color: rgba(255,255,255,0.8); font-weight: 500; padding: 0.8rem 1.2rem; transition: all 0.3s ease; border-radius: 8px; font-size: 0.85rem;">
                                            <i class="fas fa-sign-in-alt"
                                                style="margin-right: 0.4rem; font-size: 0.75rem;"></i> Login
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Search Button -->
                            <div class="nav-search" style="margin-left: 1rem;">
                                <span id="search"
                                    style="color: rgba(255,255,255,0.6); cursor: pointer; transition: all 0.3s ease; padding: 0.5rem;">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </nav>
                    </div>
                    <!--/ Col end -->
                </div>
                <!--/ Row end -->

                <div class="search-block"
                    style="display: none; position: absolute; right: 0; top: 100%; background: #ffffff; padding: 1rem; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); width: 300px; z-index: 1000;">
                    <label for="search-field" class="w-100 mb-0" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" id="search-field"
                            placeholder="Type what you want and enter"
                            style="border-radius: 8px; border: 1px solid #e0e0e0; padding: 0.6rem 1rem;">
                    </label>
                    <span class="search-close"
                        style="position: absolute; top: 0.5rem; right: 1rem; cursor: pointer; color: #6C757D; font-size: 1.2rem;">&times;</span>
                </div><!-- Site search end -->
            </div>
            <!--/ Container end -->
        </div>
        <!--/ Navigation end -->
    </header>
    <!--/ Header end -->

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/components/landing/topbar.css') }}">
    @endpush

    @push('scripts')
        <script>
            // ============================================================
            // SEARCH TOGGLE
            // ============================================================
            document.addEventListener('DOMContentLoaded', function() {
                const searchBtn = document.getElementById('search');
                const searchBlock = document.querySelector('.search-block');
                const searchClose = document.querySelector('.search-close');

                if (searchBtn && searchBlock) {
                    searchBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const isVisible = searchBlock.style.display === 'block';
                        searchBlock.style.display = isVisible ? 'none' : 'block';
                        if (!isVisible) {
                            const input = searchBlock.querySelector('#search-field');
                            if (input) setTimeout(() => input.focus(), 100);
                        }
                    });

                    if (searchClose) {
                        searchClose.addEventListener('click', function() {
                            searchBlock.style.display = 'none';
                        });
                    }

                    document.addEventListener('click', function(e) {
                        if (!searchBlock.contains(e.target) && e.target !== searchBtn && !searchBtn.contains(e
                                .target)) {
                            searchBlock.style.display = 'none';
                        }
                    });
                }
            });
        </script>
    @endpush
