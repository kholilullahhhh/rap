@extends('layouts.landing.app')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/landing/kontak.css') }}">
@endpush

<!-- ============================================================
    BANNER AREA
    ============================================================ -->
<div id="banner-area" class="banner-area" style="background-image:url({{ asset('landing/images/slider-main/rat.jpeg') }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-duration="800">
                    <span class="section-badge" style="background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.8);">
                        <i class="fas fa-phone-alt me-1"></i> Hubungi Kami
                    </span>
                    <h1 class="banner-title">Kontak <span class="highlight">Kami</span></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
    MAIN CONTENT
    ============================================================ -->
<section id="main-container" class="main-container" style="padding: 60px 0 40px 0;">
    <div class="container">
        <!-- Section Title -->
        <div class="row text-center">
            <div class="col-12" data-aos="fade-up" data-aos-duration="800">
                <span class="section-badge"><i class="fas fa-map-pin me-1"></i> Informasi Kontak</span>
                <h2 class="section-title">Kunjungi <span class="highlight">Kami</span></h2>
                <h3 class="section-sub-title">Temukan lokasi dan hubungi kami melalui berbagai saluran</h3>
            </div>
        </div>

        <!-- Contact Cards -->
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="ts-service-box-bg text-center">
                    <span class="ts-service-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Kunjungi Lokasi</h4>
                        <p>Jalan, Bonto Jai, Kec. Bissappu,<br> Kabupaten Bantaeng, Sulawesi Selatan 92451</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="ts-service-box-bg text-center">
                    <span class="ts-service-icon">
                        <i class="fab fa-instagram"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Ikuti Kami</h4>
                        <p><a href="https://www.instagram.com/imigrasi_bantaeng_/" target="_blank">@imigrasi.bantaeng_</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="ts-service-box-bg text-center">
                    <span class="ts-service-icon">
                        <i class="fas fa-phone-alt"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Hubungi Kami</h4>
                        <p><a href="tel:0411000000">(0411) 000000</a><br><a href="tel:080808">080808</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="gap-60" style="height: 40px;"></div>

        <!-- Google Map -->
        <div class="map-wrapper" data-aos="fade-up" data-aos-duration="800">
            <div class="google-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.9453552202244!2d119.90444747498528!3d-5.575097694405471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x42888dfc6316d653%3A0x75546e815f267f0c!2sKantor%20Imigrasi%20Kelas%20III%20Non%20TPI%20Bantaeng!5e0!3m2!1sid!2sid!4v1782699706522!5m2!1sid!2sid" 
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Peta Lokasi Kantor Imigrasi Bantaeng">
                </iframe>
            </div>
            <div class="map-overlay">
                <i class="fas fa-map-pin"></i>
                <span>Kantor Imigrasi Kelas III Non TPI Bantaeng</span>
            </div>
        </div>

        <div class="gap-40" style="height: 40px;"></div>

       

    </div>
</section>
@endsection
