@extends('dashboard.dashlayouts.style')

<style>
    /* ===== MODERN PROFILE STYLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
        --success-color: #10B981;
        --danger-color: #EF4444;
        --warning-color: #F59E0B;
        --dark: #1F2937;
        --gray-100: #F8F9FA;
        --gray-200: #E9ECEF;
        --gray-300: #DEE2E6;
        --gray-600: #6C757D;
        --gray-800: #343A40;
        --white: #FFFFFF;
        --radius: 16px;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .page-content-wrapper {
        background: transparent;
        min-height: 100vh;
        padding: 1.5rem 0 3rem;
    }

    /* ===== USER INFO CARD ===== */
    .user-info-card {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        position: relative;
    }

    .user-info-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 15s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.5;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    .user-info-card .card-body {
        padding: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .user-profile {
        margin-right: 1rem;
        position: relative;
    }

    .user-profile img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: var(--shadow);
    }

    .user-info h5 {
        color: white;
        font-weight: 800;
        margin-bottom: 0.25rem;
        font-size: 1.2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .user-info p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.9rem;
        margin: 0;
    }

    .user-info .badge {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        color: white;
        font-weight: 700;
        padding: 0.4rem 0.85rem;
        font-size: 0.75rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    /* ===== WELCOME BANNER ===== */
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border-radius: var(--radius);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow);
        color: white;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .welcome-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .welcome-text {
        flex: 1;
    }

    .welcome-text h6 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .welcome-text p {
        margin: 0;
        font-size: 0.85rem;
        opacity: 0.9;
    }

    /* ===== ALERTS ===== */
    .alert {
        border: none;
        border-radius: var(--radius);
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: var(--shadow);
        animation: slideDown 0.3s ease;
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
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border-left: 4px solid var(--success-color);
    }

    .alert-warning {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        color: #92400E;
        border-left: 4px solid var(--warning-color);
    }

    .alert::before {
        content: '✓';
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: currentColor;
        color: white;
        font-weight: bold;
        flex-shrink: 0;
    }

    .alert-warning::before {
        content: '⚠';
    }

    /* ===== ACCORDION MODERN ===== */
    .accordion {
        border: none;
        gap: 1.25rem;
        display: flex;
        flex-direction: column;
    }

    .accordion-item {
        border: none;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        background: white;
        transition: all 0.3s ease;
    }

    .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }

    .accordion-button {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: white;
        font-weight: 700;
        padding: 1.25rem 1.5rem;
        border: none;
        font-size: 1.05rem;
        letter-spacing: 0.3px;
        position: relative;
        overflow: hidden;
    }

    .accordion-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .accordion-button:hover::before {
        left: 100%;
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        color: white;
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: none;
        border: none;
    }

    .accordion-button::after {
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
        transform: rotate(180deg);
    }

    .accordion-body {
        padding: 2rem;
        background: #FFFFFF;
    }

    /* ===== CARD STYLING ===== */
    .user-data-card {
        border: none;
        border-radius: 0;
        box-shadow: none;
        background: transparent;
    }

    .user-data-card .card-body {
        padding: 0;
    }

    /* ===== FORM STYLING ===== */
    .form-label {
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.6rem;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--primary-color);
    }

    .form-control,
    .form-select {
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.1);
        background: white;
    }

    .form-control[readonly] {
        background-color: #F8F9FA;
        cursor: not-allowed;
        color: var(--gray-600);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* ===== 2 COLUMN LAYOUT ===== */
    .form-row-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
        margin-bottom: 1.25rem;
    }

    @media (max-width: 768px) {
        .form-row-2 {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    /* ===== PREVIEW CONTAINER ===== */
    .preview-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: var(--radius);
        border: 2px dashed var(--gray-300);
        min-height: 200px;
    }

    .preview-image {
        max-width: 100%;
        max-height: 300px;
        height: auto;
        border-radius: 12px;
        box-shadow: var(--shadow);
        object-fit: contain;
    }

    .preview-video {
        max-width: 100%;
        max-height: 400px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    /* ===== RANGE SLIDER MODERN ===== */
    .range-wrapper {
        position: relative;
        padding: 2rem 0 1rem;
        margin: 1rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .range-labels {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .range-label {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: white;
        padding: 0.6rem 1.25rem;
        border-radius: 10px;
        font-size: 1rem;
        box-shadow: var(--shadow);
        min-width: 60px;
        text-align: center;
    }

    .form-range {
        width: 100%;
        height: 10px;
        background: linear-gradient(to right, var(--primary-light) 0%, var(--primary-color) 100%);
        border-radius: 10px;
        outline: none;
        -webkit-appearance: none;
        position: relative;
    }

    .form-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 83, 197, 0.4);
        transition: all 0.3s ease;
        border: 3px solid white;
    }

    .form-range::-webkit-slider-thumb:hover {
        transform: scale(1.2);
        box-shadow: 0 4px 16px rgba(0, 83, 197, 0.6);
    }

    .form-range::-webkit-slider-thumb:active {
        transform: scale(1.3);
    }

    .form-range::-moz-range-thumb {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 83, 197, 0.4);
        border: 3px solid white;
    }

    /* ===== CHECKBOX GRID LAYOUT ===== */
    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
    }

    @media (max-width: 1024px) {
        .checkbox-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .checkbox-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .checkbox-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-check {
        padding: 0.75rem;
        background: white;
        border-radius: 10px;
        margin-bottom: 0;
        transition: all 0.3s ease;
        border: 2px solid var(--gray-200);
        cursor: pointer;
    }

    .form-check:hover {
        border-color: var(--primary-light);
        background: rgba(0, 83, 197, 0.03);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid var(--gray-300);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 83, 197, 0.1);
    }

    .form-check-input:checked~.form-check-label {
        color: var(--primary-color);
        font-weight: 700;
    }

    .form-check-label {
        margin-left: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--gray-800);
        font-size: 0.9rem;
    }

    /* ===== BUTTON STYLING ===== */
    .btn-info {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border: none;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .btn-info::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-info:hover::before {
        left: 100%;
    }

    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 83, 197, 0.4);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
    }

    .btn-info:active {
        transform: translateY(0);
    }

    /* ===== SECTION ICON ===== */
    .section-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    /* ===== FILE INPUT CUSTOM ===== */
    .custom-file-input::file-selector-button {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }

    .custom-file-input::file-selector-button:hover {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    /* ===== HELPER TEXT ===== */
    .form-text {
        color: var(--gray-600);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    /* ===== SECTION HEADER ===== */
    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--gray-200);
    }

    .section-header-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .section-header-text h6 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    .section-header-text p {
        margin: 0;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    /* ===== LOADING STATE ===== */
    .btn-info:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* ===== ANIMATIONS ===== */
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

    .accordion-item {
        animation: fadeInUp 0.5s ease-out;
    }

    .accordion-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .accordion-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .accordion-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .accordion-body {
            padding: 1.5rem;
        }

        .section-header {
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
        }

        .section-header-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .section-header-text h6 {
            font-size: 1rem;
        }

        .welcome-banner {
            padding: 1rem;
        }

        .welcome-icon {
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
        }

        .welcome-text h6 {
            font-size: 1rem;
        }

        .welcome-text p {
            font-size: 0.8rem;
        }
    }
