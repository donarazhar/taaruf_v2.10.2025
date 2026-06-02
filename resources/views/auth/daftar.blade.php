@extends('layouts.bootstrap')
@section('content')
    <style>
        /* ===== MODERN DESIGN SYSTEM (sama dengan home) ===== */
        :root {
            --primary: #0053C5;
            --primary-light: #2E7FE4;
            --primary-dark: #003D8F;
            --accent: #00B8D4;
            --success: #00C853;
            --warning: #FFD600;
            --danger: #DC3545;
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

        /* ===== MODERN POPUP ===== */
        .popup-window {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }

        .popup-content {
            background: var(--white);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-xl);
            animation: slideUp 0.3s ease-out;
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .popup-content .card {
            border: none;
            box-shadow: none;
        }

        .popup-content .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            padding: 24px;
            border: none;
            border-radius: 0;
        }

        .popup-content .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            color: var(--white);
        }

        .popup-content .card-body {
            padding: 32px;
        }

        /* ===== HERO SECTION FOR REGISTER ===== */
        #hero-register {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 60px 0 40px;
            position: relative;
            overflow: hidden;
        }

        #hero-register::before {
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

        .hero-register-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: var(--white);
        }

        .hero-register-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-register-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .hero-register-subtitle {
            font-size: 1.125rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-decoration {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 60px;
            background: var(--white);
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        /* ===== MODERN FORM SECTION ===== */
        #register-section {
            padding: 80px 0;
            background: var(--white);
        }

        .register-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .register-card:hover {
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .register-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            padding: 24px 32px;
            border: none;
        }

        .register-card-header b {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .register-card-body {
            padding: 40px 32px;
        }

        /* ===== MODERN FORM CONTROLS ===== */
        .form-label-modern {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 8px;
            display: block;
        }

        .form-control-modern {
            width: 100%;
            padding: 14px 18px;
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

        .form-select-modern {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
            color: var(--gray-900);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%23757575' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            padding-right: 45px;
        }

        .form-select-modern:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.1);
        }

        .form-group-modern {
            margin-bottom: 24px;
        }

        /* ===== MODERN BUTTONS ===== */
        .btn-modern {
            padding: 14px 32px;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            box-shadow: var(--shadow-md);
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-danger-modern {
            background: var(--danger);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .btn-danger-modern:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-full-width {
            width: 100%;
        }

        /* ===== ALERTS ===== */
        .alert-modern {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            border: none;
            font-size: 0.95rem;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
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

        /* ===== FORM ICON ===== */
        .form-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            pointer-events: none;
        }

        .has-icon .form-control-modern {
            padding-left: 48px;
        }

        .form-group-with-icon {
            position: relative;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-register-title {
                font-size: 2rem;
                padding: 0 20px;
            }

            .hero-register-subtitle {
                font-size: 1rem;
                padding: 0 20px;
            }

            #register-section {
                padding: 60px 0;
            }

            .register-card-body {
                padding: 32px 24px;
            }

            .popup-content .card-body {
                padding: 24px;
            }

            #hero-register {
                padding: 40px 0 30px;
            }
        }

        @media (max-width: 576px) {
            .hero-register-title {
                font-size: 1.75rem;
            }

            .register-card-header {
                padding: 20px 24px;
            }

            .register-card-body {
                padding: 28px 20px;
            }

            .btn-modern {
                padding: 12px 24px;
            }
        }

        /* ===== BUTTON GROUP ===== */
        .button-group {
            display: flex;
            gap: 12px;
        }

        .button-group .btn-modern {
            flex: 1;
        }

        @media (max-width: 576px) {
            .button-group {
                flex-direction: column;
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

        .input-group-modern {
            position: relative;
        }
    </style>

    <!-- ===== POPUP VERIFIKASI NIP ===== -->
    <div class="popup-window">
        <div class="popup-content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 8px;">
                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 17C11.45 17 11 16.55 11 16V12C11 11.45 11.45 11 12 11C12.55 11 13 11.45 13 12V16C13 16.55 12.55 17 12 17ZM13 9H11V7H13V9Z" fill="currentColor"/>
                        </svg>
                        Verifikasi Nomor Induk Pegawai
                    </h3>
                </div>
                <div class="card-body">
                    <p style="color: var(--gray-600); margin-bottom: 24px; text-align: left;">
                        Silakan masukkan NIP Anda untuk memverifikasi bahwa Anda adalah pegawai YPI Al Azhar yang terdaftar.
                    </p>
                    <form id="id-check-form">
                        <div class="form-group-modern">
                            <input type="text" class="form-control-modern" id="id-input" name="id-input"
                                placeholder="Masukkan NIP Anda" required>
                        </div>
                        <div class="button-group">
                            <button type="submit" class="btn-modern btn-primary-modern">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.6 3.4C17.8 4.6 18.5 6.2 18.5 8C18.5 11.6 15.6 14.5 12 14.5C10.2 14.5 8.6 13.8 7.4 12.6L3 17L2 16L6.4 11.6C5.2 10.4 4.5 8.8 4.5 7C4.5 3.4 7.4 0.5 11 0.5C12.8 0.5 14.4 1.2 15.6 2.4L16.6 3.4ZM11 3.5C8.5 3.5 6.5 5.5 6.5 8C6.5 10.5 8.5 12.5 11 12.5C13.5 12.5 15.5 10.5 15.5 8C15.5 5.5 13.5 3.5 11 3.5Z" fill="currentColor"/>
                                </svg>
                                Verifikasi NIP
                            </button>
                            <button type="button" class="btn-modern btn-danger-modern" onclick="cancelAndGoBack()">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8 5.2L14.8 4.2L10 9L5.2 4.2L4.2 5.2L9 10L4.2 14.8L5.2 15.8L10 11L14.8 15.8L15.8 14.8L11 10L15.8 5.2Z" fill="currentColor"/>
                                </svg>
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== HERO SECTION ===== -->
    <section id="hero-register">
        <div class="container">
            <div class="hero-register-content">
                <div class="hero-register-badge">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 1L10.5 6L16 7L12 11L13 16.5L8 13.5L3 16.5L4 11L0 7L5.5 6L8 1Z" fill="currentColor"/>
                    </svg>
                    Formulir Pendaftaran
                </div>
                <h1 class="hero-register-title">Daftar Akun Ta'aruf</h1>
                <p class="hero-register-subtitle">
                    Lengkapi formulir di bawah untuk membuat akun dan memulai perjalanan ta'aruf Anda
                </p>
            </div>
        </div>
        <div class="hero-decoration"></div>
    </section>

    <!-- ===== FORM SECTION ===== -->
    <section id="register-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    
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

                    <div class="register-card" data-aos="fade-up">
                        <div class="register-card-header">
                            <b>Formulir Pendaftaran Ta'aruf Jodohku</b>
                        </div>
                        <div class="register-card-body">
                            <form action="/prosesdaftar" method="POST" id="frmdaftar">
                                @csrf
                                
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Nomor Induk Pegawai (NIP)</label>
                                    <input type="text" name="nip" maxlength="10" class="form-control-modern"
                                        id="nip" placeholder="Masukkan 10 digit NIP" pattern="\d*"
                                        title="Hanya angka yang diperbolehkan"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 12)"
                                        required>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control-modern" id="nama"
                                        placeholder="Masukkan nama lengkap Anda" oninput="validateInput(this)" required>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Jenis Kelamin</label>
                                    <select class="form-select-modern" name="jenkel" id="jenkel" required>
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="pria">Pria</option>
                                        <option value="wanita">Wanita</option>
                                    </select>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Referensi</label>
                                    <select class="form-select-modern" name="referensi" id="referensi" required
                                        onchange="toggleReferensiInput()">
                                        <option value="">Pilih jenis referensi</option>
                                        <option value="1">Saya Adalah Pegawai YPI Al Azhar</option>
                                        <option value="2">Referensi Dari Pegawai YPI Al Azhar</option>
                                    </select>
                                </div>

                                <div class="form-group-modern" id="referensiInputContainer" style="display: none;">
                                    <label class="form-label-modern">Nama Pegawai yang Mereferensi</label>
                                    <input type="text" name="referensiDetail" class="form-control-modern"
                                        id="referensiDetail" oninput="validateInput(this)"
                                        placeholder="Masukkan nama pegawai YPI Al Azhar">
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Email</label>
                                    <input type="email" class="form-control-modern" name="email" id="email"
                                        placeholder="contoh@email.com" required>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Password</label>
                                    <div class="input-group-modern">
                                        <input type="password" class="form-control-modern" name="password"
                                            id="password" placeholder="Masukkan password (min. 6 karakter)" required>
                                        <span class="password-toggle" onclick="togglePassword()">
                                            <svg id="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <button class="btn-modern btn-primary-modern btn-full-width" type="submit">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM8 15L3 10L4.41 8.59L8 12.17L15.59 4.58L17 6L8 15Z" fill="currentColor"/>
                                    </svg>
                                    Daftar Sekarang
                                </button>
                            </form>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 24px; color: var(--gray-600);">
                        Sudah punya akun? 
                        <a href="/login" style="color: var(--primary); font-weight: 600; text-decoration: none;">
                            Login di sini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function cancelAndGoBack() {
            window.location.href = '/';
        }

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

        function toggleReferensiInput() {
            var referensiInputContainer = document.getElementById('referensiInputContainer');
            var referensiDetailInput = document.getElementById('referensiDetail');
            var referensiDropdown = document.getElementById('referensi');

            if (referensiDropdown.value === '2') {
                referensiInputContainer.style.display = 'block';
                referensiDetailInput.setAttribute('required', 'required');
            } else {
                referensiInputContainer.style.display = 'none';
                referensiDetailInput.removeAttribute('required');
            }
        }

        function validateInput(input) {
            input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        }

        document.addEventListener("DOMContentLoaded", () => {
            const popupWindow = document.querySelector(".popup-window");
            const idCheckForm = document.getElementById("id-check-form");

            const validNip = localStorage.getItem("validNip");
            if (validNip !== "true") {
                popupWindow.style.display = "flex";
            } else {
                popupWindow.style.display = "none";
            }

            function closePopup() {
                popupWindow.style.display = "none";
            }

            idCheckForm.addEventListener("submit", (e) => {
                e.preventDefault();
                const idInput = document.getElementById("id-input").value;

                fetch(`https://apialazhar.eu.org/ypia?nip=${idInput}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            localStorage.setItem("validNip", "true");
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Selamat! NIP Anda terdaftar.",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            closePopup();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "NIP Tidak Terdaftar",
                                text: "Maaf, NIP Anda tidak terdaftar. Silahkan hubungi Admin!",
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Terjadi Kesalahan",
                            text: "Terjadi kesalahan saat memeriksa NIP. Silahkan coba lagi.",
                        });
                    });
            });
        });
    </script>
@endsection