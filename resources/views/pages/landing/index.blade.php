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

    .section-padding-sm {
        padding: 40px 0;
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

    .section-subtitle-left {
        font-size: 1rem;
        font-weight: 400;
        color: var(--gray);
        max-width: 520px;
        line-height: 1.7;
        margin-bottom: 1.5rem;
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

    .text-navy {
        color: var(--navy-dark);
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

    #statistics::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 60%;
    background: var(--light-gray);
    z-index: -1;
}
/* ===== HERO SECTION - SIMPLE ELEGANT ===== */
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
    background: rgba(0, 0, 0, 0.6);
    z-index: 1;
}

    /* Simple particles - more subtle */
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

    /* Hero Content - Simple */
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
        background: rgba(255, 255, 255, 0.8);
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

    /* Simple stats in hero */
    .hero-stats {
        display: flex;
        gap: 2.5rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        animation: fadeInUp 0.8s ease-out 0.45s both;
    }

    .hero-stat-item .number {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--white);
        display: block;
        line-height: 1;
    }

    .hero-stat-item .label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 0.2rem;
        letter-spacing: 0.04em;
    }

    /* Subtle floating elements */
    .floating-element {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.03);
        animation: floatElement 25s ease-in-out infinite;
        z-index: 1;
    }

    .floating-element-1 {
        width: 200px;
        height: 200px;
        top: -60px;
        right: -60px;
        animation-delay: 0s;
    }

    .floating-element-2 {
        width: 140px;
        height: 140px;
        bottom: -40px;
        left: -40px;
        animation-delay: -8s;
    }

    @keyframes floatElement {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(20px, -20px) scale(1.05); }
        66% { transform: translate(-15px, 15px) scale(0.95); }
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
   /* ===== STATISTICS - OVERLAPPING HERO ===== */
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
    box-shadow: 0 8px 0px rgba(0, 0, 0, 0.12);
    transition: var(--transition);
    border: none;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
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
    background: rgba(255, 255, 255, 1);
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

    /* ===== ABOUT SECTION ===== */
  

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

    /* ===== TIMELINE / FLOW ===== */
    #flow {
        background: var(--white);
    }

    .flow-steps {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        position: relative;
        padding: 1.5rem 0;
        flex-wrap: wrap;
    }

    .flow-steps::before {
        content: '';
        position: absolute;
        top: 3.5rem;
        left: 10%;
        right: 10%;
        height: 2px;
        background: var(--navy-gradient);
        opacity: 0.15;
        border-radius: 1px;
    }

    .flow-step {
        text-align: center;
        flex: 1;
        min-width: 80px;
        position: relative;
        z-index: 2;
        padding: 0 0.3rem;
    }

    .flow-step .step-icon {
        width: 56px;
        height: 56px;
        background: var(--white);
        border: 2px solid rgba(18, 62, 115, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.6rem auto;
        font-size: 1.2rem;
        color: var(--navy-light);
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .flow-step .step-icon .step-number {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 22px;
        height: 22px;
        background: var(--navy-gradient);
        border-radius: 50%;
        color: var(--white);
        font-size: 0.6rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flow-step:hover .step-icon {
        border-color: var(--navy-light);
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
    }

    .flow-step h5 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--navy-dark);
        margin-bottom: 0.1rem;
    }

    .flow-step p {
        font-size: 0.7rem;
        color: var(--gray);
        margin: 0;
    }

    /* ===== ADVANTAGES ===== */
    #advantages {
        background: var(--navy-gradient);
        padding: 60px 0;
        color: var(--white);
        position: relative;
        overflow: hidden;
    }

    #advantages::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 60%;
        height: 200%;
        background: radial-gradient(ellipse at 70% 50%, rgba(255, 255, 255, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    #advantages .section-title {
        color: var(--white);
    }

    #advantages .section-subtitle {
        color: rgba(255, 255, 255, 0.6);
    }

    .advantage-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: var(--radius-sm);
        padding: 1.5rem 1.2rem;
        text-align: center;
        transition: var(--transition);
        height: 100%;
    }

    .advantage-card:hover {
        transform: translateY(-4px);
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .advantage-card .adv-icon {
        font-size: 1.6rem;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 0.6rem;
        display: block;
    }

    .advantage-card h5 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
        color: var(--white);
    }

    .advantage-card p {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
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

    /* ===== CTA ===== */
    #cta {
        background: var(--navy-gradient);
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    #cta::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -15%;
        width: 50%;
        height: 200%;
        background: radial-gradient(ellipse at 70% 50%, rgba(255, 255, 255, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    #cta h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--white);
        letter-spacing: -0.02em;
        margin-bottom: 0.3rem;
    }

    #cta p {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.6);
        max-width: 460px;
        margin: 0 auto 1.5rem auto;
    }

    #cta .btn-cta-primary {
        background: var(--white);
        color: var(--navy-dark);
        border: none;
        padding: 0.6rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin: 0 0.5rem 0.5rem 0;
    }

    #cta .btn-cta-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 28px rgba(0, 0, 0, 0.15);
    }

    #cta .btn-cta-outline {
        background: transparent;
        color: var(--white);
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        padding: 0.6rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition);
        margin: 0 0.5rem 0.5rem 0;
    }

    #cta .btn-cta-outline:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-2px);
        color: var(--white);
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

        .flow-steps::before {
            display: none;
        }

        .flow-step {
            flex: 0 0 33.33%;
            margin-bottom: 1.5rem;
        }

        #hero {
            min-height: auto;
        }

        .hero-content {
            padding: 70px 0 40px 0;
        }

        .hero-stats {
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .floating-element-1,
        .floating-element-2 {
            display: none;
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

        #advantages {
            padding: 40px 0;
        }

        #cta {
            padding: 40px 0;
        }

        #cta h2 {
            font-size: 1.6rem;
        }

        .flow-step {
            flex: 0 0 50%;
        }

        .stat-number {
            font-size: 1.6rem;
        }

   

        .hero-stats {
            gap: 1rem;
        }

        .hero-stat-item .number {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 575.98px) {
        .hero-title {
            font-size: 1.6rem;
        }

        .hero-description {
            font-size: 0.9rem;
        }

        .flow-step {
            flex: 0 0 100%;
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

        .advantage-card {
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

        #cta .btn-cta-primary,
        #cta .btn-cta-outline {
            display: block;
            width: 100%;
            margin: 0 0 0.5rem 0;
        }

        .hero-stats {
            flex-direction: column;
            gap: 0.75rem;
        }

        .hero-stat-item {
            text-align: center;
        }

        .hero-stat-item .number {
            font-size: 1.2rem;
        }
    }

    /* ===== UTILITY ===== */
    .gap-2 {
        gap: 0.5rem;
    }
    .gap-3 {
        gap: 0.75rem;
    }
    .gap-4 {
        gap: 1.25rem;
    }

    .bg-light-custom {
        background: var(--light-gray);
    }

    .border-radius-lg {
        border-radius: var(--radius-lg);
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

<!-- ============================================================
    HERO SECTION - SIMPLE ELEGANT
    ============================================================ -->
<section id="hero">
    <div class="hero-background">
        <img src="{{ asset('landing/images/slider-main/rat.jpeg') }}" alt="Background" id="heroBgImage">
    </div>

    <div class="floating-element floating-element-1"></div>
    <div class="floating-element floating-element-2"></div>

    <div class="hero-particles" id="particlesContainer"></div>

    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-7">
                <span class="hero-badge">
                    <i class="fas fa-rocket"></i> Sistem RAP Kementerian
                </span>
                <h1 class="hero-title">
                    Rencana Aksi Perubahan<br>
                    <span class="highlight">Modern & Terintegrasi</span>
                </h1>
                <p class="hero-description">
                    Sistem informasi terintegrasi untuk perencanaan, pelaksanaan, pemantauan, 
                    dan evaluasi program perubahan di lingkungan Kementerian Imigrasi dan Pemasyarakatan.
                </p>
                <div class="hero-buttons d-flex flex-wrap gap-2">
                    <a href="{{ route('login') }}" class="btn btn-premium">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk
                    </a>
                    <a href="#about" class="btn btn-outline-premium">
                        <i class="fas fa-chevron-right me-2"></i> Pelajari
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <span class="number" data-count="1500">1.500+</span>
                        <span class="label">Pengguna Aktif</span>
                    </div>
                    <div class="hero-stat-item">
                        <span class="number" data-count="850">850+</span>
                        <span class="label">Dokumen RAP</span>
                    </div>
                    <div class="hero-stat-item">
                        <span class="number" data-count="45">45</span>
                        <span class="label">Instansi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
    STATISTICS SECTION - OVERLAPPING HERO
    ============================================================ -->
<section id="statistics" data-aos="fade-up" data-aos-duration="600">
    <div class="container">
        <div class="statistics-wrapper">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-card">
                        <span class="stat-icon"><i class="fas fa-users"></i></span>
                        <div class="stat-number" data-count="1500">1.500+</div>
                        <div class="stat-label">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="150">
                    <div class="stat-card">
                        <span class="stat-icon"><i class="fas fa-file-alt"></i></span>
                        <div class="stat-number" data-count="850">850+</div>
                        <div class="stat-label">Dokumen RAP</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-card">
                        <span class="stat-icon"><i class="fas fa-building"></i></span>
                        <div class="stat-number" data-count="45">45</div>
                        <div class="stat-label">Instansi Terlibat</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="250">
                    <div class="stat-card">
                        <span class="stat-icon"><i class="fas fa-chart-line"></i></span>
                        <div class="stat-number" data-count="320">320+</div>
                        <div class="stat-label">Laporan Tersusun</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
    ABOUT SECTION
    ============================================================ -->


<!-- ============================================================
    FEATURES SECTION
    ============================================================ -->
<section id="features" class="section-padding" data-aos="fade-up" data-aos-duration="600">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <span class="section-badge"><i class="fas fa-cogs me-1"></i> Fitur</span>
                <h2 class="section-title">Fitur Sistem <span class="text-navy-light">RAP</span></h2>
                <p class="section-subtitle">
                    Dirancang untuk mendukung kelancaran program perubahan Anda.
                </p>
            </div>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-file-pdf"></i></div>
                    <h4>Manajemen Dokumen</h4>
                    <p>Kelola dokumen RAP secara digital dengan sistem terstruktur.</p>
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

<!-- ============================================================
    FLOW / TIMELINE SECTION
    ============================================================ -->


<!-- ============================================================
    FAQ SECTION
    ============================================================ -->
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
                            <button class="btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                Apa itu Sistem RAP?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="faq1" data-parent="#faqAccordion">
                            <div class="card-body">
                                Sistem RAP (Rencana Aksi Perubahan) adalah aplikasi berbasis web untuk mendukung 
                                perencanaan, pelaksanaan, pemantauan, dan evaluasi program perubahan di lingkungan 
                                Kementerian Imigrasi dan Pemasyarakatan.
                            </div>
                        </div>
                    </div>
                    <div class="card" data-aos="fade-up" data-aos-delay="150">
                        <div class="card-header" id="faq2">
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
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
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
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
                            <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
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

<!-- ============================================================
    CTA SECTION
    ============================================================ -->


@push('scripts')
<script>
    // ============================================================
    // CREATE PARTICLES
    // ============================================================
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

    // ============================================================
    // PARALLAX EFFECT
    // ============================================================
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

    // ============================================================
    // ANIMATE COUNTERS
    // ============================================================
    function animateCounters() {
        const statNumbers = document.querySelectorAll('.stat-number, .hero-stat-item .number');
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

    // ============================================================
    // SMOOTH SCROLL
    // ============================================================
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

    // ============================================================
    // INITIALIZE
    // ============================================================
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