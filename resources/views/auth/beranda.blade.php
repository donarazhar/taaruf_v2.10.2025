@extends('layouts.bootstrap')
@section('content')
    <style>
        /* ===== MODERN DESIGN SYSTEM ===== */
        :root {
            --primary: #0053C5;
            --primary-light: #2E7FE4;
            --primary-dark: #003D8F;
            --accent: #00B8D4;
            --success: #00C853;
            --warning: #FFD600;
            --white: #FFFFFF;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #EEEEEE;
            --gray-300: #E0E0E0;
            --gray-600: #757575;
            --gray-900: #212121;
            --shadow-sm: 0 2px 4px rgba(0, 83, 197, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 83, 197, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 83, 197, 0.16);
            --shadow-xl: 0 16px 48px rgba(0, 83, 197, 0.2);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--white);
            color: var(--gray-900);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ===== MODERN HERO SECTION ===== */
        #hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            overflow: hidden;
        }

        #hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 100px 0 80px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            color: var(--white);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 600px;
        }

        .hero-image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image-wrapper img {
            max-width: 50%;
            height: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-primary-modern {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--white);
            color: var(--primary);
            padding: 16px 32px;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-lg);
            border: none;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
            color: var(--primary-dark);
        }

        .btn-secondary-modern {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: var(--white);
            padding: 16px 32px;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-secondary-modern:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 60px rgba(0, 0, 0, 0.3));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .hero-decoration {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 100px;
            background: var(--white);
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        /* Add spacing on mobile */
        @media (max-width: 991px) {
            .hero-content-wrapper {
                padding: 0 20px;
            }
        }

        /* ===== MODERN SECTION STYLING ===== */
        section {
            padding: 100px 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-badge {
            display: inline-block;
            background: rgba(0, 83, 197, 0.1);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .section-description {
            font-size: 1.125rem;
            color: var(--gray-600);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* ===== MODERN FEATURE CARDS ===== */
        .feature-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid var(--gray-200);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            position: relative;
        }

        .feature-icon::after {
            content: '';
            position: absolute;
            inset: -4px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius-lg);
            opacity: 0.2;
            z-index: -1;
            filter: blur(8px);
        }

        .feature-icon i {
            font-size: 32px;
            color: var(--white);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 12px;
        }

        .feature-description {
            color: var(--gray-600);
            line-height: 1.7;
            font-size: 1rem;
        }

        /* ===== MODERN STEP CARDS ===== */
        .step-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            border: 2px solid var(--gray-200);
            position: relative;
            transition: all 0.3s ease;
        }

        .step-number {
            position: absolute;
            top: -20px;
            left: 40px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--white);
            box-shadow: var(--shadow-md);
        }

        .step-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
        }

        .step-image {
            width: 100%;
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .step-image img {
            width: 100%;
            height: auto;
            transition: transform 0.6s ease;
        }

        .step-card:hover .step-image img {
            transform: scale(1.05);
        }

        .step-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 16px;
        }

        .step-description {
            color: var(--gray-600);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .step-list {
            list-style: none;
            padding: 0;
        }

        .step-list li {
            padding: 12px 0;
            color: var(--gray-900);
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .step-list li i {
            color: var(--success);
            font-size: 20px;
            margin-top: 2px;
        }

        /* ===== MODERN GALLERY ===== */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .gallery-item {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            aspect-ratio: 1;
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item:hover::after {
            opacity: 0.7;
        }

        /* ===== MODERN TESTIMONIALS ===== */
        .testimonial-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 2px solid var(--gray-200);
            transition: all 0.3s ease;
            height: 100%;
        }

        .testimonial-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-4px);
            border-color: var(--primary);
        }

        .testimonial-quote {
            color: var(--gray-600);
            font-size: 1.125rem;
            line-height: 1.8;
            margin-bottom: 24px;
            font-style: italic;
            position: relative;
            padding-left: 24px;
        }

        .testimonial-quote::before {
            content: '"';
            position: absolute;
            left: 0;
            top: -8px;
            font-size: 3rem;
            color: var(--primary);
            opacity: 0.2;
            font-family: Georgia, serif;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .testimonial-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .testimonial-info h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 4px;
        }

        .testimonial-info p {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .testimonial-stars {
            color: var(--warning);
            margin-top: 8px;
        }

        /* ===== MODERN FAQ ===== */
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--white);
            border-radius: var(--radius-lg);
            margin-bottom: 16px;
            border: 2px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: var(--primary);
        }

        .faq-question {
            padding: 24px 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: var(--gray-50);
        }

        .faq-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .faq-icon i {
            color: var(--white);
            font-size: 20px;
        }

        .faq-question-text {
            flex: 1;
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .faq-toggle {
            width: 32px;
            height: 32px;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .faq-toggle i {
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        .faq-answer {
            padding: 0 28px 24px 84px;
            color: var(--gray-600);
            line-height: 1.8;
        }

        /* ===== MODERN CONTACT SECTION ===== */
        .contact-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 2px solid var(--gray-200);
            height: 100%;
        }

        .contact-item {
            display: flex;
            align-items: start;
            gap: 20px;
            margin-bottom: 32px;
        }

        .contact-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-icon i {
            color: var(--white);
            font-size: 24px;
        }

        .contact-info h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 8px;
        }

        .contact-info p {
            color: var(--gray-600);
            line-height: 1.6;
        }

        .contact-form {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 2px solid var(--gray-200);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-control-modern {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.1);
        }

        textarea.form-control-modern {
            resize: vertical;
            min-height: 150px;
        }

        .submit-button {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-primary-modern,
            .btn-secondary-modern {
                width: 100%;
                justify-content: center;
            }

            .hero-image-wrapper img {
                max-width: 70%;
            }
        }

        @media (max-width: 768px) {
            #hero .container {
                padding-left: 24px;
                padding-right: 24px;
            }

            .hero-title {
                font-size: 2rem;
                padding: 0 8px;
            }

            .hero-subtitle {
                font-size: 1.125rem;
                padding: 0 8px;
            }

            .hero-badge {
                margin-left: 8px;
                margin-right: 8px;
            }

            .section-title {
                font-size: 1.75rem;
            }

            section {
                padding: 60px 0;
            }

            .feature-card,
            .step-card,
            .pricing-card {
                padding: 32px 24px;
            }

            .hero-content {
                padding: 60px 0 40px;
            }

            .hero-image-wrapper img {
                max-width: 80%;
            }
        }

        @media (max-width: 576px) {
            #hero .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .hero-title {
                font-size: 1.75rem;
                padding: 0 4px;
            }

            .hero-subtitle {
                font-size: 1rem;
                padding: 0 4px;
            }

            .hero-badge {
                font-size: 0.75rem;
                padding: 6px 16px;
                margin-left: 4px;
                margin-right: 4px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .hero-image-wrapper img {
                max-width: 90%;
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .text-primary {
            color: var(--primary) !important;
        }

        .bg-light-section {
            background: var(--gray-50);
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-32 {
            margin-bottom: 32px;
        }

        .mt-48 {
            margin-top: 48px;
        }
    </style>

    <!-- ===== HERO SECTION ===== -->
    <section id="hero">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="hero-badge">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 0L9.79611 5.52786H15.6085L10.9062 8.94427L12.7023 14.4721L8 11.0557L3.29772 14.4721L5.09383 8.94427L0.391548 5.52786H6.20389L8 0Z"
                                fill="currentColor" />
                        </svg>
                        Versi 3.0 - YPI Al Azhar Internal
                    </div>
                    <h1 class="hero-title">Temukan Pasangan Hidup yang Tepat</h1>
                    <p class="hero-subtitle">Platform ta'aruf modern yang menghubungkan pegawai YPI Al Azhar dengan
                        pendampingan profesional menuju pernikahan yang berkah dan bahagia.</p>
                    <div class="hero-buttons">
                        <a href="#about" class="btn-primary-modern">
                            Mulai Sekarang
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <a href="#contact" class="btn-secondary-modern">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image-wrapper">
                        <div class="hero-image">
                            <img src="{{ asset('assets/img/hero-img.png') }}" alt="Ta'aruf Jodohku">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-decoration"></div>
    </section>

    <main id="main">
        <!-- ===== FEATURES SECTION ===== -->
        <section id="about">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-badge">Keunggulan Kami</span>
                    <h2 class="section-title">Mengapa Memilih Ta'aruf Jodohku?</h2>
                    <p class="section-description">Platform ta'aruf yang aman, terpercaya, dan sesuai syariat dengan
                        pendampingan profesional untuk membantu Anda menemukan pasangan hidup yang tepat.</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bx bx-fingerprint"></i>
                            </div>
                            <h3 class="feature-title">Eksklusif untuk YPI Al Azhar</h3>
                            <p class="feature-description">Hanya pegawai YPI Al Azhar dengan NIP yang terdaftar yang dapat
                                mengakses platform ini. Memberikan rasa aman dan komunitas yang terpercaya untuk proses
                                ta'aruf Anda.</p>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bx bx-group"></i>
                            </div>
                            <h3 class="feature-title">Pembimbing Profesional</h3>
                            <p class="feature-description">Didampingi oleh konsultan dan pembimbing berpengalaman yang siap
                                membantu Anda di setiap tahap ta'aruf hingga menuju pernikahan yang berkah.</p>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bx bx-shield"></i>
                            </div>
                            <h3 class="feature-title">Privasi Terjamin</h3>
                            <p class="feature-description">Data pribadi Anda dijaga dengan sistem keamanan berlapis. Hanya
                                admin dan pembimbing resmi yang memiliki akses ke informasi Anda.</p>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bx bx-heart"></i>
                            </div>
                            <h3 class="feature-title">Fokus pada Pernikahan</h3>
                            <p class="feature-description">Platform ini dirancang dengan tujuan serius menuju pernikahan
                                yang sakinah, mawaddah, warahmah. Bukan sekadar kenalan, tapi menuju komitmen.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== STEPS SECTION ===== -->
        <section id="details" class="bg-light-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-badge">Cara Kerja</span>
                    <h2 class="section-title">Langkah Mudah Memulai Ta'aruf</h2>
                    <p class="section-description">Proses yang sederhana dan terstruktur untuk membantu Anda menemukan
                        pasangan hidup yang sesuai.</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="step-card">
                            <div class="step-number">1</div>
                            <div class="step-image">
                                <img src="{{ asset('assets/img/preview.png') }}" alt="Daftar Akun" class="img-fluid">
                            </div>
                            <h3 class="step-title">Buat Akun Ta'aruf</h3>
                            <p class="step-description">Daftarkan diri Anda dengan mudah menggunakan NIP pegawai YPI Al
                                Azhar yang valid.</p>
                            <ul class="step-list">
                                <li><i class="bi bi-check-circle-fill"></i> Pilih menu pendaftaran sesuai gender</li>
                                <li><i class="bi bi-check-circle-fill"></i> Masukkan NIP yang terdaftar</li>
                                <li><i class="bi bi-check-circle-fill"></i> Isi formulir data diri lengkap</li>
                                <li><i class="bi bi-check-circle-fill"></i> Tunggu verifikasi dari admin</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-card">
                            <div class="step-number">2</div>
                            <div class="step-image">
                                <img src="{{ asset('assets/img/preview.png') }}" alt="Lengkapi Profil" class="img-fluid">
                            </div>
                            <h3 class="step-title">Lengkapi Profil Anda</h3>
                            <p class="step-description">Isi profil dengan informasi yang jujur dan akurat untuk mendapatkan
                                rekomendasi pasangan yang sesuai.</p>
                            <ul class="step-list">
                                <li><i class="bi bi-check-circle-fill"></i> Data pribadi dan latar belakang</li>
                                <li><i class="bi bi-check-circle-fill"></i> Kriteria pasangan yang diinginkan</li>
                                <li><i class="bi bi-check-circle-fill"></i> Visi misi pernikahan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="step-card">
                            <div class="step-number">3</div>
                            <div class="step-image">
                                <img src="{{ asset('assets/img/preview.png') }}" alt="Proses Ta'aruf" class="img-fluid">
                            </div>
                            <h3 class="step-title">Proses Ta'aruf Terbimbing</h3>
                            <p class="step-description">Dapatkan pendampingan dari pembimbing profesional di setiap tahap
                                ta'aruf Anda.</p>
                            <ul class="step-list">
                                <li><i class="bi bi-check-circle-fill"></i> Matching berdasarkan kriteria</li>
                                <li><i class="bi bi-check-circle-fill"></i> Konsultasi dengan pembimbing</li>
                                <li><i class="bi bi-check-circle-fill"></i> Proses yang sesuai syariat</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="step-card">
                            <div class="step-number">4</div>
                            <div class="step-image">
                                <img src="{{ asset('assets/img/preview.png') }}" alt="Menuju Pernikahan"
                                    class="img-fluid">
                            </div>
                            <h3 class="step-title">Menuju Pernikahan Berkah</h3>
                            <p class="step-description">Dapatkan dukungan penuh hingga proses pernikahan dengan surat
                                rekomendasi resmi.</p>
                            <ul class="step-list">
                                <li><i class="bi bi-check-circle-fill"></i> Surat rekomendasi resmi</li>
                                <li><i class="bi bi-check-circle-fill"></i> Bimbingan pra-nikah</li>
                                <li><i class="bi bi-check-circle-fill"></i> Dukungan berkelanjutan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== TESTIMONIALS SECTION ===== -->
        <section id="testimonials" class="bg-light-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-badge">Testimoni</span>
                    <h2 class="section-title">Kisah Sukses Mereka</h2>
                    <p class="section-description">Dengarkan pengalaman mereka yang telah menemukan pasangan hidup melalui
                        Ta'aruf Jodohku.</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">
                                Alhamdulillah, melalui aplikasi Ta'aruf Jodohku ini saya menemukan pasangan hidup yang
                                sholeh dan sesuai dengan kriteria yang saya harapkan. Prosesnya sangat terbimbing dan
                                Islami. Pembimbing sangat membantu dalam setiap tahap.
                            </div>
                            <div class="testimonial-author">
                                <img src="{{ asset('assets/img/nophoto.png') }}" alt="Fatimah Az-Zahra"
                                    class="testimonial-avatar">
                                <div class="testimonial-info">
                                    <h4>Fatimah Az-Zahra</h4>
                                    <p>Pegawai YPI Al Azhar</p>
                                    <div class="testimonial-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">
                                Aplikasi yang sangat membantu dalam mencari jodoh sesuai syariat. Pembimbing yang
                                profesional dan proses yang transparan membuat saya merasa nyaman dan tenang. Sangat
                                merekomendasikan untuk rekan-rekan yang serius mencari pasangan.
                            </div>
                            <div class="testimonial-author">
                                <img src="{{ asset('assets/img/nophoto.png') }}" alt="Ahmad Fauzi"
                                    class="testimonial-avatar">
                                <div class="testimonial-info">
                                    <h4>Ahmad Fauzi</h4>
                                    <p>Guru YPI Al Azhar</p>
                                    <div class="testimonial-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- ===== FAQ SECTION ===== -->
        <section id="faq">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-badge">FAQ</span>
                    <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                    <p class="section-description">Temukan jawaban atas pertanyaan umum seputar Ta'aruf Jodohku.</p>
                </div>

                <div class="faq-container">
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <div class="faq-icon">
                                <i class="bx bx-help-circle"></i>
                            </div>
                            <div class="faq-question-text">
                                Apakah boleh mengajak pihak ketiga dalam proses Ta'aruf?
                            </div>
                            <div class="faq-toggle">
                                <i class="bx bx-chevron-down"></i>
                            </div>
                        </div>
                        <div id="faq1" class="faq-answer collapse show">
                            Proses Ta'aruf yang difasilitasi pada aplikasi ini sangat dianjurkan diketahui oleh pihak ketiga
                            seperti keluarga, wali, saudara, atau teman, terutama pada akhir proses ta'aruf sehingga akad
                            pernikahan dapat dilaksanakan. Selama masih dalam proses ta'aruf, pengguna harus menjaga adab
                            dan kesopanan Islami, tidak boleh berpacaran atau mengirimkan pesan yang tidak pantas.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <div class="faq-icon">
                                <i class="bx bx-help-circle"></i>
                            </div>
                            <div class="faq-question-text">
                                Bagaimana cara mendaftarkan orang terdekat?
                            </div>
                            <div class="faq-toggle">
                                <i class="bx bx-chevron-down"></i>
                            </div>
                        </div>
                        <div id="faq2" class="faq-answer collapse">
                            Keluarga besar YPI Al Azhar yang ingin mendaftarkan keluarga, saudara, atau kerabat bisa
                            mendaftarkan dengan NIP lalu tambahkan kode _1 (underscore angka 1-10) lalu memasukkan nama pria
                            atau wanita yang ingin didaftarkan. Pegawai/NIP yang mendaftarkan bertanggung jawab penuh atas
                            niat dan kesungguhan yang didaftarkan.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <div class="faq-icon">
                                <i class="bx bx-help-circle"></i>
                            </div>
                            <div class="faq-question-text">
                                Bagaimana proses ta'arufnya?
                            </div>
                            <div class="faq-toggle">
                                <i class="bx bx-chevron-down"></i>
                            </div>
                        </div>
                        <div id="faq3" class="faq-answer collapse">
                            Pengguna bisa memilih sendiri setelah ada profil yang berkecocokan pada menu RIWAYAT. Kecocokan
                            ini sesuai dengan form yang diisi pada kriteria spesifik saat pendaftaran. Pengguna juga bisa
                            dipilihkan oleh pembimbing setelah melihat profil yang dinilai cocok.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <div class="faq-icon">
                                <i class="bx bx-help-circle"></i>
                            </div>
                            <div class="faq-question-text">
                                Apa yang terjadi setelah proses ta'aruf selesai?
                            </div>
                            <div class="faq-toggle">
                                <i class="bx bx-chevron-down"></i>
                            </div>
                        </div>
                        <div id="faq4" class="faq-answer collapse">
                            Setelah proses ta'aruf selesai, admin akan mencetak surat rekomendasi yang akan dilanjutkan
                            dengan proses konsultasi dan bimbingan untuk memberikan wawasan agar lebih siap menuju
                            pernikahan dengan pasangan Anda.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== CONTACT SECTION ===== -->
        <section id="contact">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-badge">Hubungi Kami</span>
                    <h2 class="section-title">Ada Pertanyaan?</h2>
                    <p class="section-description">Kami siap membantu Anda. Hubungi kami melalui form di bawah atau kontak
                        langsung.</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
                        <div class="contact-card">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="contact-info">
                                    <h4>Alamat Kantor</h4>
                                    <p>Jl. Sisingamaraja, Kebayoran Baru, Jakarta Selatan 12110</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="contact-info">
                                    <h4>Email</h4>
                                    <p>taarufonline2023@gmail.com</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-phone"></i>
                                </div>
                                <div class="contact-info">
                                    <h4>Telepon</h4>
                                    <p>(021) 727-83683<br>(021) 739-7267</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
                        <div class="contact-form">
                            <form action="/kirimpertanyaan" method="post">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" name="email_tanya" class="form-control-modern"
                                                placeholder="Email Anda" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="isi_tanya" class="form-control-modern" placeholder="Pesan Anda..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="submit-button">
                                            Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