</style>

<div class="page-content-wrapper">
    <div class="container">
        <!-- User Information Card -->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="user-profile">
                    @php
                        $user = Auth::guard('karyawan')->user();
                        $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                        $defaultAvatar = $user->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                    @endphp
                    <img src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}" alt="avatar">
                </div>
                <div class="user-info">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <h5 class="mb-0">{{ $dataprofile->nama }}</h5>
                        <span class="badge rounded-pill">{{ $dataprofile->nip }}</span>
                    </div>
                    <p class="mb-0 mt-1">{{ $dataprofile->email }}</p>
                </div>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-icon">📝</div>
            <div class="welcome-text">
                <h6>Lengkapi Profil Anda</h6>
                <p>Isi data dengan lengkap untuk meningkatkan peluang menemukan pasangan</p>
            </div>
        </div>

        <!-- Alert Messages -->
        <div class="section">
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('warning'))
                <div class="alert alert-warning">
                    {{ Session::get('warning') }}
                </div>
            @endif
        </div>

        <!-- Accordion Sections -->
        <div class="accordion" id="accordionExample">

            <!-- Section 1: Basic Bio -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="section-icon">👤</span>
                        <b>Biodata Dasar</b>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card user-data-card">
                            <div class="card-body py-3 px-3">
                                <form action="/profile/{{ $dataprofile->email }}/updateprofile" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="nip">
                                                <i class="bi bi-card-text"></i> Nomor Induk Pegawai
                                            </label>
                                            <input class="form-control" id="nip" type="text"
                                                value="{{ $dataprofile->nip }}" placeholder="NIP" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="email">
                                                <i class="bi bi-envelope"></i> Email
                                            </label>
                                            <input class="form-control" id="email" type="text"
                                                value="{{ $dataprofile->email }}" placeholder="Email Address" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="nama">
                                                <i class="bi bi-person"></i> Nama Lengkap
                                            </label>
                                            <input class="form-control" name="nama" id="nama" type="text"
                                                value="{{ $dataprofile->nama }}" placeholder="Masukkan nama lengkap"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="password">
                                                <i class="bi bi-lock"></i> Password Baru
                                            </label>
                                            <input class="form-control" name="password" id="password" type="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                            <small class="form-text">Kosongkan jika tidak ingin mengubah
                                                password</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="foto">
                                            <i class="bi bi-camera"></i> Foto Profil
                                        </label>
                                        <input class="form-control custom-file-input" id="foto" name="foto"
                                            type="file" accept="image/*" onchange="previewImage()">
                                        <small class="form-text">Format: JPG, PNG, JPEG (Maks: 2MB)</small>
                                    </div>

                                    <div class="preview-container" id="preview-container">
                                        <img class="preview-image" id="preview-image"
                                            src="{{ asset('assets/img/preview.png') }}" alt="Preview" />
                                    </div>

                                    <button class="btn btn-info w-100 mt-4" type="submit">
                                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Complete Bio -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="section-icon">📋</span>
                        <b>Biodata Lengkap</b>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card user-data-card">
                            <div class="card-body py-3 px-3">
                                <form action="/profile/{{ $dataprofile->email }}/updateprofile2" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- Personal Info Section -->
                                    <div class="section-header">
                                        <div class="section-header-icon">📞</div>
                                        <div class="section-header-text">
                                            <h6>Informasi Kontak</h6>
                                            <p>Data kontak dan tempat tinggal</p>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="nohp">
                                                <i class="bi bi-phone"></i> No. Handphone
                                            </label>
                                            <input class="form-control" name="nohp" id="nohp" type="text"
                                                value="{{ $dataprofilelengkap->nohp }}"
                                                placeholder="Contoh: 081234567890" maxlength="20" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="tempatlahir">
                                                <i class="bi bi-geo-alt"></i> Tempat Lahir
                                            </label>
                                            <input class="form-control" name="tempatlahir" id="tempatlahir"
                                                type="text" value="{{ $dataprofilelengkap->tempatlahir }}"
                                                placeholder="Contoh: Jakarta" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="alamat">
                                            <i class="bi bi-house"></i> Alamat Lengkap
                                        </label>
                                        <textarea class="form-control" name="alamat" id="alamat"
                                            placeholder="Masukkan alamat lengkap dengan RT/RW, Kelurahan, Kecamatan, Kota" required>{{ $dataprofilelengkap->alamat }}</textarea>
                                    </div>

                                    <!-- Physical Info Section -->
                                    <div class="section-header mt-4">
                                        <div class="section-header-icon">📊</div>
                                        <div class="section-header-text">
                                            <h6>Informasi Fisik</h6>
                                            <p>Data fisik dan kesehatan</p>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="tgllahir">
                                                <i class="bi bi-calendar"></i> Tanggal Lahir
                                            </label>
                                            <input class="form-control" name="tgllahir" id="tgllahir"
                                                type="date" value="{{ $dataprofilelengkap->tgllahir }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="goldar">
                                                <i class="bi bi-droplet"></i> Golongan Darah
                                            </label>
                                            <select class="form-select form-control" name="goldar" id="goldar"
                                                required>
                                                <option value="{{ $dataprofilelengkap->goldar }}">
                                                    {{ $dataprofilelengkap->goldar ?: '- Pilih Golongan Darah -' }}
                                                </option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="tinggi">
                                                <i class="bi bi-arrows-vertical"></i> Tinggi Badan (cm)
                                            </label>
                                            <input class="form-control" name="tinggi" id="tinggi"
                                                placeholder="Contoh: 170" type="text"
                                                value="{{ $dataprofilelengkap->tinggi }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="berat">
                                                <i class="bi bi-speedometer"></i> Berat Badan (kg)
                                            </label>
                                            <input class="form-control" name="berat" id="berat"
                                                placeholder="Contoh: 65" type="text"
                                                value="{{ $dataprofilelengkap->berat }}" required>
                                        </div>
                                    </div>

                                    <!-- Personal Details Section -->
                                    <div class="section-header mt-4">
                                        <div class="section-header-icon">👥</div>
                                        <div class="section-header-text">
                                            <h6>Informasi Pribadi</h6>
                                            <p>Data pribadi dan latar belakang</p>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="statusnikah">
                                                <i class="bi bi-heart"></i> Status Pernikahan
                                            </label>
                                            <select class="form-select form-control" name="statusnikah"
                                                id="statusnikah" required>
                                                <option value="{{ $dataprofilelengkap->statusnikah }}">
                                                    {{ $dataprofilelengkap->statusnikah ?: '- Pilih Status -' }}
                                                </option>
                                                @if ($dataprofile->jenkel == 'pria')
                                                    <option value="Lajang">Lajang</option>
                                                    <option value="Duda">Duda</option>
                                                @else
                                                    <option value="Lajang">Lajang</option>
                                                    <option value="Janda">Janda</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="suku">
                                                <i class="bi bi-people"></i> Suku
                                            </label>
                                            <input class="form-control" name="suku" id="suku" type="text"
                                                value="{{ $dataprofilelengkap->suku }}" placeholder="Contoh: Jawa"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="pekerjaan">
                                                <i class="bi bi-briefcase"></i> Pekerjaan
                                            </label>
                                            <input class="form-control" name="pekerjaan" id="pekerjaan"
                                                type="text" value="{{ $dataprofilelengkap->pekerjaan }}"
                                                placeholder="Contoh: Software Engineer" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="pendidikan">
                                                <i class="bi bi-mortarboard"></i> Pendidikan Terakhir
                                            </label>
                                            <select class="form-select form-control" name="pendidikan"
                                                id="pendidikan" required>
                                                <option value="{{ $dataprofilelengkap->pendidikan }}">
                                                    {{ $dataprofilelengkap->pendidikan ?: '- Pilih Pendidikan -' }}
                                                </option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="D3">Diploma (D3)</option>
                                                <option value="S1">Sarjana (S1)</option>
                                                <option value="S2">Magister (S2)</option>
                                                <option value="S3">Doktor (S3)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label class="form-label" for="hobi">
                                                <i class="bi bi-star"></i> Hobi
                                            </label>
                                            <input class="form-control" name="hobi" id="hobi" type="text"
                                                value="{{ $dataprofilelengkap->hobi }}"
                                                placeholder="Contoh: Membaca, Traveling, Fotografi" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="motto">
                                                <i class="bi bi-quote"></i> Motto Hidup
                                            </label>
                                            <input class="form-control" name="motto" id="motto" type="text"
                                                value="{{ $dataprofilelengkap->motto }}"
                                                placeholder="Masukkan motto hidup Anda" required>
                                        </div>
                                    </div>

                                    <!-- Video Section -->
                                    <div class="section-header mt-4">
                                        <div class="section-header-icon">🎥</div>
                                        <div class="section-header-text">
                                            <h6>Video Perkenalan</h6>
                                            <p>Upload video perkenalan (opsional)</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="video">
                                            <i class="bi bi-camera-video"></i> Video Perkenalan
                                        </label>
                                        <input class="form-control custom-file-input" id="video" name="video"
                                            type="file" accept="video/*" onchange="previewVideo()">
                                        <small class="form-text">Format: MP4, MOV, AVI (Maks: 10MB) - Opsional</small>
                                    </div>

                                    <div class="preview-container" id="video-preview-container"
                                        style="display: none;">
                                        <video class="preview-video" id="preview-video" controls>
                                            <source id="video-source" src="#" type="video/mp4">
                                        </video>
                                    </div>

                                    <button class="btn btn-info w-100 mt-4" type="submit">
                                        <i class="bi bi-check-circle"></i> Simpan Biodata Lengkap
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Partner Criteria -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span class="section-icon">💑</span>
                        <b>Kriteria Pasangan Yang Diharapkan</b>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card user-data-card">
                            <div class="card-body py-3 px-3">
                                <form action="/profile/{{ $dataprofile->email }}/updateprofile3" method="POST">
                                    @csrf

                                    <!-- Age Range -->
                                    <div class="form-group mb-4">
                                        <label class="form-label mb-3">
                                            <i class="bi bi-calendar-range"></i> Rentang Umur
                                        </label>
                                        <div class="range-wrapper">
                                            <div class="range-labels">
                                                <div class="range-label" id="umurAwalLabel">17</div>
                                                <div class="range-label" id="umurAkhirLabel">60</div>
                                            </div>
                                            <input type="range" class="form-range" min="17" max="60"
                                                id="customRange2" value="60">
                                            <input type="hidden" class="form-control" id="umurRange"
                                                name="umurRange" value="{{ $dataprofilelengkap->kriteriaumur }}">
                                        </div>
                                    </div>

                                    <!-- Height and Weight Ranges in 2 columns -->
                                    <div class="form-row-2">
                                        <!-- Height Range -->
                                        <div class="form-group">
                                            <label class="form-label mb-3">
                                                <i class="bi bi-arrows-vertical"></i> Rentang Tinggi (cm)
                                            </label>
                                            <div class="range-wrapper">
                                                <div class="range-labels">
                                                    <div class="range-label" id="tinggiAwalLabel">100</div>
                                                    <div class="range-label" id="tinggiAkhirLabel">200</div>
                                                </div>
                                                <input type="range" class="form-range" min="100"
                                                    max="200" id="customRange3" value="200">
                                                <input type="hidden" class="form-control" id="tinggiRange"
                                                    name="tinggiRange"
                                                    value="{{ $dataprofilelengkap->kriteriatinggi }}">
                                            </div>
                                        </div>

                                        <!-- Weight Range -->
                                        <div class="form-group">
                                            <label class="form-label mb-3">
                                                <i class="bi bi-speedometer"></i> Rentang Berat (kg)
                                            </label>
                                            <div class="range-wrapper">
                                                <div class="range-labels">
                                                    <div class="range-label" id="beratAwalLabel">25</div>
                                                    <div class="range-label" id="beratAkhirLabel">100</div>
                                                </div>
                                                <input type="range" class="form-range" min="25"
                                                    max="100" id="customRange4" value="100">
                                                <input type="hidden" class="form-control" id="beratRange"
                                                    name="beratRange"
                                                    value="{{ $dataprofilelengkap->kriteriaberat }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Suku Section -->
                                    <div class="form-group mb-4 mt-4">
                                        <label class="form-label mb-3">
                                            <i class="bi bi-people"></i> Suku Pasangan yang Diinginkan
                                        </label>
                                        <div class="checkbox-grid">
                                            @php
                                                $sukuList = [
                                                    'Betawi',
                                                    'Jawa',
                                                    'Sunda',
                                                    'Bugis',
                                                    'Batak',
                                                    'Madura',
                                                    'Dayak',
                                                    'Aceh',
                                                    'Melayu',
                                                    'Lampung',
                                                    'Bali',
                                                    'Ambon',
                                                    'Bima',
                                                    'Makassar',
                                                    'Minangkabau',
                                                    'Lainnya',
                                                ];
                                            @endphp
                                            @foreach ($sukuList as $suku)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="{{ strtolower($suku) }}" name="{{ strtolower($suku) }}"
                                                        value="{{ $suku }}">
                                                    <label class="form-check-label" for="{{ strtolower($suku) }}">
                                                        {{ $suku }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <textarea class="form-control mt-3" id="sukupilihan" name="sukupilihan" type="text" hidden>{{ $dataprofilelengkap->kriteriasuku }}</textarea>
                                    </div>

                                    <!-- General Criteria -->
                                    <div class="form-group">
                                        <label class="form-label" for="kriteriaumum">
                                            <i class="bi bi-card-text"></i> Kriteria Umum Lainnya
                                        </label>
                                        <textarea class="form-control" name="kriteriaumum" id="kriteriaumum"
                                            placeholder="Jelaskan kriteria lain yang Anda harapkan dari pasangan (sifat, karakter, nilai-nilai, dll)">{{ $dataprofilelengkap->kriteriaumum }}</textarea>
                                    </div>

                                    <button class="btn btn-info w-100 mt-4" type="submit">
                                        <i class="bi bi-check-circle"></i> Simpan Kriteria Pasangan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Image Preview
    function previewImage() {
        const input = document.getElementById('foto');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }
    }

    // Video Preview
    function previewVideo() {
        const input = document.getElementById('video');
        const previewContainer = document.getElementById('video-preview-container');
        const previewVideo = document.getElementById('preview-video');
        const videoSource = document.getElementById('video-source');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                videoSource.src = e.target.result;
                previewContainer.style.display = 'flex';
                previewVideo.load();
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    }

    // Range Sliders
    const customRange2 = document.getElementById('customRange2');
    const customRange3 = document.getElementById('customRange3');
    const customRange4 = document.getElementById('customRange4');

    const umurRangeInput = document.getElementById('umurRange');
    const umurAwalLabel = document.getElementById('umurAwalLabel');
    const umurAkhirLabel = document.getElementById('umurAkhirLabel');

    const tinggiRangeInput = document.getElementById('tinggiRange');
    const tinggiAwalLabel = document.getElementById('tinggiAwalLabel');
    const tinggiAkhirLabel = document.getElementById('tinggiAkhirLabel');

    const beratRangeInput = document.getElementById('beratRange');
    const beratAwalLabel = document.getElementById('beratAwalLabel');
    const beratAkhirLabel = document.getElementById('beratAkhirLabel');

    customRange2.addEventListener('input', updateUmurRange);
    customRange3.addEventListener('input', updateTinggiRange);
    customRange4.addEventListener('input', updateBeratRange);

    function updateUmurRange() {
        const umurAwal = customRange2.min;
        const umurAkhir = customRange2.value;
        umurRangeInput.value = `${umurAwal} - ${umurAkhir}`;
        umurAwalLabel.textContent = umurAwal;
        umurAkhirLabel.textContent = umurAkhir;
    }

    function updateTinggiRange() {
        const tinggiAwal = customRange3.min;
        const tinggiAkhir = customRange3.value;
        tinggiRangeInput.value = `${tinggiAwal} - ${tinggiAkhir}`;
        tinggiAwalLabel.textContent = tinggiAwal;
        tinggiAkhirLabel.textContent = tinggiAkhir;
    }

    function updateBeratRange() {
        const beratAwal = customRange4.min;
        const beratAkhir = customRange4.value;
        beratRangeInput.value = `${beratAwal} - ${beratAkhir}`;
        beratAwalLabel.textContent = beratAwal;
        beratAkhirLabel.textContent = beratAkhir;
    }

    // Checkbox for Suku
    const checkboxes = document.querySelectorAll('.form-check-input[type="checkbox"]');
    const sukupilihanInput = document.getElementById('sukupilihan');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updatesukupilihan);
    });

    function updatesukupilihan() {
        const sukupilihan = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value)
            .join(', ');
        sukupilihanInput.value = sukupilihan;
    }

    // Initialize ranges on load
    updateUmurRange();
    updateTinggiRange();
    updateBeratRange();
</script>

@push('myscript')
    <script>
        $(function() {
            $('#nohp').mask('0000000000000');
            $('#tinggi').mask('000');
            $('#berat').mask('000');
        });
    </script>
@endpush
