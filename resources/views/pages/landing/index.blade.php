@extends('layouts.landing.app')

@section('content')
    @push('styles')
        <style>
            /* ===== ROOT VARIABLES ===== */
            :root {
                --navy-dark: #0B1F3A;
                --navy-medium: #123E73;
                --navy-light: #1E5AA8;
                --navy-gradient: linear-gradient(135deg, #0B1F3A 0%, #123E73 50%, #1E5AA8 100%);
                --white: #FFFFFF;
                --light-gray: #F8F9FA;
                --gray: #6C757D;
                --shadow-sm: 0 2px 12px rgba(11, 31, 58, 0.06);
                --shadow-md: 0 4px 24px rgba(11, 31, 58, 0.10);
                --shadow-lg: 0 8px 40px rgba(11, 31, 58, 0.12);
                --radius-sm: 8px;
                --radius-md: 12px;
                --radius-lg: 16px;
                --transition: all 0.3s ease;
            }

            /* ===== TYPOGRAPHY ===== */
            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                color: #1A1A2E;
                background: var(--white);
                overflow-x: hidden;
                font-size: 15px;
                line-height: 1.6;
            }

            .section-padding {
                padding: 60px 0;
            }

            .section-title {
                font-size: 2rem;
                font-weight: 700;
                color: var(--navy-dark);
                letter-spacing: -0.02em;
                line-height: 1.2;
                margin-bottom: 0.5rem;
            }

            .section-subtitle {
                font-size: 1rem;
                font-weight: 400;
                color: var(--gray);
                max-width: 540px;
                margin: 0 auto 2rem auto;
                line-height: 1.7;
            }

            .section-badge {
                display: inline-block;
                background: rgba(11, 31, 58, 0.05);
                color: var(--navy-medium);
                font-size: 0.7rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                padding: 0.3rem 1rem;
                border-radius: 50px;
                margin-bottom: 0.75rem;
            }

            .text-navy-light {
                color: var(--navy-light);
            }

            /* ===== BUTTONS ===== */
            .btn-premium {
                background: var(--navy-gradient);
                color: var(--white);
                border: none;
                padding: 0.6rem 1.8rem;
                border-radius: 50px;
                font-weight: 600;
                font-size: 0.85rem;
                transition: var(--transition);
                box-shadow: 0 4px 20px rgba(18, 62, 115, 0.2);
                letter-spacing: 0.01em;
            }

            .btn-premium:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 28px rgba(18, 62, 115, 0.3);
                color: var(--white);
                background: var(--navy-gradient);
            }

            .btn-outline-premium {
                background: transparent;
                color: var(--white);
                border: 1.5px solid rgba(255, 255, 255, 0.4);
                padding: 0.6rem 1.8rem;
                border-radius: 50px;
                font-weight: 600;
                font-size: 0.85rem;
                transition: var(--transition);
                letter-spacing: 0.01em;
            }

            .btn-outline-premium:hover {
                background: rgba(255, 255, 255, 0.08);
                color: var(--white);
                transform: translateY(-2px);
                border-color: var(--white);
            }

            /* ===== HERO SECTION ===== */
            #hero {
                min-height: 80vh;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
                padding: 0;
                background: #000000;
                padding-bottom: 80px;
            }

            .hero-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
                overflow: hidden;
            }

            .hero-background img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transform: scale(1.05);
                transition: transform 10s ease-in-out;
            }

            .hero-background::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.65);
                z-index: 1;
            }

            .hero-particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 2;
                pointer-events: none;
                overflow: hidden;
            }

            .particle {
                position: absolute;
                width: 3px;
                height: 3px;
                background: rgba(255, 255, 255, 0.08);
                border-radius: 50%;
                animation: floatParticle 20s linear infinite;
            }

            @keyframes floatParticle {
                0% {
                    transform: translateY(100vh) scale(0);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-10vh) scale(1);
                    opacity: 0;
                }
            }

            .hero-content {
                position: relative;
                z-index: 3;
                padding: 80px 0 50px 0;
                color: var(--white);
            }

            .hero-badge {
                display: inline-block;
                background: rgba(255, 255, 255, 0.08);
                color: var(--white);
                font-size: 0.7rem;
                font-weight: 600;
                padding: 0.3rem 1.2rem;
                border-radius: 50px;
                margin-bottom: 1rem;
                letter-spacing: 0.08em;
                border: 1px solid rgba(255, 255, 255, 0.06);
                animation: fadeInDown 0.6s ease-out;
            }

            .hero-badge i {
                color: #60A5FA;
                margin-right: 6px;
            }

            .hero-title {
                font-size: 3rem;
                font-weight: 700;
                color: var(--white);
                letter-spacing: -0.03em;
                line-height: 1.15;
                margin-bottom: 1rem;
                animation: fadeInUp 0.8s ease-out;
            }

            .hero-title .highlight {
                background: linear-gradient(135deg, #ffffff, #6f6d75);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero-description {
                font-size: 1.05rem;
                color: rgba(255, 255, 255, 0.8);
                line-height: 1.7;
                max-width: 480px;
                margin-bottom: 1.8rem;
                animation: fadeInUp 0.8s ease-out 0.15s both;
            }

            .hero-buttons {
                animation: fadeInUp 0.8s ease-out 0.3s both;
            }

            .hero-buttons .btn {
                margin-right: 0.75rem;
                margin-bottom: 0.5rem;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-15px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* ===== STATISTICS ===== */
            #statistics {
                position: relative;
                margin-top: -60px;
                z-index: 10;
                padding: 0 0 40px 0;
                pointer-events: none;
            }

            .statistics-wrapper {
                position: relative;
                z-index: 10;
                pointer-events: auto;
            }

            .stat-card {
                background: var(--white);
                border-radius: var(--radius-sm);
                padding: 1.8rem 1rem;
                text-align: center;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
                transition: var(--transition);
                border: none;
                position: relative;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.98);
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background: var(--navy-gradient);
                opacity: 0;
                transition: var(--transition);
            }

            .stat-card:hover::before {
                opacity: 1;
            }

            .stat-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 12px 50px rgba(0, 0, 0, 0.15);
            }

            .stat-number {
                font-size: 2.2rem;
                font-weight: 700;
                color: var(--navy-dark);
                line-height: 1.1;
            }

            .stat-label {
                font-size: 0.8rem;
                color: var(--gray);
                font-weight: 500;
                margin-top: 0.2rem;
            }

            .stat-icon {
                font-size: 1.6rem;
                color: var(--navy-light);
                margin-bottom: 0.3rem;
                display: block;
                opacity: 0.5;
            }

            /* ===== FEATURES ===== */
            #features {
                background: var(--light-gray);
            }

            .feature-card {
                background: var(--white);
                border-radius: var(--radius-sm);
                padding: 1.5rem 1.2rem;
                text-align: center;
                box-shadow: var(--shadow-sm);
                transition: var(--transition);
                border: 1px solid rgba(0, 0, 0, 0.02);
                height: 100%;
            }

            .feature-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-md);
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                background: rgba(18, 62, 115, 0.06);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 0.8rem auto;
                font-size: 1.3rem;
                color: var(--navy-light);
                transition: var(--transition);
            }

            .feature-card:hover .feature-icon {
                background: var(--navy-gradient);
                color: var(--white);
            }

            .feature-card h4 {
                font-size: 0.95rem;
                font-weight: 600;
                color: var(--navy-dark);
                margin-bottom: 0.4rem;
            }

            .feature-card p {
                font-size: 0.8rem;
                color: var(--gray);
                line-height: 1.6;
                margin: 0;
            }

            /* ===== FAQ ===== */
            #faq {
                background: var(--white);
            }

            .faq-accordion .card {
                border: none;
                border-radius: var(--radius-sm) !important;
                margin-bottom: 0.5rem;
                box-shadow: var(--shadow-sm);
                border: 1px solid rgba(0, 0, 0, 0.03);
            }

            .faq-accordion .card:hover {
                box-shadow: var(--shadow-md);
            }

            .faq-accordion .card-header {
                background: var(--white);
                border: none;
                padding: 0;
                border-radius: var(--radius-sm) !important;
            }

            .faq-accordion .card-header .btn-link {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding: 0.8rem 1.2rem;
                text-align: left;
                font-weight: 600;
                color: var(--navy-dark);
                text-decoration: none;
                font-size: 0.9rem;
                border: none;
                background: transparent;
                border-radius: var(--radius-sm);
                transition: var(--transition);
            }

            .faq-accordion .card-header .btn-link:hover {
                color: var(--navy-light);
            }

            .faq-accordion .card-header .btn-link .fa-chevron-down {
                transition: var(--transition);
                font-size: 0.7rem;
                color: var(--gray);
                flex-shrink: 0;
                margin-left: 0.75rem;
            }

            .faq-accordion .card-header .btn-link[aria-expanded="true"] .fa-chevron-down {
                transform: rotate(180deg);
                color: var(--navy-light);
            }

            .faq-accordion .card-body {
                padding: 0 1.2rem 1rem 1.2rem;
                color: var(--gray);
                line-height: 1.7;
                font-size: 0.85rem;
                border-top: 1px solid rgba(0, 0, 0, 0.03);
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 991.98px) {
                .hero-title {
                    font-size: 2.5rem;
                }
                .section-title {
                    font-size: 1.75rem;
                }
                .section-padding {
                    padding: 50px 0;
                }
                #hero {
                    min-height: auto;
                }
                .hero-content {
                    padding: 70px 0 40px 0;
                }
            }

            @media (max-width: 767.98px) {
                .hero-title {
                    font-size: 2rem;
                }
                .section-title {
                    font-size: 1.5rem;
                }
                .section-padding {
                    padding: 40px 0;
                }
                .stat-number {
                    font-size: 1.6rem;
                }
            }

            @media (max-width: 575.98px) {
                .hero-title {
                    font-size: 1.6rem;
                }
                .hero-description {
                    font-size: 0.9rem;
                }
                .hero-buttons .btn {
                    display: block;
                    width: 100%;
                    margin-right: 0;
                    margin-bottom: 0.5rem;
                }
                .section-subtitle {
                    font-size: 0.9rem;
                }
                .stat-card {
                    padding: 1rem 0.75rem;
                }
                .feature-card {
                    padding: 1.2rem 0.8rem;
                }
                .faq-accordion .card-header .btn-link {
                    font-size: 0.8rem;
                    padding: 0.6rem 0.8rem;
                }
                .faq-accordion .card-body {
                    padding: 0 0.8rem 0.8rem 0.8rem;
                    font-size: 0.8rem;
                }
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }
            ::-webkit-scrollbar-track {
                background: var(--light-gray);
            }
            ::-webkit-scrollbar-thumb {
                background: var(--navy-gradient);
                border-radius: 3px;
            }
        </style>
    @endpush

    <!-- ===== HERO SECTION ===== -->
    <section id="hero">
        <div class="hero-background">
            <img src="{{ asset('landing/images/slider-main/rat.jpeg') }}" alt="Background" id="heroBgImage">
        </div>

        <div class="hero-particles" id="particlesContainer"></div>

        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-7">
                    <span class="hero-badge">
                        <i class="fas fa-rocket"></i> Sistem BOSS Kementerian
                    </span>
                    <h1 class="hero-title">
                        Bantaeng Office <br><span class="highlight">Smart Service</span>
                    </h1>
                    <p class="hero-description">
                        Sistem layanan perkantoran digital terintegrasi untuk mendukung administrasi, pengelolaan dokumen,
                        koordinasi, serta peningkatan efisiensi dan kualitas pelayanan di Kantor Imigrasi Kelas III Non TPI
                        Bantaeng.
                    </p>
                    <div class="hero-buttons d-flex flex-wrap gap-2">
                        <a href="{{ route('login') }}" class="btn btn-premium">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk
                        </a>
                        <a href="#features" class="btn btn-outline-premium">
                            <i class="fas fa-chevron-right me-2"></i> Pelajari
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== STATISTICS SECTION ===== -->
    <section id="statistics" data-aos="fade-up" data-aos-duration="600">
        <div class="container">
            <div class="statistics-wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-5 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="stat-card">
                            <span class="stat-icon">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="stat-number" data-count="1500">
                                1.500+
                            </div>
                            <div class="stat-label">
                                Pengguna Aktif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6" data-aos="zoom-in" data-aos-delay="150">
                        <div class="stat-card">
                            <span class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </span>
                            <div class="stat-number" data-count="850">
                                850+
                            </div>
                            <div class="stat-label">
                                Total Dokumen
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURES SECTION ===== -->
    <section id="features" class="section-padding" data-aos="fade-up" data-aos-duration="600">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <span class="section-badge"><i class="fas fa-cogs me-1"></i> Fitur</span>
                    <h2 class="section-title">Fitur Sistem <span class="text-navy-light">BOSS</span></h2>
                    <p class="section-subtitle">
                        Dirancang untuk mendukung pengarsipan dokumen secara efisien.
                    </p>
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-file-pdf"></i></div>
                        <h4>Manajemen Dokumen</h4>
                        <p>Kelola dokumen Kantor secara digital dengan sistem terstruktur.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
                        <h4>Dashboard Analitik</h4>
                        <p>Pantau capaian program dengan visualisasi data informatif.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
                        <h4>Multi User & Role</h4>
                        <p>Mendukung berbagai peran dengan akses sesuai kebutuhan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-lock"></i></div>
                        <h4>Keamanan Terjamin</h4>
                        <p>Sistem dengan keamanan berlapis untuk melindungi data.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-eye"></i></div>
                        <h4>Monitoring & Evaluasi</h4>
                        <p>Lacak perkembangan program secara real-time.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-archive"></i></div>
                        <h4>Arsip Digital</h4>
                        <p>Simpan dan kelola arsip dengan pencarian cepat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FAQ SECTION ===== -->
    <section id="faq" class="section-padding" data-aos="fade-up" data-aos-duration="600">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <span class="section-badge"><i class="fas fa-question-circle me-1"></i> FAQ</span>
                    <h2 class="section-title">Pertanyaan <span class="text-navy-light">Umum</span></h2>
                    <p class="section-subtitle">
                        Jawaban atas pertanyaan yang sering diajukan.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="faq-accordion" id="faqAccordion">
                        <div class="card" data-aos="fade-up" data-aos-delay="100">
                            <div class="card-header" id="faq1">
                                <button class="btn-link" data-toggle="collapse" data-target="#collapse1"
                                    aria-expanded="true" aria-controls="collapse1">
                                    Apa itu Sistem BOSS?
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="faq1"
                                data-parent="#faqAccordion">
                                <div class="card-body">
                                    Sistem BOSS (Backend Office Support System) adalah aplikasi berbasis web untuk mendukung
                                    perencanaan, pelaksanaan, pemantauan, dan evaluasi program perubahan di lingkungan
                                    Kementerian Imigrasi dan Pemasyarakatan.
                                </div>
                            </div>
                        </div>
                        <div class="card" data-aos="fade-up" data-aos-delay="150">
                            <div class="card-header" id="faq2">
                                <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapse2"
                                    aria-expanded="false" aria-controls="collapse2">
                                    Siapa yang dapat menggunakan sistem ini?
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="faq2" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Sistem ini dapat digunakan oleh berbagai pihak di lingkungan Kementerian,
                                    termasuk peserta pelatihan kepemimpinan, pejabat, mentor, dan administrator.
                                </div>
                            </div>
                        </div>
                        <div class="card" data-aos="fade-up" data-aos-delay="200">
                            <div class="card-header" id="faq3">
                                <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapse3"
                                    aria-expanded="false" aria-controls="collapse3">
                                    Bagaimana cara mengakses sistem?
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="faq3" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Pengguna dapat mengakses melalui halaman login menggunakan akun yang telah didaftarkan
                                    oleh administrator.
                                </div>
                            </div>
                        </div>
                        <div class="card" data-aos="fade-up" data-aos-delay="250">
                            <div class="card-header" id="faq4">
                                <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapse4"
                                    aria-expanded="false" aria-controls="collapse4">
                                    Apakah data aman?
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <div id="collapse4" class="collapse" aria-labelledby="faq4" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Ya, sistem dilengkapi dengan enkripsi data, autentikasi multi-faktor,
                                    dan sistem audit untuk keamanan data.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // ===== CREATE PARTICLES =====
            function createParticles() {
                const container = document.getElementById('particlesContainer');
                const particleCount = 30;

                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';

                    const size = Math.random() * 3 + 1.5;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDuration = (Math.random() * 20 + 15) + 's';
                    particle.style.animationDelay = (Math.random() * 15) + 's';

                    container.appendChild(particle);
                }
            }

            // ===== PARALLAX EFFECT =====
            function initParallax() {
                const hero = document.getElementById('hero');
                const bgImage = document.getElementById('heroBgImage');

                hero.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width;
                    const y = (e.clientY - rect.top) / rect.height;

                    const moveX = (x - 0.5) * 15;
                    const moveY = (y - 0.5) * 15;

                    bgImage.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.05)`;
                });

                hero.addEventListener('mouseleave', function() {
                    bgImage.style.transform = 'translate(0, 0) scale(1.05)';
                });
            }

            // ===== ANIMATE COUNTERS =====
            function animateCounters() {
                const statNumbers = document.querySelectorAll('.stat-number');
                const observerOptions = {
                    threshold: 0.5,
                    rootMargin: '0px'
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const el = entry.target;
                            const text = el.textContent.trim();
                            const number = parseInt(text.replace(/[^0-9]/g, ''));
                            if (number) {
                                animateNumber(el, number, 1500);
                            }
                            observer.unobserve(el);
                        }
                    });
                }, observerOptions);

                statNumbers.forEach(el => observer.observe(el));
            }

            function animateNumber(el, target, duration) {
                let start = 0;
                const step = Math.ceil(target / 50);
                const interval = duration / 50;

                const timer = setInterval(() => {
                    start += step;
                    if (start >= target) {
                        start = target;
                        clearInterval(timer);
                    }
                    el.textContent = formatNumber(start);
                }, interval);
            }

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // ===== SMOOTH SCROLL =====
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // ===== INITIALIZE =====
            document.addEventListener('DOMContentLoaded', function() {
                createParticles();
                initParallax();
                animateCounters();
            });

            window.addEventListener('load', function() {
                setTimeout(animateCounters, 300);
            });
        </script>
    @endpush
@endsection