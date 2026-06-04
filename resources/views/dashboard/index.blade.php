@extends('dashboard.dashlayouts.style')

@section('content')
<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
        --black: #1F2937;
        --gray-900: #374151;
        --gray-800: #4B5563;
        --gray-700: #6B7280;
        --gray-600: #9CA3AF;
        --gray-500: #D1D5DB;
        --gray-200: #E5E7EB;
        --gray-100: #F3F4F6;
        --white: #FFFFFF;
        --bg-subtle: #F8FAFC;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.04);
        --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.08), 0 4px 10px rgba(0, 0, 0, 0.04);
        --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* ===== GLOBAL BACKGROUND ===== */
    body {
        background-color: var(--bg-subtle) !important;
    }

    .section {
        background-color: transparent;
    }

    /* ===== FADE-IN ANIMATION ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-carousel-wrapper,
    .feature-section,
    .news-section,
    .top-info-section,
    .youtube-carousel,
    .contact-section,
    .map-section,
    .footer {
        animation: fadeInUp 0.6s ease-out both;
    }

    .news-section { animation-delay: 0.1s; }
    .top-info-section { animation-delay: 0.15s; }
    .youtube-carousel { animation-delay: 0.2s; }
    .contact-section { animation-delay: 0.25s; }
    .map-section { animation-delay: 0.3s; }

    /* ===== HERO CAROUSEL MODERN ===== */
    .hero-carousel-wrapper {
        margin-bottom: 40px;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .single-hero-slide {
        position: relative;
        height: 360px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .single-hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 53, 145, 0.85) 0%, rgba(0, 102, 255, 0.65) 100%);
    }

    .slide-content {
        position: relative;
        z-index: 2;
        padding: 40px 20px;
    }

    .slide-content h4 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 12px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        letter-spacing: -0.02em;
    }

    .slide-content p {
        font-size: 1rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 20px;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 26px;
        font-size: 0.875rem;
        background: var(--white);
        color: var(--primary-color);
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        letter-spacing: 0.01em;
    }

    .btn-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
        background: var(--primary-color);
        color: var(--white);
    }

    /* ===== FEATURE CARDS ===== */
    .feature-section {
        margin-bottom: 40px;
    }

    .feature-section-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--primary-color);
        text-align: center;
        margin-bottom: 20px;
        letter-spacing: -0.02em;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
    }

    .feature-card-modern {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 16px 10px;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        box-shadow: var(--shadow-sm);
    }

    .feature-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: var(--primary-light);
    }

    .feature-icon {
        width: 56px;
        height: 56px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-card-modern:hover .feature-icon {
        transform: scale(1.1);
    }

    .feature-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .feature-name {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
        line-height: 1.3;
    }

    /* ===== SECTION HEADER ===== */
    .section-header {
        padding: 18px 24px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        margin-bottom: 0;
    }

    .section-header h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        text-align: center;
        letter-spacing: -0.01em;
    }

    /* ===== NEWS SECTION ===== */
    .news-section {
        margin-bottom: 40px;
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .news-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        padding: 24px;
    }

    .news-card-main {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .news-card-main:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
        border-color: var(--primary-light);
    }

    .news-image-main {
        width: 100%;
        height: 260px;
        object-fit: cover;
    }

    .news-content-main {
        padding: 20px;
    }

    .news-title-main {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 10px;
        line-height: 1.4;
        letter-spacing: -0.01em;
    }

    .news-subtitle-main {
        font-size: 0.9rem;
        color: var(--gray-700);
        margin-bottom: 16px;
        line-height: 1.6;
    }

    .btn-news {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-news:hover {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: var(--white);
    }

    .news-sidebar {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .news-card-small {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 12px;
        display: flex;
        gap: 12px;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .news-card-small:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-sm);
        transform: translateX(4px);
    }

    .news-image-small {
        width: 72px;
        height: 72px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        flex-shrink: 0;
    }

    .news-content-small {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .news-subtitle-small {
        font-size: 0.8rem;
        color: var(--gray-700);
        line-height: 1.5;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-link-small {
        font-size: 0.75rem;
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none;
    }

    /* ===== BANNER SECTION (TOP INFO) ===== */
    .top-info-section {
        margin-bottom: 40px;
    }
    .top-info-grid {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        gap: 1rem;
        align-items: stretch;
    }
    .top-info-card {
        position: relative;
        border-radius: var(--radius-lg);
        overflow: hidden;
        display: block;
        text-decoration: none;
        transition: all 0.4s ease;
        box-shadow: var(--shadow-sm);
    }
    .top-info-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }
    .top-info-card-img {
        width: 100%;
        height: 100%;
        min-height: 250px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
    }
    .top-info-card:hover .top-info-card-img {
        transform: scale(1.04);
    }
    .top-info-card.featured .top-info-card-img {
        min-height: 320px;
    }
    .top-info-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.25rem;
        background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);
        color: var(--white);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    .top-info-card-categories {
        display: flex;
        gap: 0.4rem;
        margin-bottom: 0.4rem;
        flex-wrap: wrap;
    }
    .top-info-card-cat {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 6px;
        font-size: 0.65rem;
        font-weight: 600;
        background: var(--primary-color);
        color: var(--white);
    }
    .top-info-card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--white);
        line-height: 1.4;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .top-info-card.featured .top-info-card-title {
        font-size: 1.1rem;
    }
    .top-info-card:nth-child(n+4) {
        display: none !important;
    }
    .top-info-slider-wrapper {
        position: relative;
    }
    .top-info-btn {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        color: var(--gray-900);
        box-shadow: var(--shadow-sm);
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
    }
    .top-info-btn.prev-btn {
        left: -18px;
    }
    .top-info-btn.next-btn {
        right: -18px;
    }
    .top-info-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        border-color: var(--primary-color);
        transform: translateY(-50%) scale(1.08);
        box-shadow: var(--shadow-md);
    }

    /* ===== YOUTUBE SECTION ===== */
    .youtube-carousel {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-bottom: 40px;
        box-shadow: var(--shadow-sm);
    }

    .youtube-item {
        display: block;
        border-radius: var(--radius-md);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .youtube-item:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-md);
    }

    .youtube-thumbnail {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .youtube-play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 52px;
        height: 52px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        box-shadow: 0 4px 12px rgba(0, 83, 197, 0.4);
        transition: transform 0.3s ease;
    }

    .youtube-item:hover .youtube-play-overlay {
        transform: translate(-50%, -50%) scale(1.1);
    }

    .youtube-play-overlay i {
        color: white;
        font-size: 20px;
        margin-left: 3px;
    }

    /* ===== CONTACT SECTION ===== */
    .contact-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 36px 0;
        border-radius: var(--radius-lg);
        margin-bottom: 40px;
        box-shadow: var(--shadow-lg);
    }

    .contact-title {
        font-size: 1.3rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
        letter-spacing: -0.01em;
    }

    .contact-form-modern {
        max-width: 560px;
        margin: 0 auto;
    }

    .form-group-modern {
        margin-bottom: 16px;
    }

    .form-control-modern {
        width: 100%;
        padding: 12px 18px;
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        background: rgba(255, 255, 255, 0.08);
        color: var(--white);
        border-radius: var(--radius-md);
        font-size: 0.9rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
    }

    .form-control-modern:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.6);
        background: rgba(255, 255, 255, 0.12);
    }

    .form-control-modern::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    textarea.form-control-modern {
        min-height: 100px;
        resize: vertical;
    }

    .btn-submit-modern {
        width: 100%;
        padding: 12px 28px;
        background: var(--white);
        color: var(--primary-color);
        border: none;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(255,255,255,0.25);
    }

    /* ===== MAP SECTION ===== */
    .map-section {
        margin-bottom: 24px;
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .map-wrapper {
        border-radius: 0;
        overflow: hidden;
        border: none;
        height: 350px;
    }

    .map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* ===== FOOTER COPYRIGHT ===== */
    .copyright-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 20px 0;
        text-align: center;
        border-radius: var(--radius-lg);
        margin-bottom: 20px;
    }

    .copyright-text {
        font-size: 0.8rem;
        margin: 0;
        line-height: 1.6;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .single-hero-slide {
            height: 280px;
        }

        .slide-content h4 {
            font-size: 1.2rem;
        }

        .slide-content p {
            font-size: 0.8rem;
        }

        .feature-grid {
            gap: 8px;
        }

        .feature-card-modern {
            padding: 12px 6px;
            gap: 6px;
        }

        .feature-icon {
            width: 42px;
            height: 42px;
        }

        .feature-name {
            font-size: 0.68rem;
        }

        .news-grid {
            grid-template-columns: 1fr;
            padding: 16px;
            gap: 16px;
        }

        .news-image-main {
            height: 180px;
        }

        .news-content-main {
            padding: 16px;
        }

        .news-title-main {
            font-size: 1.1rem;
        }

        .contact-section {
            padding: 28px 0;
        }

        .hero-carousel-wrapper,
        .feature-section,
        .news-section,
        .top-info-section,
        .youtube-carousel,
        .contact-section {
            margin-bottom: 28px;
        }

        .top-info-grid {
            gap: 0.5rem;
        }
        .top-info-card-img {
            min-height: 120px;
        }
        .top-info-card.featured .top-info-card-img {
            min-height: 160px;
        }
        .top-info-card-title {
            font-size: 0.7rem;
            margin-bottom: 0.2rem;
        }
        .top-info-card.featured .top-info-card-title {
            font-size: 0.85rem;
        }
        .top-info-card-overlay {
            padding: 0.6rem;
        }
        .top-info-card-cat {
            font-size: 0.5rem;
            padding: 0.1rem 0.3rem;
        }
        .top-info-btn.prev-btn { left: -8px; }
        .top-info-btn.next-btn { right: -8px; }
        .top-info-btn { width: 28px; height: 28px; font-size: 11px; }
    }

    @media (max-width: 480px) {
        .single-hero-slide {
            height: 220px;
        }

        .slide-content h4 {
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .slide-content p {
            font-size: 0.72rem;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .btn-hero {
            padding: 8px 18px;
            font-size: 0.78rem;
        }

        .desc-desktop { display: none !important; }
        .desc-mobile { display: block !important; }

        .feature-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
        }

        .feature-card-modern {
            width: 28%;
            padding: 10px 6px;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
        }

        .hero-carousel-wrapper,
        .feature-section,
        .news-section,
        .top-info-section,
        .youtube-carousel,
        .contact-section {
            margin-bottom: 24px;
        }

        .section-header {
            padding: 14px 18px;
        }

        .section-header h4 {
            font-size: 1rem;
        }
    }

    /* ===== ALERT MODERN ===== */
    .alert-modern {
        padding: 14px 18px;
        border-radius: var(--radius-md);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideDown 0.3s ease;
        font-size: 0.9rem;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.08);
        color: #16a34a;
        border-left: 3px solid #22c55e;
    }

    .alert-warning {
        background: rgba(251, 191, 36, 0.08);
        color: #d97706;
        border-left: 3px solid #fbbf24;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .desc-mobile { display: none; }

    /* ===== FOOTER ===== */
    .footer {
        background: linear-gradient(135deg, #003a8c 0%, #0284c7 100%);
        color: var(--white);
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }
    .footer-main {
        position: relative;
        padding: 40px 0 24px;
    }
    .footer-simple-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 32px;
    }
    .footer-simple-left {
        flex: 1;
    }
    .footer-simple-right {
        text-align: right;
        min-width: 280px;
    }
    .footer-contact-inline {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.8;
        margin-bottom: 16px;
    }
    .footer-contact-inline i {
        margin-right: 4px;
        margin-left: 6px;
        color: rgba(255, 255, 255, 0.6);
    }
    .footer-white-bar {
        background-color: var(--white);
        color: #6b7280;
        text-align: center;
        padding: 10px 15px;
        font-size: 0.8rem;
        width: 100%;
        border-top: 1px solid var(--gray-200);
        margin-bottom: 50px;
    }
    .footer-widget-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--white);
    }
    .social-links {
        display: flex;
        gap: 8px;
    }
    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-sm);
        color: var(--white);
        transition: all 0.3s ease;
    }
    .social-link:hover {
        background: var(--white);
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    @media (max-width: 1024px) {
        .footer-simple-flex {
            flex-direction: column-reverse;
            align-items: center;
            gap: 20px;
        }
        .footer-simple-right {
            text-align: center;
        }
        .social-links {
            justify-content: center !important;
        }
        .footer-simple-right .footer-widget-title {
            text-align: center !important;
        }
        .footer-contact-inline {
            text-align: center;
        }
    }
</style>

<div class="section">
    <!-- Hero Carousel -->
    <div class="container">
        <div class="hero-carousel-wrapper">
            <div class="owl-carousel owl-carousel-one">
                @forelse($datalayanan as $layanan)
                    @php
                        $bgImage = isset($layanan['image']) && $layanan['image'] ? env('MAA_WEB_URL', 'http://localhost:8001') . '/storage/' . $layanan['image'] : asset('apk/assets/img/bg-img/maa.jpg');
                    @endphp
                    <div class="single-hero-slide" style="background-image: url('{{ $bgImage }}')">
                        <div class="slide-content h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h4>{{ $layanan['name'] ?? 'Layanan Masjid' }}</h4>
                                <p class="desc-desktop">{{ Str::limit(strip_tags($layanan['description'] ?? ''), 150) }}</p>
                                <p class="desc-mobile">{{ Str::words(strip_tags($layanan['description'] ?? ''), 8, '...') }}</p>
                                <a class="btn-hero" href="/dashboard/layanan/{{ $layanan['slug'] ?? '#' }}">
                                    <i class="fa fa-arrow-right"></i>
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Slide 1 Default -->
                    <div class="single-hero-slide" style="background-image: url('{{ asset('apk/assets/img/bg-img/maa.jpg') }}')">
                        <div class="slide-content h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h4>Ta'aruf Jodohku v.2.0</h4>
                                <p class="desc-desktop">Temukan pasangan sempurna anda diantara karyawan YPI Al Azhar melalui aplikasi ini.</p>
                                <p class="desc-mobile">Temukan pasangan sempurna anda diantara...</p>
                                <a class="btn-hero" href="/taaruf">
                                    <i class="fa fa-heart"></i>
                                    Lanjutkan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>



    <!-- News Section -->
    <div class="container news-section">
        <div class="section-header">
            <h4>Berita & Artikel</h4>
        </div>

        @if ($databerita->count() > 0)
            <div class="news-grid">
                <!-- Main News -->
                <div class="news-card-main">
                    @php
                        $mainNews = $databerita->first();
                        $mainPath = $mainNews->foto ? $mainNews->foto : asset('assets/img/preview.png');
                    @endphp
                    <img src="{{ $mainPath }}" alt="{{ $mainNews->judul }}" class="news-image-main">
                    <div class="news-content-main">
                        <h3 class="news-title-main">{{ $mainNews->judul }}</h3>
                        <p class="news-subtitle-main">{{ Str::limit(strip_tags($mainNews->subjudul), 150) }}</p>
                        <a href="/dashboard/berita/{{ $mainNews->slug ?? '#' }}" class="btn-news">
                            Selengkapnya
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar News -->
                <div class="news-sidebar">
                    @foreach ($databerita->skip(1)->take(4) as $news)
                        @php
                            $newsPath = $news->foto ? $news->foto : asset('assets/img/preview.png');
                        @endphp
                        <a href="/dashboard/berita/{{ $news->slug ?? '#' }}" class="news-card-small">
                            <img src="{{ $newsPath }}" alt="{{ $news->judul }}" class="news-image-small">
                            <div class="news-content-small">
                                <p class="news-subtitle-small">{{ Str::limit(strip_tags($news->subjudul), 60) }}</p>
                                <span class="news-link-small">Baca Selengkapnya →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container">
                <p style="text-align: center; color: var(--gray-600); padding: 40px 0;">Tidak ada berita yang tersedia.</p>
            </div>
        @endif
    </div>

    <!-- Banner Section -->
    @if(isset($dataslider) && $dataslider->count() > 0)
    <div class="container">
        <div class="top-info-section">
            <div class="top-info-slider-wrapper" style="position: relative;">
                <div class="top-info-nav">
                    <button class="top-info-btn prev-btn"><i class="fa fa-chevron-left"></i></button>
                    <button class="top-info-btn next-btn"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="top-info-grid" id="topInfoGrid">
                    @foreach ($dataslider as $index => $slider)
                    @php
                        $bannerImage = $slider->image ? env('MAA_WEB_URL', 'http://localhost:8001') . '/storage/' . $slider->image : asset('apk/assets/img/bg-img/maa.jpg');
                    @endphp
                    <a href="{{ $slider->button_link ?? '#' }}" class="top-info-card {{ $index === 1 ? 'featured' : '' }}">
                        <img src="{{ $bannerImage }}" alt="{{ $slider->title ?? 'Banner' }}" class="top-info-card-img">
                        <div class="top-info-card-overlay">
                            @if(isset($slider->button_text) && $slider->button_text)
                            <div class="top-info-card-categories">
                                <span class="top-info-card-cat">{{ $slider->button_text }}</span>
                            </div>
                            @endif
                            <h3 class="top-info-card-title">{{ $slider->title ?? '' }}</h3>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- YouTube Section -->
    @if($datayoutube->count() > 0)
        <div class="container">
            <div class="youtube-carousel">
                <div class="owl-carousel testimonial-slide">
                    @foreach ($datayoutube as $video)
                        <a href="{{ $video->link }}" target="_blank" class="youtube-item">
                            @php
                                $videoPath = (isset($video->gambar) && strpos($video->gambar, 'http') === 0) 
                                             ? $video->gambar 
                                             : (isset($video->gambar) && $video->gambar 
                                                ? Storage::url('uploads/youtube/' . $video->gambar) 
                                                : asset('assets/img/preview.png'));
                            @endphp
                            <img src="{{ $videoPath }}" alt="YouTube Video" class="youtube-thumbnail">
                            <div class="youtube-play-overlay">
                                <i class="fa fa-play"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Contact Section -->
    <div class="container">
        <div class="contact-section">
            <h4 class="contact-title">Kontak Kami</h4>
            <div class="container">
                @if (Session::get('success'))
                    <div class="alert-modern alert-success">
                        <i class="fa fa-check-circle"></i>
                        {{ Session::get('success') }}
                    </div>
                @endif
                
                @if (Session::get('warning'))
                    <div class="alert-modern alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        {{ Session::get('warning') }}
                    </div>
                @endif

                <form action="/daftartanya/storetanya" method="POST" class="contact-form-modern">
                    @csrf
                    <div class="form-group-modern">
                        <input type="email" 
                               name="email" 
                               class="form-control-modern" 
                               placeholder="Masukkan email Anda" 
                               required>
                    </div>
                    <div class="form-group-modern">
                        <textarea name="pertanyaan" 
                                  class="form-control-modern" 
                                  rows="5" 
                                  placeholder="Tulis pertanyaan Anda" 
                                  required></textarea>
                    </div>
                    <button type="submit" class="btn-submit-modern">
                        <i class="fa fa-paper-plane"></i>
                        Kirim Pertanyaan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="container map-section">
        <div class="section-header">
            <h4>Lokasi Kami</h4>
        </div>
        <div class="map-wrapper">
            <iframe src="https://maps.google.com/maps?q=masjid%20agung%20al%20azhar&t=k&z=19&ie=UTF8&iwloc=&output=embed" 
                    loading="lazy"></iframe>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-simple-flex">
                    <div class="footer-simple-left">
                        <div class="footer-contact-inline" style="font-size: 1rem;">
                            <strong>Copyright © 2024</strong><br>
                            Direktorat Dakwah Sosial YPI Al Azhar<br>
                            <small style="opacity: 0.8;">Created by <a href="https://www.instagram.com/donsiyos/" target="_blank" rel="noopener" style="color: inherit; text-decoration: none; font-weight: 600;">DAL Army</a></small>
                        </div>
                    </div>

                    <div class="footer-simple-right">
                        <h4 class="footer-widget-title" style="border-bottom: none; margin-bottom: 10px; padding-bottom: 0;">Unit & Layanan YPI Al Azhar:</h4>
                        <div class="social-links" style="justify-content: flex-end;">
                            <a href="https://www.al-azhar.or.id/" target="_blank" rel="noopener" class="social-link" title="YPI Al Azhar">
                                <img src="{{ asset('apk/assets/img/demo-img/logoypi.png') }}" alt="YPI" style="width: 24px; height: 24px; object-fit: contain;">
                            </a>
                            <a href="https://www.masjidagungalazhar.com/" target="_blank" rel="noopener" class="social-link" title="Masjid Al Azhar">
                                <img src="{{ asset('apk/assets/img/demo-img/logomaa.png') }}" alt="MAA" style="width: 24px; height: 24px; object-fit: contain;">
                            </a>
                            <a href="https://alazharpeduli.or.id/" target="_blank" rel="noopener" class="social-link" title="LAZ Al Azhar">
                                <img src="{{ asset('apk/assets/img/demo-img/logolaz.png') }}" alt="LAZ" style="width: 24px; height: 24px; object-fit: contain;">
                            </a>
                            <a href="https://wakafalazhar.com/" target="_blank" rel="noopener" class="social-link" title="Wakaf Al Azhar">
                                <img src="{{ asset('apk/assets/img/demo-img/logowakaf.png') }}" alt="Wakaf" style="width: 24px; height: 24px; object-fit: contain;">
                            </a>
                            <a href="https://www.instagram.com/abhalazhar/?hl=id" target="_blank" rel="noopener" class="social-link" title="Aula Buya Hamka">
                                <img src="{{ asset('apk/assets/img/demo-img/abh.png') }}" alt="ABH" style="width: 24px; height: 24px; object-fit: contain;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div style="height: 4px; width: 100%; background: linear-gradient(90deg, var(--primary-color) 0%, #10b981 33%, #f59e0b 66%, #ef4444 100%);"></div>

</div>
@endsection

@push('myscript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const topInfoGrid = document.getElementById('topInfoGrid');
        const desktopPrevBtn = document.querySelector('.top-info-nav .prev-btn');
        const desktopNextBtn = document.querySelector('.top-info-nav .next-btn');

        if (topInfoGrid && desktopPrevBtn && desktopNextBtn) {
            let isAnimating = false;

            function rotateTopInfo(direction) {
                if (isAnimating) return;
                isAnimating = true;

                const cards = Array.from(topInfoGrid.querySelectorAll('.top-info-card'));
                if (cards.length < 4) {
                    isAnimating = false;
                    return;
                }

                // Fade out
                cards.forEach(card => {
                    card.style.transition = 'opacity 0.4s ease';
                    card.style.opacity = '0';
                });
                
                setTimeout(() => {
                    // Reorder DOM
                    if (direction === 'next') {
                        topInfoGrid.appendChild(cards[0]);
                    } else {
                        topInfoGrid.prepend(cards[cards.length - 1]);
                    }

                    // Update featured class
                    const newCards = Array.from(topInfoGrid.querySelectorAll('.top-info-card'));
                    newCards.forEach(card => card.classList.remove('featured'));
                    newCards[1].classList.add('featured');

                    // Small delay to allow DOM to recalculate before fading in
                    setTimeout(() => {
                        newCards.forEach(card => card.style.opacity = '1');
                        isAnimating = false;
                    }, 50);
                }, 400); // Wait for fade out
            }

            desktopNextBtn.addEventListener('click', () => rotateTopInfo('next'));
            desktopPrevBtn.addEventListener('click', () => rotateTopInfo('prev'));
            
            // Auto-play
            let topInfoInterval = setInterval(() => {
                rotateTopInfo('next');
            }, 6000);

            // Pause on hover
            topInfoGrid.addEventListener('mouseenter', () => clearInterval(topInfoInterval));
            topInfoGrid.addEventListener('mouseleave', () => {
                topInfoInterval = setInterval(() => {
                    rotateTopInfo('next');
                }, 6000);
            });
        }
    });
</script>
@endpush