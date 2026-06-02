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
        }

        /* ===== HERO SECTION FOR LOGIN ===== */
        #hero-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
            min-height: 40vh;
            display: flex;
            align-items: center;
        }

        #hero-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .hero-login-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: var(--white);
            width: 100%;
        }

        .hero-login-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .hero-login-icon svg {
            width: 40px;
            height: 40px;
        }

        .hero-login-title {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .hero-login-subtitle {
            font-size: 1.125rem;
            opacity: 0.95;
            max-width: 500px;
            margin: 0 auto;
        }

        .hero-decoration {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 80px;
            background: var(--white);
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        /* ===== LOGIN SECTION ===== */
        #login-section {
            padding: 80px 0 100px;
            background: var(--white);
            position: relative;
        }

        .login-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s ease;
            max-width: 500px;
            margin: 0 auto;
        }

        .login-card:hover {
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
            transform: translateY(-4px);
        }

        .login-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            padding: 28px 32px;
            border: none;
            text-align: center;
        }

        .login-card-header b {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .login-card-body {
            padding: 48px 40px;
        }

        /* ===== FORM CONTROLS ===== */
        .form-group-modern {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label-modern {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 8px;
            display: block;
        }

        .input-group-modern {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            pointer-events: none;
            z-index: 1;
        }

        .form-control-modern {
            width: 100%;
            padding: 16px 18px 16px 52px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
            color: var(--gray-900);
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.1);
        }

        .form-control-modern::placeholder {
            color: var(--gray-600);
            opacity: 0.7;
        }

        /* ===== BUTTONS ===== */
        .btn-login-modern {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: var(--shadow-md);
            margin-top: 8px;
        }

        .btn-login-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-login-modern:active {
            transform: translateY(0);
        }

        /* ===== ALERTS ===== */
        .alert-modern {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            border: none;
            font-size: 0.95rem;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease-out;
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

        .alert-success {
            background: rgba(0, 200, 83, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert-warning {
            background: rgba(255, 214, 0, 0.1);
            color: #f57c00;
            border-left: 4px solid var(--warning);
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 28px 0;
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--gray-300);
        }

        .divider span {
            padding: 0 16px;
            font-weight: 600;
        }

        /* ===== LINKS ===== */
        .link-section {
            text-align: center;
            margin-top: 28px;
        }

        .link-primary {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .link-primary:hover {
            color: var(--primary-dark);
            gap: 8px;
        }

        .text-muted {
            color: var(--gray-600);
        }

        /* ===== FEATURES LIST ===== */
        .features-list {
            margin-top: 32px;
            padding: 24px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
        }

        .feature-item {
            display: flex;
            align-items: start;
            gap: 12px;
            margin-bottom: 16px;
            color: var(--gray-900);
        }

        .feature-item:last-child {
            margin-bottom: 0;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .feature-icon svg {
            width: 14px;
            height: 14px;
        }

        .feature-text {
            flex: 1;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-login-title {
                font-size: 2rem;
                padding: 0 20px;
            }

            .hero-login-subtitle {
                font-size: 1rem;
                padding: 0 20px;
            }

            #hero-login {
                padding: 60px 0 50px;
            }

            #login-section {
                padding: 60px 0 80px;
            }

            .login-card-body {
                padding: 36px 28px;
            }

            .hero-login-icon {
                width: 70px;
                height: 70px;
            }

            .hero-login-icon svg {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 576px) {
            .hero-login-title {
                font-size: 1.75rem;
            }

            .login-card-header {
                padding: 24px 24px;
            }

            .login-card-header b {
                font-size: 1.25rem;
            }

            .login-card-body {
                padding: 32px 24px;
            }

            .btn-login-modern {
                padding: 14px 28px;
                font-size: 1rem;
            }

            .form-control-modern {
                padding: 14px 16px 14px 48px;
            }
        }

        /* ===== PASSWORD TOGGLE ===== */
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray-600);
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--primary);
        }
    </style>

    <!-- ===== HERO SECTION ===== -->
    <section id="hero-login">
        <div class="container">
            <div class="hero-login-content" data-aos="fade-up">
                <div class="hero-login-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 5C13.66 5 15 6.34 15 8C15 9.66 13.66 11 12 11C10.34 11 9 9.66 9 8C9 6.34 10.34 5 12 5ZM12 19.2C9.5 19.2 7.29 17.92 6 15.98C6.03 13.99 10 12.9 12 12.9C13.99 12.9 17.97 13.99 18 15.98C16.71 17.92 14.5 19.2 12 19.2Z" fill="white"/>
                    </svg>
                </div>
                <h1 class="hero-login-title">Selamat Datang Kembali</h1>
                <p class="hero-login-subtitle">
                    Masuk ke akun Anda untuk melanjutkan perjalanan ta'aruf
                </p>
            </div>
        </div>
        <div class="hero-decoration"></div>
    </section>

    <!-- ===== LOGIN SECTION ===== -->
    <section id="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-9">
                    
                    {{-- Alert Messages --}}
                    @if (Session::get('success'))
                        <div class="alert-modern alert-success" data-aos="fade-down">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="currentColor"/>
                            </svg>
                            <span>{{ Session::get('success') }}</span>
                        </div>
                    @endif
                    
                    @if (Session::get('warning'))
                        <div class="alert-modern alert-warning" data-aos="fade-down">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 21H23L12 2L1 21ZM13 18H11V16H13V18ZM13 14H11V10H13V14Z" fill="currentColor"/>
                            </svg>
                            <span>{{ Session::get('warning') }}</span>
                        </div>
                    @endif

                    <div class="login-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="login-card-header">
                            <b>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15C10 13.9 10.9 13 12 13C13.1 13 14 13.9 14 15C14 16.1 13.1 17 12 17ZM15.1 8H8.9V6C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8Z" fill="white"/>
                                </svg>
                                Login
                            </b>
                        </div>
                        <div class="login-card-body">
                            <form action="/proseslogin" method="POST" id="frmlogin">
                                @csrf
                                
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Email</label>
                                    <div class="input-group-modern">
                                        <span class="input-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control-modern" name="email" id="email"
                                            placeholder="nama@email.com" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Password</label>
                                    <div class="input-group-modern">
                                        <span class="input-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15C10 13.9 10.9 13 12 13C13.1 13 14 13.9 14 15C14 16.1 13.1 17 12 17ZM15.1 8H8.9V6C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        <input type="password" class="form-control-modern" name="password"
                                            id="password" placeholder="Masukkan password Anda" required>
                                        <span class="password-toggle" onclick="togglePassword()">
                                            <svg id="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <button class="btn-login-modern" type="submit">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 7L9.6 8.4L12.2 11H2V13H12.2L9.6 15.6L11 17L16 12L11 7ZM20 19H12V21H20C21.1 21 22 20.1 22 19V5C22 3.9 21.1 3 20 3H12V5H20V19Z" fill="white"/>
                                    </svg>
                                    Masuk Sekarang
                                </button>
                            </form>

                            <div class="divider">
                                <span>atau</span>
                            </div>

                            <div class="link-section">
                                <span class="text-muted">Belum punya akun?</span>
                                <a href="/daftar" class="link-primary">
                                    Daftar di sini
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>

                            {{-- <div class="features-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 16.2L4.8 12L3.4 13.4L9 19L21 7L19.6 5.6L9 16.2Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="feature-text">
                                        <strong>Aman & Terpercaya</strong> - Data Anda dilindungi dengan enkripsi
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 16.2L4.8 12L3.4 13.4L9 19L21 7L19.6 5.6L9 16.2Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="feature-text">
                                        <strong>Pembimbing Profesional</strong> - Didampingi konsultan berpengalaman
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 16.2L4.8 12L3.4 13.4L9 19L21 7L19.6 5.6L9 16.2Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="feature-text">
                                        <strong>Sesuai Syariat</strong> - Proses ta'aruf yang Islami
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 24px; color: var(--gray-600); font-size: 0.9rem;">
                        <a href="/" style="color: var(--primary); font-weight: 600; text-decoration: none;">
                            ← Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M12 7C14.76 7 17 9.24 17 12C17 12.65 16.87 13.26 16.64 13.83L19.56 16.75C21.07 15.49 22.26 13.86 22.99 12C21.26 7.61 16.99 4.5 11.99 4.5C10.59 4.5 9.25 4.75 8.01 5.2L10.17 7.36C10.74 7.13 11.35 7 12 7ZM2 4.27L4.28 6.55L4.74 7.01C3.08 8.3 1.78 10.02 1 12C2.73 16.39 7 19.5 12 19.5C13.55 19.5 15.03 19.2 16.38 18.66L16.8 19.08L19.73 22L21 20.73L3.27 3L2 4.27ZM7.53 9.8L9.08 11.35C9.03 11.56 9 11.78 9 12C9 13.66 10.34 15 12 15C12.22 15 12.44 14.97 12.65 14.92L14.2 16.47C13.53 16.8 12.79 17 12 17C9.24 17 7 14.76 7 12C7 11.21 7.2 10.47 7.53 9.8ZM11.84 9.02L14.99 12.17L15.01 12.01C15.01 10.35 13.67 9.01 12.01 9.01L11.84 9.02Z" fill="currentColor"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>';
            }
        }
    </script>
@endsection