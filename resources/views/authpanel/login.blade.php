<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />
    <title>Ta'aruf Admin - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        /* ===== MODERN ADMIN DESIGN SYSTEM ===== */
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
            --shadow-xl: 0 16px 48px rgba(0, 0, 0, 0.2);
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--white);
            color: var(--gray-900);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ===== PRELOADER ===== */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.3s ease;
        }

        .preloader.hide {
            opacity: 0;
            pointer-events: none;
        }

        .spinner-grow {
            width: 48px;
            height: 48px;
            background-color: var(--black);
            border-radius: 50%;
            animation: spinner-grow 0.75s linear infinite;
        }

        @keyframes spinner-grow {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        /* ===== MAIN CONTAINER ===== */
        .login-container {
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.6s ease-out;
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

        /* ===== LOGO SECTION ===== */
        .logo-section {
            text-align: center;
            margin-bottom: 48px;
        }

        .logo-wrapper {
            width: 100px;
            height: 100px;
            background: var(--black);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            position: relative;
            box-shadow: var(--shadow-lg);
        }

        .logo-wrapper::after {
            content: '';
            position: absolute;
            inset: -4px;
            background: linear-gradient(135deg, var(--gray-900) 0%, var(--black) 100%);
            border-radius: 24px;
            opacity: 0.3;
            z-index: -1;
            filter: blur(12px);
        }

        .logo-wrapper svg {
            width: 56px;
            height: 56px;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gray-900);
            color: var(--white);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .admin-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--black);
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .admin-subtitle {
            font-size: 1rem;
            color: var(--gray-600);
        }

        /* ===== LOGIN CARD ===== */
        .login-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            border: 2px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            border-color: var(--black);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .login-card-header {
            background: var(--black);
            color: var(--white);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-card-header::before {
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

        .login-card-header-content {
            position: relative;
            z-index: 1;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            backdrop-filter: blur(10px);
        }

        .header-icon svg {
            width: 28px;
            height: 28px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .login-card-body {
            padding: 40px 32px;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            border: none;
            font-size: 0.95rem;
            margin-bottom: 24px;
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
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border-left: 4px solid #22c55e;
        }

        .alert-warning {
            background: rgba(251, 191, 36, 0.1);
            color: #d97706;
            border-left: 4px solid #fbbf24;
        }

        /* ===== FORM CONTROLS ===== */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 8px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            pointer-events: none;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 16px 18px 16px 52px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
            color: var(--gray-900);
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--black);
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
        }

        .form-control::placeholder {
            color: var(--gray-400);
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray-500);
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--black);
        }

        /* ===== BUTTON ===== */
        .btn-admin {
            width: 100%;
            padding: 16px 32px;
            background: var(--black);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: var(--shadow-md);
            font-family: 'Inter', sans-serif;
        }

        .btn-admin:hover {
            background: var(--gray-900);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-admin:active {
            transform: translateY(0);
        }

        /* ===== FOOTER ===== */
        .login-footer {
            margin-top: 32px;
            text-align: center;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            padding: 24px;
            background: var(--gray-100);
            border-radius: var(--radius-md);
            margin-top: 24px;
        }

        .feature-item {
            text-align: center;
        }

        .feature-icon-wrapper {
            width: 40px;
            height: 40px;
            background: var(--black);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
        }

        .feature-icon-wrapper svg {
            width: 20px;
            height: 20px;
        }

        .feature-text {
            font-size: 0.75rem;
            color: var(--gray-600);
            font-weight: 600;
        }

        .copyright {
            margin-top: 32px;
            text-align: center;
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--black);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: gap 0.3s ease;
        }

        .back-link:hover {
            gap: 8px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 576px) {
            .admin-title {
                font-size: 1.75rem;
            }

            .login-card-body {
                padding: 32px 24px;
            }

            .login-card-header {
                padding: 28px 24px;
            }

            .feature-list {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .logo-wrapper {
                width: 80px;
                height: 80px;
            }

            .logo-wrapper svg {
                width: 44px;
                height: 44px;
            }

            .form-control {
                padding: 14px 16px 14px 48px;
            }

            .btn-admin {
                padding: 14px 28px;
            }
        }

        /* ===== DECORATIVE ELEMENTS ===== */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.03;
        }

        .pattern-grid {
            width: 100%;
            height: 100%;
            background-image:
                repeating-linear-gradient(0deg, var(--black), var(--black) 1px, transparent 1px, transparent 40px),
                repeating-linear-gradient(90deg, var(--black), var(--black) 1px, transparent 1px, transparent 40px);
        }
    </style>
