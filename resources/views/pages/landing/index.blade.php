@extends('layouts.landing.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/pages/landing/index.css') }}">
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
                                {{ $datas->count() }}
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
                                {{ $dokumen->count() }}
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
                                    Kantor Imigrasi Kelas III Non TPI Bantaeng
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
