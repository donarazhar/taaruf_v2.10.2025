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
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* ===== GLOBAL BACKGROUND ===== */
    body {
        background-color: #FFFFFF !important;
    }

    .section {
        background-color: #FFFFFF;
    }

    /* ===== HERO CAROUSEL MODERN ===== */
    .hero-carousel-wrapper {
        margin-bottom: 32px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .single-hero-slide {
        position: relative;
        height: 400px;
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
        background: linear-gradient(135deg, rgba(0, 83, 197, 0.8) 0%, rgba(0, 102, 255, 0.6) 100%);
    }

    .slide-content {
        position: relative;
        z-index: 2;
        padding: 40px 20px;
    }

    .slide-content h4 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 16px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .slide-content p {
        font-size: 1.1rem;
        color: var(--white);
        margin-bottom: 24px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 0 1px 4px rgba(0,0,0,0.3);
    }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 32px;
        background: var(--white);
        color: var(--primary-color);
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .btn-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 83, 197, 0.4);
        background: var(--primary-color);
        color: var(--white);
    }

    /* ===== FEATURE CARDS ===== */
    .feature-section {
        margin-bottom: 40px;
    }

    .feature-section-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-color);
        text-align: center;
        margin-bottom: 24px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .feature-card-modern {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .feature-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--gray-200);
        transition: all 0.3s ease;
    }

    .feature-card-modern:hover .feature-icon {
        border-color: var(--primary-color);
        transform: scale(1.05);
    }

    .feature-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .feature-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
    }

    /* ===== NEWS SECTION ===== */
    .news-section {
        margin-bottom: 40px;
    }

    .section-header {
        padding: 24px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        margin-bottom: 24px;
    }

    .section-header h4 {
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
        text-align: center;
    }

    .news-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    .news-card-main {
        background: var(--white);
        border: 2px solid var(--gray-200);
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
        height: 300px;
        object-fit: cover;
    }

    .news-content-main {
        padding: 24px;
    }

    .news-title-main {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .news-subtitle-main {
        font-size: 1rem;
        color: var(--gray-700);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .btn-news {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border-radius: var(--radius-md);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-news:hover {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: var(--white);
    }

    .news-sidebar {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .news-card-small {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 12px;
        display: flex;
        gap: 12px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .news-card-small:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-sm);
    }

    .news-image-small {
        width: 80px;
        height: 80px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        flex-shrink: 0;
    }

    .news-content-small {
        flex: 1;
    }

    .news-subtitle-small {
        font-size: 0.85rem;
        color: var(--gray-700);
        line-height: 1.4;
        margin-bottom: 6px;
    }

    .news-link-small {
        font-size: 0.8rem;
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none;
    }

    /* ===== HADITS CARD ===== */
    .hadits-card {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 32px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-lg);
    }

    .hadits-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 16px;
    }

    .hadits-content {
        font-size: 1rem;
        color: var(--white);
        line-height: 1.8;
        text-align: justify;
        font-style: italic;
    }

    /* ===== YOUTUBE SECTION ===== */
    .youtube-carousel {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 24px;
        margin-bottom: 32px;
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
        height: auto;
        display: block;
    }

    .youtube-play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        box-shadow: 0 4px 12px rgba(0, 83, 197, 0.4);
    }

    .youtube-play-overlay i {
        color: white;
        font-size: 24px;
        margin-left: 4px;
    }

    /* ===== CONTACT SECTION ===== */
    .contact-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 40px 0;
        border-radius: var(--radius-lg);
        margin-bottom: 32px;
        box-shadow: var(--shadow-lg);
    }

    .contact-title {
        font-size: 1.5rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 24px;
    }

    .contact-form-modern {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group-modern {
        margin-bottom: 20px;
    }

    .form-control-modern {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.1);
        color: var(--white);
        border-radius: var(--radius-md);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--white);
        background: rgba(255, 255, 255, 0.15);
    }

    .form-control-modern::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    textarea.form-control-modern {
        min-height: 120px;
        resize: vertical;
    }

    .btn-submit-modern {
        width: 100%;
        padding: 14px 32px;
        background: var(--white);
        color: var(--primary-color);
        border: none;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255,255,255,0.3);
    }

    /* ===== MAP SECTION ===== */
    .map-section {
        margin-bottom: 32px;
    }

    .map-wrapper {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 2px solid var(--gray-200);
        height: 400px;
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
        padding: 24px 0;
        text-align: center;
        border-radius: var(--radius-lg);
        margin-bottom: 20px;
    }

    .copyright-text {
        font-size: 0.85rem;
        margin: 0;
        line-height: 1.6;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .single-hero-slide {
            height: 300px;
        }

        .slide-content h4 {
            font-size: 1.5rem;
        }

        .slide-content p {
            font-size: 0.95rem;
        }

        .feature-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
        }

        .feature-name {
            font-size: 0.75rem;
        }

        .news-grid {
            grid-template-columns: 1fr;
        }

        .news-image-main {
            height: 200px;
        }

        .news-content-main {
            padding: 20px;
        }

        .news-title-main {
            font-size: 1.25rem;
        }

        .hadits-card {
            padding: 24px;
        }

        .contact-section {
            padding: 32px 0;
        }
    }

    @media (max-width: 480px) {
        .single-hero-slide {
            height: 250px;
        }

        .feature-grid {
            gap: 10px;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
        }

        .feature-card-modern {
            padding: 12px;
        }
    }

    /* ===== ALERT MODERN ===== */
    .alert-modern {
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideDown 0.3s ease;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.1);
        color: #16a34a;
        border-left: 4px solid #22c55e;
    }

    .alert-warning {
        background: rgba(251, 191, 36, 0.1);
        color: #d97706;
        border-left: 4px solid #fbbf24;
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
</style>

<div class="section">
    <!-- Hero Carousel -->
    <div class="container">
        <div class="hero-carousel-wrapper">
            <div class="owl-carousel owl-carousel-one">
                <!-- Slide 1 -->
                <div class="single-hero-slide" style="background-image: url('{{ asset('apk/assets/img/bg-img/maa.jpg') }}')">
                    <div class="slide-content h-100 d-flex align-items-center text-center">
                        <div class="container">
                            <h4>Ta'aruf Jodohku v.2.0</h4>
                            <p>Temukan pasangan sempurna anda diantara karyawan YPI Al Azhar melalui aplikasi ini.</p>
                            <a class="btn-hero" href="/taaruf">
                                <i class="fa fa-heart"></i>
                                Lanjutkan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="single-hero-slide" style="background-image: url('{{ asset('apk/assets/img/bg-img/nikah.jpg') }}')">
                    <div class="slide-content h-100 d-flex align-items-center text-center">
                        <div class="container">
                            <h4>Aula Buya Hamka</h4>
                            <p>Masjid Agung Al Azhar menyediakan aula serba guna untuk acara yang anda niatkan.</p>
                            <a class="btn-hero" href="https://www.instagram.com/abhalazhar/?hl=id" target="_blank">
                                <i class="fa fa-building"></i>
                                Lanjutkan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="single-hero-slide" style="background-image: url('{{ asset('apk/assets/img/bg-img/konsul.jpg') }}')">
                    <div class="slide-content h-100 d-flex align-items-center text-center">
                        <div class="container">
                            <h4>Layanan Konsultasi</h4>
                            <p>Konsultasikan semua permasalahan anda bersama ustadz di Masjid Agung Al Azhar.</p>
                            <a class="btn-hero" href="https://wa.link/w2hf7i" target="_blank">
                                <i class="fa fa-comments"></i>
                                Lanjutkan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="container feature-section">
        <h5 class="feature-section-title">Unit & Layanan YPI Al Azhar</h5>
        <div class="feature-grid">
            <a href="https://www.al-azhar.or.id/" target="_blank" class="feature-card-modern">
                <div class="feature-icon">
                    <img src="{{ asset('apk/assets/img/demo-img/logoypi.png') }}" alt="YPI Al Azhar">
                </div>
                <p class="feature-name">YPI Al Azhar</p>
            </a>

            <a href="https://www.masjidagungalazhar.com/" target="_blank" class="feature-card-modern">
                <div class="feature-icon">
                    <img src="{{ asset('apk/assets/img/demo-img/logomaa.png') }}" alt="MAA">
                </div>
                <p class="feature-name">Masjid Al Azhar</p>
            </a>

            <a href="https://alazharpeduli.or.id/" target="_blank" class="feature-card-modern">
                <div class="feature-icon">
                    <img src="{{ asset('apk/assets/img/demo-img/logolaz.png') }}" alt="LAZ">
                </div>
                <p class="feature-name">LAZ Al Azhar</p>
            </a>

            <a href="https://wakafalazhar.com/" target="_blank" class="feature-card-modern">
                <div class="feature-icon">
                    <img src="{{ asset('apk/assets/img/demo-img/logowakaf.png') }}" alt="Wakaf">
                </div>
                <p class="feature-name">Wakaf Al Azhar</p>
            </a>

            <a href="https://donasi.online/masjid-agung-al-azhar/program" target="_blank" class="feature-card-modern">
                <div class="feature-icon">
                    <img src="{{ asset('apk/assets/img/demo-img/donasi.png') }}" alt="Donasi">
                </div>
                <p class="feature-name">Donasi MAA</p>
            </a>

            <a href="https://www.instagram.com/abhalazhar/?hl=id" target="_blank" class="feature-card-modern">
                <div class="feature-icon">
                    <img src="{{ asset('apk/assets/img/demo-img/abh.png') }}" alt="ABH">
                </div>
                <p class="feature-name">Aula Buya Hamka</p>
            </a>
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
                        $mainPath = $mainNews->foto ? Storage::url('uploads/berita/' . $mainNews->foto) : asset('assets/img/preview.png');
                    @endphp
                    <img src="{{ $mainPath }}" alt="{{ $mainNews->judul }}" class="news-image-main">
                    <div class="news-content-main">
                        <h3 class="news-title-main">{{ $mainNews->judul }}</h3>
                        <p class="news-subtitle-main">{{ $mainNews->subjudul }}</p>
                        <a href="/masterberita/berita/{{ $mainNews->id }}" class="btn-news">
                            Selengkapnya
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar News -->
                <div class="news-sidebar">
                    @foreach ($databerita->skip(1)->take(4) as $news)
                        @php
                            $newsPath = $news->foto ? Storage::url('uploads/berita/' . $news->foto) : asset('assets/img/preview.png');
                        @endphp
                        <a href="/masterberita/berita/{{ $news->id }}" class="news-card-small">
                            <img src="{{ $newsPath }}" alt="{{ $news->judul }}" class="news-image-small">
                            <div class="news-content-small">
                                <p class="news-subtitle-small">{{ Str::limit($news->subjudul, 60) }}</p>
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

    <!-- Hadits Section -->
    <div class="container">
        <div class="hadits-card">
            <h2 class="hadits-title">Hadits Harian</h2>
            <p class="hadits-content">
                "Rasulullah Shallallahu 'alaihi Wasallam bersabda: Semoga Allah merahmati seorang laki-laki yang bangun di malam hari lalu dia melaksanakan shalat (malam), kemudian dia membangunkan istrinya, kalau istrinya enggan maka dia akan memercikkan air pada wajahnya."
                <br><br>
                <small>(HR Abu Dawud (no. 1308) dan Ibnu Majah (no. 1336), dinyatakan shahih oleh Syaikh al-Albani)</small>
            </p>
        </div>
    </div>

    <!-- YouTube Section -->
    @if($datayoutube->count() > 0)
        <div class="container">
            <div class="youtube-carousel">
                <div class="owl-carousel testimonial-slide">
                    @foreach ($datayoutube as $video)
                        <a href="{{ $video->link }}" target="_blank" class="youtube-item">
                            @php
                                $videoPath = $video->gambar ? Storage::url('uploads/youtube/' . $video->gambar) : asset('assets/img/preview.png');
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

    <!-- Footer Copyright -->
    <div class="container">
        <div class="copyright-section">
            <p class="copyright-text">
                <strong>Copyright © 2024</strong><br>
                Direktorat Dakwah Sosial YPI Al Azhar<br>
                <small>Created by DAL Army</small>
            </p>
        </div>
    </div>
</div>
@endsection