</head>

<body>
    <!-- Background Pattern -->
    <div class="bg-pattern">
        <div class="pattern-grid"></div>
    </div>

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner-grow"></div>
    </div>

    <!-- Main Login Container -->
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-wrapper">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white" />
                    <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="admin-badge">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 0L7.5 4L12 4.5L8.5 7.5L9.5 12L6 9.5L2.5 12L3.5 7.5L0 4.5L4.5 4L6 0Z"
                        fill="currentColor" />
                </svg>
                Admin Panel
            </div>
            <h1 class="admin-title">Ta'aruf Admin</h1>
            <p class="admin-subtitle">Sistem Manajemen Aplikasi Ta'aruf</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <div class="login-card-header">
                <div class="login-card-header-content">
                    <div class="header-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15C10 13.9 10.9 13 12 13C13.1 13 14 13.9 14 15C14 16.1 13.1 17 12 17ZM15.1 8H8.9V6C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8Z"
                                fill="white" />
                        </svg>
                    </div>
                    <h3 class="card-title">Login Administrator</h3>
                </div>
            </div>

            <div class="login-card-body">
                {{-- Alert Messages --}}
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"
                                fill="currentColor" />
                        </svg>
                        <span>{{ Session::get('success') }}</span>
                    </div>
                @endif

                @if (Session::get('warning'))
                    <div class="alert alert-warning">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 21H23L12 2L1 21ZM13 18H11V16H13V18ZM13 14H11V10H13V14Z" fill="currentColor" />
                        </svg>
                        <span>{{ Session::get('warning') }}</span>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="/prosesloginadmin" method="POST" id="frmlogin">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <input class="form-control" type="email" name="email" id="email"
                                placeholder="admin@example.com" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15C10 13.9 10.9 13 12 13C13.1 13 14 13.9 14 15C14 16.1 13.1 17 12 17ZM15.1 8H8.9V6C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <input class="form-control" type="password" name="password" id="password"
                                placeholder="Masukkan password" required>
                            <span class="password-toggle" onclick="togglePassword()">
                                <svg id="eye-icon" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <button class="btn-admin" type="submit">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 7L9.6 8.4L12.2 11H2V13H12.2L9.6 15.6L11 17L16 12L11 7ZM20 19H12V21H20C21.1 21 22 20.1 22 19V5C22 3.9 21.1 3 20 3H12V5H20V19Z"
                                fill="white" />
                        </svg>
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <a href="/" class="back-link">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 5L7.5 10L12.5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Kembali ke Beranda
            </a>
            <div class="copyright">
                © 2025 YPI Al Azhar. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.classList.add('hide');
            }, 500);
        });

        // Password Toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML =
                    '<path d="M12 7C14.76 7 17 9.24 17 12C17 12.65 16.87 13.26 16.64 13.83L19.56 16.75C21.07 15.49 22.26 13.86 22.99 12C21.26 7.61 16.99 4.5 11.99 4.5C10.59 4.5 9.25 4.75 8.01 5.2L10.17 7.36C10.74 7.13 11.35 7 12 7ZM2 4.27L4.28 6.55L4.74 7.01C3.08 8.3 1.78 10.02 1 12C2.73 16.39 7 19.5 12 19.5C13.55 19.5 15.03 19.2 16.38 18.66L16.8 19.08L19.73 22L21 20.73L3.27 3L2 4.27ZM7.53 9.8L9.08 11.35C9.03 11.56 9 11.78 9 12C9 13.66 10.34 15 12 15C12.22 15 12.44 14.97 12.65 14.92L14.2 16.47C13.53 16.8 12.79 17 12 17C9.24 17 7 14.76 7 12C7 11.21 7.2 10.47 7.53 9.8ZM11.84 9.02L14.99 12.17L15.01 12.01C15.01 10.35 13.67 9.01 12.01 9.01L11.84 9.02Z" fill="currentColor"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML =
                    '<path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>';
            }
        }

        // Form validation feedback
        const form = document.getElementById('frmlogin');
        form.addEventListener('submit', function(e) {
            const btn = form.querySelector('.btn-admin');
            btn.innerHTML =
                '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="white" stroke-width="2"/><path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>Memproses...';
            btn.style.pointerEvents = 'none';
        });
    </script>
</body>

</html>
