@extends('dashboard.dashlayouts.berita')

<style>
    /* ===== MODERN BLOG DETAIL STYLES ===== */
    :root {
        --black: #000000;
        --gray-900: #1A1A1A;
        --gray-800: #2D2D2D;
        --gray-700: #404040;
        --gray-600: #666666;
        --gray-500: #808080;
        --gray-400: #999999;
        --gray-300: #CCCCCC;
        --gray-200: #E5E5E5;
        --gray-100: #F5F5F5;
        --white: #FFFFFF;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 24px;
    }

    .page-content-wrapper {
        background: var(--white);
        min-height: 100vh;
        padding-bottom: 60px;
    }

    /* ===== HEADER SPACING ===== */
    .blog-header-spacing {
        height: 80px;
    }

    /* ===== BLOG THUMBNAIL ===== */
    .blog-thumbnail-wrapper {
        margin-bottom: 32px;
        position: relative;
    }

    .blog-thumbnail {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        border: 2px solid var(--gray-200);
    }

    .blog-thumbnail-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        padding: 32px 24px;
        border-radius: 0 0 var(--radius-lg) var(--radius-lg);
    }

    /* ===== BLOG CONTENT ===== */
    .blog-content-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ===== BADGE ===== */
    .blog-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--black);
        color: var(--white);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .blog-badge:hover {
        background: var(--gray-900);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: var(--white);
    }

    .blog-badge i {
        font-size: 0.9rem;
    }

    /* ===== BLOG TITLE ===== */
    .blog-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--black);
        line-height: 1.3;
        margin-bottom: 24px;
        letter-spacing: -0.02em;
    }

    /* ===== AUTHOR INFO ===== */
    .author-info {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        background: var(--gray-50);
        border-radius: var(--radius-md);
        margin-bottom: 32px;
        border: 2px solid var(--gray-200);
    }

    .author-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 3px solid var(--white);
        box-shadow: var(--shadow-sm);
        object-fit: cover;
    }

    .author-details {
        flex: 1;
    }

    .author-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--black);
        margin: 0;
    }

    .author-role {
        font-size: 0.85rem;
        color: var(--gray-600);
        margin-top: 2px;
    }

    .author-date {
        font-size: 0.85rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 4px;
    }

    .author-date i {
        font-size: 0.9rem;
    }

    /* ===== BLOG CONTENT ===== */
    .blog-content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--gray-800);
        text-align: justify;
    }

    .blog-content p {
        margin-bottom: 20px;
    }

    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4,
    .blog-content h5,
    .blog-content h6 {
        color: var(--black);
        font-weight: 700;
        margin-top: 32px;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .blog-content h2 {
        font-size: 1.8rem;
    }

    .blog-content h3 {
        font-size: 1.5rem;
    }

    .blog-content h4 {
        font-size: 1.25rem;
    }

    .blog-content strong,
    .blog-content b {
        font-weight: 700;
        color: var(--black);
    }

    .blog-content a {
        color: var(--black);
        font-weight: 600;
        text-decoration: underline;
        transition: all 0.3s ease;
    }

    .blog-content a:hover {
        color: var(--gray-700);
    }

    .blog-content ul,
    .blog-content ol {
        margin-bottom: 20px;
        padding-left: 32px;
    }

    .blog-content li {
        margin-bottom: 8px;
    }

    .blog-content blockquote {
        border-left: 4px solid var(--black);
        padding: 16px 24px;
        background: var(--gray-50);
        margin: 24px 0;
        font-style: italic;
        color: var(--gray-700);
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--radius-md);
        margin: 24px 0;
        box-shadow: var(--shadow-md);
    }

    .blog-content code {
        background: var(--gray-100);
        padding: 2px 8px;
        border-radius: var(--radius-sm);
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
        color: var(--gray-900);
    }

    .blog-content pre {
        background: var(--gray-900);
        color: var(--white);
        padding: 20px;
        border-radius: var(--radius-md);
        overflow-x: auto;
        margin: 24px 0;
    }

    .blog-content pre code {
        background: transparent;
        padding: 0;
        color: var(--white);
    }

    /* ===== DIVIDER ===== */
    .blog-divider {
        height: 2px;
        background: var(--gray-200);
        margin: 40px 0;
        border: none;
    }

    /* ===== SHARE SECTION ===== */
    .share-section {
        padding: 24px;
        background: var(--gray-50);
        border-radius: var(--radius-md);
        margin-top: 40px;
        border: 2px solid var(--gray-200);
    }

    .share-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--black);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .share-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        background: var(--black);
        color: var(--white);
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .share-btn:hover {
        background: var(--gray-900);
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        color: var(--white);
    }

    .share-btn i {
        font-size: 1.1rem;
    }

    /* ===== BACK BUTTON ===== */
    .back-to-list {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--gray-100);
        color: var(--gray-900);
        border-radius: var(--radius-md);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 32px;
    }

    .back-to-list:hover {
        background: var(--black);
        color: var(--white);
        transform: translateX(-4px);
    }

    .back-to-list i {
        font-size: 1rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .blog-header-spacing {
            height: 60px;
        }

        .blog-title {
            font-size: 1.8rem;
        }

        .blog-thumbnail {
            max-height: 280px;
        }

        .blog-content {
            font-size: 1rem;
        }

        .blog-content h2 {
            font-size: 1.5rem;
        }

        .blog-content h3 {
            font-size: 1.25rem;
        }

        .author-info {
            padding: 16px;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
        }

        .share-section {
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .blog-title {
            font-size: 1.5rem;
        }

        .blog-content {
            font-size: 0.95rem;
        }

        .blog-thumbnail {
            border-radius: var(--radius-md);
        }
    }
</style>

<div class="page-content-wrapper">
    <!-- Header Spacing -->
    <div class="blog-header-spacing"></div>

    <div class="container">
        <!-- Back Button -->
        <a href="/berita" class="back-to-list">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Berita
        </a>

        <!-- Blog Thumbnail -->
        <div class="blog-thumbnail-wrapper">
            @if ($databerita->foto)
                @php
                    $path = Storage::url('uploads/berita/' . $databerita->foto);
                @endphp
                <img class="blog-thumbnail" src="{{ $path }}" alt="{{ $databerita->judul }}">
            @else
                <img class="blog-thumbnail" src="{{ asset('assets/img/preview.png') }}" alt="No Image">
            @endif
        </div>

        <!-- Blog Content -->
        <div class="blog-content-container">
            <!-- Badge -->
            <a class="blog-badge" href="/berita">
                <i class="fas fa-newspaper"></i>
                Berita & Artikel
            </a>

            <!-- Title -->
            <h1 class="blog-title">{{ $databerita->judul }}</h1>

            <!-- Author Info -->
            <div class="author-info">
                <img class="author-avatar" src="{{ asset('apk/assets/img/demo-img/logoypi.png') }}" alt="Admin">
                <div class="author-details">
                    <h5 class="author-name">Administrator</h5>
                    <p class="author-role">Tim Redaksi YPI Al Azhar</p>
                    <div class="author-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{-- <span>{{ $databerita->created_at ? $databerita->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}</span> --}}
                    </div>
                </div>
            </div>

            <!-- Sub Judul (if exists) -->
            @if($databerita->subjudul)
                <div style="background: var(--gray-50); padding: 20px; border-radius: var(--radius-md); border-left: 4px solid var(--black); margin-bottom: 32px;">
                    <p style="font-size: 1.15rem; font-weight: 600; color: var(--gray-800); margin: 0; font-style: italic;">
                        {{ $databerita->subjudul }}
                    </p>
                </div>
            @endif

            <!-- Blog Content -->
            <div class="blog-content">
                {!! $databerita->isi !!}
            </div>

            <!-- Divider -->
            <hr class="blog-divider">

            <!-- Share Section -->
            <div class="share-section">
                <h5 class="share-title">
                    <i class="fas fa-share-alt"></i>
                    Bagikan Artikel
                </h5>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="share-btn" 
                       title="Bagikan ke Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($databerita->judul) }}" 
                       target="_blank" 
                       class="share-btn" 
                       title="Bagikan ke Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($databerita->judul . ' - ' . url()->current()) }}" 
                       target="_blank" 
                       class="share-btn" 
                       title="Bagikan ke WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="share-btn" 
                       title="Bagikan ke LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="mailto:?subject={{ urlencode($databerita->judul) }}&body={{ urlencode('Baca artikel ini: ' . url()->current()) }}" 
                       class="share-btn" 
                       title="Bagikan via Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            <!-- Link to Original (if exists) -->
            @if($databerita->link)
                <div style="margin-top: 24px; padding: 20px; background: var(--gray-50); border-radius: var(--radius-md); border: 2px solid var(--gray-200);">
                    <p style="margin: 0; font-size: 0.9rem; color: var(--gray-600);">
                        <i class="fas fa-external-link-alt"></i>
                        <strong>Link Sumber:</strong>
                        <a href="{{ $databerita->link }}" target="_blank" style="color: var(--black); font-weight: 600;">
                            Buka artikel asli
                            <i class="fas fa-arrow-right" style="font-size: 0.8rem; margin-left: 4px;"></i>
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>