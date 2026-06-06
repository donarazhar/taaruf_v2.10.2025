@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== EDUKASI MANAGEMENT PAGE ===== */

        /* --- Hero Header --- */
        .edu-hero {
            background: linear-gradient(135deg, var(--primary) 0%, #1a6fb5 50%, var(--accent) 100%);
            border-radius: var(--radius-lg);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .edu-hero::before {
            content: '';
            position: absolute;
            top: -60%;
            right: -15%;
            width: 320px;
            height: 320px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
            pointer-events: none;
        }

        .edu-hero::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            pointer-events: none;
        }

        .edu-hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .edu-hero h1 {
            font-size: 1.65rem;
            font-weight: 800;
            margin: 0 0 0.35rem 0;
            letter-spacing: -0.02em;
        }

        .edu-hero p {
            opacity: 0.85;
            font-size: 0.95rem;
            margin: 0;
        }

        .edu-hero .breadcrumb-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s;
        }

        .edu-hero .breadcrumb-link:hover { color: #fff; }

        .edu-hero .breadcrumb-sep {
            color: rgba(255,255,255,0.4);
            margin: 0 6px;
            font-size: 0.8rem;
        }

        .edu-hero .breadcrumb-active {
            color: rgba(255,255,255,0.95);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* --- Stats Row --- */
        .edu-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .edu-stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .edu-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .edu-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .edu-stat-icon.video { background: rgba(239,68,68,0.1); color: #ef4444; }
        .edu-stat-icon.artikel { background: rgba(59,130,246,0.1); color: #3b82f6; }
        .edu-stat-icon.kelas { background: rgba(16,185,129,0.1); color: #10b981; }
        .edu-stat-icon.total { background: rgba(15,76,129,0.1); color: var(--primary); }

        .edu-stat-info h3 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            color: var(--text-main);
            line-height: 1.2;
        }

        .edu-stat-info span {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- Add Button --- */
        .btn-add-edu {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.65rem 1.4rem;
            background: rgba(255,255,255,0.15);
            color: #fff;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .btn-add-edu:hover {
            background: rgba(255,255,255,0.25);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-2px);
        }

        /* --- Alert Styles --- */
        .edu-alert {
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            animation: eduSlideDown 0.4s ease;
        }

        .edu-alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .edu-alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        body.dark-mode .edu-alert-success {
            background: rgba(16,185,129,0.15);
            color: #6ee7b7;
            border-color: rgba(16,185,129,0.3);
        }

        body.dark-mode .edu-alert-danger {
            background: rgba(239,68,68,0.15);
            color: #fca5a5;
            border-color: rgba(239,68,68,0.3);
        }

        .edu-alert .close-alert {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            opacity: 0.5;
            font-size: 1.1rem;
            color: inherit;
            transition: opacity 0.2s;
        }

        .edu-alert .close-alert:hover { opacity: 1; }

        @keyframes eduSlideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Toolbar --- */
        .edu-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .edu-toolbar-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .edu-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.55rem 1.1rem;
            border-radius: 50px;
            border: 1.5px solid var(--gray-200);
            background: var(--white);
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .edu-filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .edu-filter-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 2px 8px rgba(15,76,129,0.25);
        }

        .edu-filter-btn .filter-count {
            background: rgba(0,0,0,0.08);
            padding: 2px 7px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            min-width: 22px;
            text-align: center;
        }

        .edu-filter-btn.active .filter-count {
            background: rgba(255,255,255,0.25);
            color: #fff;
        }

        /* --- Card Wrapper --- */
        .edu-card-wrapper {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .edu-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .edu-card-header h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .edu-card-header .result-count {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* --- Table Styles --- */
        .edu-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .edu-table thead th {
            background: var(--gray-50);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            white-space: nowrap;
        }

        .edu-table tbody tr {
            transition: background 0.2s ease;
        }

        .edu-table tbody tr:hover {
            background: var(--gray-50);
        }

        .edu-table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .edu-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Type Badge */
        .edu-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .edu-type-badge.video { background: rgba(239,68,68,0.1); color: #dc2626; }
        .edu-type-badge.artikel { background: rgba(59,130,246,0.1); color: #2563eb; }
        .edu-type-badge.kelas { background: rgba(16,185,129,0.1); color: #059669; }

        /* Status Badge */
        .edu-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .edu-status.aktif {
            background: rgba(16,185,129,0.1);
            color: #059669;
        }

        .edu-status.aktif::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
            animation: pulse-dot 2s infinite;
        }

        .edu-status.draft {
            background: rgba(100,116,139,0.1);
            color: #64748b;
        }

        .edu-status.draft::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #94a3b8;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* Title Cell */
        .edu-title-cell {
            font-weight: 600;
            color: var(--text-main);
            max-width: 250px;
        }

        .edu-title-cell .title-text {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Konten Info */
        .edu-konten-info {
            font-size: 0.85rem;
            color: var(--text-muted);
            max-width: 280px;
        }

        .edu-konten-info .info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 2px;
        }

        .edu-konten-info .info-item i { font-size: 0.7rem; width: 14px; opacity: 0.6; }
        .edu-konten-info .pendaftar-count { color: var(--primary); font-weight: 600; }

        /* Number Cell */
        .edu-num {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Action Buttons */
        .edu-actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .btn-edu-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray-200);
            background: var(--white);
            color: var(--text-muted);
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            position: relative;
        }

        .btn-edu-action:hover { transform: translateY(-1px); box-shadow: var(--shadow-sm); }
        .btn-edu-action.edit:hover { background: #fef3c7; color: #d97706; border-color: #fde68a; }
        .btn-edu-action.delete:hover { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
        .btn-edu-action.peserta:hover { background: rgba(59,130,246,0.08); color: #2563eb; border-color: #bfdbfe; }

        /* Tooltip */
        .btn-edu-action[title] { position: relative; }

        /* --- Empty State --- */
        .edu-empty {
            text-align: center;
            padding: 4rem 2rem;
        }

        .edu-empty-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        .edu-empty-icon i { font-size: 1.75rem; color: var(--primary); }

        .edu-empty h6 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.4rem;
        }

        .edu-empty p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0;
        }

        /* --- Custom Modal (matches sidebar modal system) --- */
        .edu-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: flex-start;
            justify-content: center;
            padding-top: 5vh;
            overflow-y: auto;
        }

        .edu-modal.show {
            display: flex;
        }

        .edu-modal-dialog {
            background: var(--white);
            border-radius: var(--radius-lg);
            max-width: 680px;
            width: 92%;
            box-shadow: var(--shadow-xl);
            animation: eduModalSlideIn 0.3s ease-out;
            overflow: hidden;
            margin-bottom: 5vh;
        }

        @keyframes eduModalSlideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .edu-modal-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            padding: 1.35rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .edu-modal-header h5 {
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edu-modal-close {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .edu-modal-close:hover { background: rgba(255,255,255,0.3); }

        .edu-modal-body {
            padding: 1.75rem;
        }

        .edu-modal-footer {
            padding: 1.25rem 1.75rem;
            border-top: 1px solid var(--gray-100);
            background: var(--gray-50);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* --- Form Styles --- */
        .edu-form-group {
            margin-bottom: 1.25rem;
        }

        .edu-form-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-main);
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .edu-form-group label .req {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #ef4444;
            display: inline-block;
        }

        .edu-form-control {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-main);
            background: var(--white);
            transition: all 0.25s ease;
            outline: none;
            box-sizing: border-box;
        }

        .edu-form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15,76,129,0.08);
        }

        .edu-form-control::placeholder { color: var(--gray-400); }

        textarea.edu-form-control { resize: vertical; min-height: 80px; }

        .edu-form-hint {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .edu-form-hint i { font-size: 0.7rem; }

        .edu-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Jenis Selector Tabs */
        .jenis-selector {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .jenis-option {
            flex: 1;
            padding: 0.85rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            background: var(--white);
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: center;
            position: relative;
        }

        .jenis-option:hover {
            border-color: var(--gray-300);
            background: var(--gray-50);
        }

        .jenis-option.selected {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .jenis-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .jenis-option .jenis-icon {
            font-size: 1.5rem;
            margin-bottom: 0.35rem;
            display: block;
        }

        .jenis-option .jenis-icon.video-icon { color: #ef4444; }
        .jenis-option .jenis-icon.artikel-icon { color: #3b82f6; }
        .jenis-option .jenis-icon.kelas-icon { color: #10b981; }

        .jenis-option .jenis-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-main);
            display: block;
        }

        .jenis-option .jenis-desc {
            font-size: 0.72rem;
            color: var(--text-muted);
            display: block;
            margin-top: 2px;
        }

        .jenis-option.selected .jenis-label { color: var(--primary); }

        .jenis-option .check-icon {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
        }

        .jenis-option.selected .check-icon { display: flex; }

        /* Conditional Fields */
        .edu-conditional {
            display: none;
            animation: eduSlideDown 0.3s ease;
        }

        .edu-conditional.show { display: block; }

        .edu-section-box {
            background: var(--gray-50);
            border: 1.5px dashed var(--gray-300);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .edu-section-box h6 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Buttons */
        .btn-edu-cancel {
            padding: 0.6rem 1.25rem;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--gray-300);
            background: var(--white);
            color: var(--text-main);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-edu-cancel:hover { background: var(--gray-100); }

        .btn-edu-submit {
            padding: 0.6rem 1.5rem;
            border-radius: var(--radius-md);
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edu-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15,76,129,0.25);
        }

        /* --- Peserta Modal Table --- */
        .peserta-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .peserta-table thead th {
            background: var(--gray-50);
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .peserta-table tbody td {
            padding: 0.75rem 1rem;
            font-size: 0.88rem;
            color: var(--text-main);
            border-bottom: 1px solid var(--gray-100);
        }

        .peserta-table tbody tr:last-child td { border-bottom: none; }
        .peserta-table tbody tr:hover { background: var(--gray-50); }

        .peserta-empty-msg {
            text-align: center;
            padding: 2rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .peserta-empty-msg i {
            display: block;
            font-size: 2rem;
            margin-bottom: 0.75rem;
            opacity: 0.3;
        }

        /* --- Stagger Animation --- */
        .edu-stagger > * {
            animation: eduFadeInUp 0.4s ease forwards;
            opacity: 0;
        }

        .edu-stagger > *:nth-child(1) { animation-delay: 0.05s; }
        .edu-stagger > *:nth-child(2) { animation-delay: 0.1s; }
        .edu-stagger > *:nth-child(3) { animation-delay: 0.15s; }
        .edu-stagger > *:nth-child(4) { animation-delay: 0.2s; }

        @keyframes eduFadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            .edu-hero { padding: 1.5rem; }
            .edu-hero h1 { font-size: 1.3rem; }
            .edu-hero-inner { flex-direction: column; align-items: flex-start; }
            .edu-stats { grid-template-columns: repeat(2, 1fr); }
            .edu-toolbar { flex-direction: column; align-items: stretch; }
            .edu-toolbar-left { overflow-x: auto; padding-bottom: 4px; }
            .edu-form-row { grid-template-columns: 1fr; }
            .jenis-selector { flex-direction: column; }
            .edu-modal-dialog { width: 96%; }
        }

        @media (max-width: 480px) {
            .edu-stats { grid-template-columns: 1fr; }
        }
    </style>

    <div class="container-fluid edu-stagger">
        {{-- Hero Header --}}
        <div class="edu-hero">
            <div class="edu-hero-inner">
                <div>
                    <div style="margin-bottom: 0.75rem;">
                        <a href="/dashboardadmin" class="breadcrumb-link"><i class="fas fa-home"></i> Dashboard</a>
                        <span class="breadcrumb-sep">/</span>
                        <span class="breadcrumb-active">Kelola Edukasi</span>
                    </div>
                    <h1><i class="fas fa-book-open" style="margin-right: 8px;"></i> Kelola Edukasi Pranikah</h1>
                    <p>Manajemen artikel, video YouTube, dan kelas pranikah untuk peserta ta'aruf</p>
                </div>
                <button class="btn-add-edu" onclick="openModal('addEdukasiModal')">
                    <i class="fas fa-plus"></i> Tambah Materi
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        @php
            $countVideo = $listEdukasi->where('jenis', 'video')->count();
            $countArtikel = $listEdukasi->where('jenis', 'artikel')->count();
            $countKelas = $listEdukasi->where('jenis', 'kelas')->count();
            $countTotal = $listEdukasi->count();
        @endphp
        <div class="edu-stats">
            <div class="edu-stat-card">
                <div class="edu-stat-icon total"><i class="fas fa-layer-group"></i></div>
                <div class="edu-stat-info">
                    <h3>{{ $countTotal }}</h3>
                    <span>Total Materi</span>
                </div>
            </div>
            <div class="edu-stat-card">
                <div class="edu-stat-icon video"><i class="fab fa-youtube"></i></div>
                <div class="edu-stat-info">
                    <h3>{{ $countVideo }}</h3>
                    <span>Video</span>
                </div>
            </div>
            <div class="edu-stat-card">
                <div class="edu-stat-icon artikel"><i class="fas fa-file-alt"></i></div>
                <div class="edu-stat-info">
                    <h3>{{ $countArtikel }}</h3>
                    <span>Artikel</span>
                </div>
            </div>
            <div class="edu-stat-card">
                <div class="edu-stat-icon kelas"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="edu-stat-info">
                    <h3>{{ $countKelas }}</h3>
                    <span>Kelas</span>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if (Session::get('success'))
            <div class="edu-alert edu-alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ Session::get('success') }}</span>
                <button class="close-alert" onclick="this.parentElement.remove();">&times;</button>
            </div>
        @endif

        @if (Session::get('error'))
            <div class="edu-alert edu-alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ Session::get('error') }}</span>
                <button class="close-alert" onclick="this.parentElement.remove();">&times;</button>
            </div>
        @endif

        {{-- Toolbar with Filters --}}
        <div class="edu-toolbar">
            <div class="edu-toolbar-left">
                <button class="edu-filter-btn active" onclick="filterEdukasi('all', this)">
                    <i class="fas fa-th-list"></i> Semua
                    <span class="filter-count">{{ $countTotal }}</span>
                </button>
                <button class="edu-filter-btn" onclick="filterEdukasi('video', this)">
                    <i class="fab fa-youtube"></i> Video
                    <span class="filter-count">{{ $countVideo }}</span>
                </button>
                <button class="edu-filter-btn" onclick="filterEdukasi('artikel', this)">
                    <i class="fas fa-file-alt"></i> Artikel
                    <span class="filter-count">{{ $countArtikel }}</span>
                </button>
                <button class="edu-filter-btn" onclick="filterEdukasi('kelas', this)">
                    <i class="fas fa-chalkboard-teacher"></i> Kelas
                    <span class="filter-count">{{ $countKelas }}</span>
                </button>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="edu-card-wrapper">
            <div class="edu-card-header">
                <h5><i class="fas fa-list-ul" style="margin-right: 8px; opacity: 0.5;"></i> Daftar Materi</h5>
                <span class="result-count" id="resultCount">{{ $countTotal }} materi ditemukan</span>
            </div>

            <div style="overflow-x: auto;">
                <table class="edu-table" id="edukasiTable">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th style="width:100px;">Jenis</th>
                            <th>Judul</th>
                            <th>Detail</th>
                            <th style="width:90px;">Status</th>
                            <th style="width:130px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listEdukasi as $index => $item)
                        <tr data-jenis="{{ $item->jenis }}">
                            <td>
                                <div class="edu-num">{{ $index + 1 }}</div>
                            </td>
                            <td>
                                @if($item->jenis == 'video')
                                    <span class="edu-type-badge video"><i class="fab fa-youtube"></i> Video</span>
                                @elseif($item->jenis == 'artikel')
                                    <span class="edu-type-badge artikel"><i class="fas fa-file-alt"></i> Artikel</span>
                                @else
                                    <span class="edu-type-badge kelas"><i class="fas fa-chalkboard-teacher"></i> Kelas</span>
                                @endif
                            </td>
                            <td>
                                <div class="edu-title-cell">
                                    <span class="title-text" title="{{ $item->judul }}">{{ $item->judul }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="edu-konten-info">
                                    @if($item->jenis == 'kelas')
                                        <div class="info-item">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-users"></i>
                                            <span>Kuota: {{ $item->kuota }} orang</span>
                                        </div>
                                        @php $countDaftar = isset($pendaftar[$item->id]) ? count($pendaftar[$item->id]) : 0; @endphp
                                        <div class="info-item">
                                            <i class="fas fa-user-check"></i>
                                            <span class="pendaftar-count">{{ $countDaftar }} pendaftar</span>
                                        </div>
                                    @else
                                        <span>{{ Str::limit($item->konten, 60) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="edu-status {{ $item->status }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td style="text-align:center;">
                                <div class="edu-actions" style="justify-content:center;">
                                    <button class="btn-edu-action edit" title="Edit" onclick="openModal('editModal{{ $item->id }}')">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <a href="{{ route('murobi.edukasi.delete', $item->id) }}" class="btn-edu-action delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus materi ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    @if($item->jenis == 'kelas')
                                        <button class="btn-edu-action peserta" title="Lihat Peserta" onclick="openModal('pendaftarModal{{ $item->id }}')">
                                            <i class="fas fa-users"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="6" style="border:none;">
                                <div class="edu-empty">
                                    <div class="edu-empty-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <h6>Belum Ada Materi Edukasi</h6>
                                    <p>Mulai tambahkan materi edukasi untuk peserta ta'aruf.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODALS (outside the table, using custom modal system) --}}
    {{-- ========================================== --}}

    {{-- ADD NEW EDUKASI MODAL --}}
    <div class="edu-modal" id="addEdukasiModal">
        <div class="edu-modal-dialog">
            <div class="edu-modal-header">
                <h5><i class="fas fa-plus-circle"></i> Tambah Materi Edukasi</h5>
                <button class="edu-modal-close" onclick="closeModal('addEdukasiModal')">&times;</button>
            </div>
            <form action="{{ route('murobi.edukasi.store') }}" method="POST">
                @csrf
                <div class="edu-modal-body">
                    {{-- Jenis Selector - Visual Tabs --}}
                    <div class="edu-form-group">
                        <label><span class="req"></span> Pilih Jenis Materi</label>
                    </div>
                    <input type="hidden" name="jenis" id="addJenisInput" value="video" required>
                    <div class="jenis-selector" id="addJenisSelector">
                        <label class="jenis-option selected" data-value="video" onclick="selectJenis('add', 'video', this)">
                            <span class="check-icon"><i class="fas fa-check"></i></span>
                            <span class="jenis-icon video-icon"><i class="fab fa-youtube"></i></span>
                            <span class="jenis-label">Video YouTube</span>
                            <span class="jenis-desc">Embed video dari YouTube</span>
                        </label>
                        <label class="jenis-option" data-value="artikel" onclick="selectJenis('add', 'artikel', this)">
                            <span class="check-icon"><i class="fas fa-check"></i></span>
                            <span class="jenis-icon artikel-icon"><i class="fas fa-file-alt"></i></span>
                            <span class="jenis-label">Artikel</span>
                            <span class="jenis-desc">Teks edukasi / panduan</span>
                        </label>
                        <label class="jenis-option" data-value="kelas" onclick="selectJenis('add', 'kelas', this)">
                            <span class="check-icon"><i class="fas fa-check"></i></span>
                            <span class="jenis-icon kelas-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                            <span class="jenis-label">Kelas / Seminar</span>
                            <span class="jenis-desc">Kegiatan pranikah offline</span>
                        </label>
                    </div>

                    {{-- Judul --}}
                    <div class="edu-form-group">
                        <label><span class="req"></span> Judul Materi</label>
                        <input type="text" name="judul" class="edu-form-control" placeholder="Contoh: Membangun Keluarga Sakinah" required>
                    </div>

                    {{-- Video Fields --}}
                    <div class="edu-conditional show" id="addFieldsVideo">
                        <div class="edu-form-group">
                            <label><span class="req"></span> URL Video YouTube</label>
                            <input type="text" name="konten" class="edu-form-control add-konten-field" placeholder="https://www.youtube.com/watch?v=XXXXX">
                            <div class="edu-form-hint">
                                <i class="fas fa-info-circle"></i>
                                Masukkan link video YouTube lengkap
                            </div>
                        </div>
                    </div>

                    {{-- Artikel Fields --}}
                    <div class="edu-conditional" id="addFieldsArtikel">
                        <div class="edu-form-group">
                            <label><span class="req"></span> Isi Artikel</label>
                            <textarea name="" class="edu-form-control add-konten-field" rows="6" placeholder="Tulis isi artikel edukasi di sini..."></textarea>
                            <div class="edu-form-hint">
                                <i class="fas fa-info-circle"></i>
                                Tulis teks artikel edukasi pranikah secara lengkap
                            </div>
                        </div>
                    </div>

                    {{-- Kelas Fields --}}
                    <div class="edu-conditional" id="addFieldsKelas">
                        <div class="edu-form-group">
                            <label><span class="req"></span> Deskripsi Kelas</label>
                            <textarea name="" class="edu-form-control add-konten-field" rows="4" placeholder="Deskripsi kegiatan, pembicara, lokasi, dll."></textarea>
                        </div>
                        <div class="edu-section-box">
                            <h6><i class="fas fa-calendar-alt"></i> Detail Kegiatan</h6>
                            <div class="edu-form-row">
                                <div class="edu-form-group">
                                    <label>Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" class="edu-form-control">
                                </div>
                                <div class="edu-form-group">
                                    <label>Kuota Peserta</label>
                                    <input type="number" name="kuota" class="edu-form-control" placeholder="Contoh: 50" min="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="edu-form-group">
                        <label><span class="req"></span> Status</label>
                        <select name="status" class="edu-form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="draft">Draft (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
                <div class="edu-modal-footer">
                    <button type="button" class="btn-edu-cancel" onclick="closeModal('addEdukasiModal')">Batal</button>
                    <button type="submit" class="btn-edu-submit">
                        <i class="fas fa-save"></i> Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT & PESERTA MODALS (per item) --}}
    @foreach($listEdukasi as $item)
        {{-- Edit Modal --}}
        <div class="edu-modal" id="editModal{{ $item->id }}">
            <div class="edu-modal-dialog">
                <div class="edu-modal-header">
                    <h5><i class="fas fa-pen"></i> Edit Materi Edukasi</h5>
                    <button class="edu-modal-close" onclick="closeModal('editModal{{ $item->id }}')">&times;</button>
                </div>
                <form action="{{ route('murobi.edukasi.update', $item->id) }}" method="POST">
                    @csrf
                    <div class="edu-modal-body">
                        {{-- Jenis Selector --}}
                        <div class="edu-form-group">
                            <label><span class="req"></span> Pilih Jenis Materi</label>
                        </div>
                        <input type="hidden" name="jenis" class="edit-jenis-input" value="{{ $item->jenis }}" required>
                        <div class="jenis-selector">
                            <label class="jenis-option {{ $item->jenis == 'video' ? 'selected' : '' }}" onclick="selectJenisEdit(this, '{{ $item->id }}', 'video')">
                                <span class="check-icon"><i class="fas fa-check"></i></span>
                                <span class="jenis-icon video-icon"><i class="fab fa-youtube"></i></span>
                                <span class="jenis-label">Video YouTube</span>
                                <span class="jenis-desc">Embed video dari YouTube</span>
                            </label>
                            <label class="jenis-option {{ $item->jenis == 'artikel' ? 'selected' : '' }}" onclick="selectJenisEdit(this, '{{ $item->id }}', 'artikel')">
                                <span class="check-icon"><i class="fas fa-check"></i></span>
                                <span class="jenis-icon artikel-icon"><i class="fas fa-file-alt"></i></span>
                                <span class="jenis-label">Artikel</span>
                                <span class="jenis-desc">Teks edukasi / panduan</span>
                            </label>
                            <label class="jenis-option {{ $item->jenis == 'kelas' ? 'selected' : '' }}" onclick="selectJenisEdit(this, '{{ $item->id }}', 'kelas')">
                                <span class="check-icon"><i class="fas fa-check"></i></span>
                                <span class="jenis-icon kelas-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                                <span class="jenis-label">Kelas / Seminar</span>
                                <span class="jenis-desc">Kegiatan pranikah offline</span>
                            </label>
                        </div>

                        {{-- Judul --}}
                        <div class="edu-form-group">
                            <label><span class="req"></span> Judul Materi</label>
                            <input type="text" name="judul" class="edu-form-control" value="{{ $item->judul }}" required>
                        </div>

                        {{-- Konten --}}
                        <div class="edu-form-group">
                            <label><span class="req"></span> Konten</label>
                            <textarea name="konten" class="edu-form-control" rows="4" required>{{ $item->konten }}</textarea>
                            <div class="edu-form-hint" id="editKontenHint{{ $item->id }}">
                                <i class="fas fa-info-circle"></i>
                                @if($item->jenis == 'video')
                                    Masukkan link video YouTube lengkap
                                @elseif($item->jenis == 'artikel')
                                    Tulis teks artikel edukasi pranikah
                                @else
                                    Deskripsi kelas, pembicara, lokasi, dll.
                                @endif
                            </div>
                        </div>

                        {{-- Kelas Fields --}}
                        <div class="edu-conditional {{ $item->jenis == 'kelas' ? 'show' : '' }}" id="editKelasFields{{ $item->id }}">
                            <div class="edu-section-box">
                                <h6><i class="fas fa-calendar-alt"></i> Detail Kegiatan</h6>
                                <div class="edu-form-row">
                                    <div class="edu-form-group">
                                        <label>Tanggal Kegiatan</label>
                                        <input type="date" name="tanggal_kegiatan" class="edu-form-control" value="{{ $item->tanggal_kegiatan }}">
                                    </div>
                                    <div class="edu-form-group">
                                        <label>Kuota Peserta</label>
                                        <input type="number" name="kuota" class="edu-form-control" value="{{ $item->kuota }}" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="edu-form-group">
                            <label><span class="req"></span> Status</label>
                            <select name="status" class="edu-form-control" required>
                                <option value="aktif" {{ $item->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="edu-modal-footer">
                        <button type="button" class="btn-edu-cancel" onclick="closeModal('editModal{{ $item->id }}')">Batal</button>
                        <button type="submit" class="btn-edu-submit">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Peserta Modal --}}
        @if($item->jenis == 'kelas')
        <div class="edu-modal" id="pendaftarModal{{ $item->id }}">
            <div class="edu-modal-dialog">
                <div class="edu-modal-header">
                    <h5><i class="fas fa-users"></i> Peserta Kelas</h5>
                    <button class="edu-modal-close" onclick="closeModal('pendaftarModal{{ $item->id }}')">&times;</button>
                </div>
                <div class="edu-modal-body" style="padding: 0;">
                    <div style="padding: 1.25rem 1.75rem 0.75rem; border-bottom: 1px solid var(--gray-100);">
                        <h6 style="font-weight: 700; color: var(--text-main); margin: 0;">{{ $item->judul }}</h6>
                        <p style="font-size: 0.82rem; color: var(--text-muted); margin: 0.25rem 0 0;">
                            {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }} · Kuota: {{ $item->kuota }} orang
                        </p>
                    </div>
                    @if(isset($pendaftar[$item->id]) && count($pendaftar[$item->id]) > 0)
                        <div style="overflow-x: auto;">
                            <table class="peserta-table">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">No</th>
                                        <th>Nama Peserta</th>
                                        <th>Email / NIP</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftar[$item->id] as $idx => $peserta)
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td style="font-weight: 500;">{{ $peserta->nama }}</td>
                                        <td>{{ $peserta->karyawan_email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($peserta->created_at)->format('d M Y, H:i') }}</td>
                                        <td>
                                            @if($peserta->status_pendaftaran == 'diterima')
                                                <span class="edu-status aktif" style="font-size: 0.7rem; padding: 2px 8px;">Diterima</span>
                                            @elseif($peserta->status_pendaftaran == 'ditolak')
                                                <span class="edu-status draft" style="font-size: 0.7rem; padding: 2px 8px; background: rgba(239,68,68,0.1); color: #dc2626;">Ditolak</span>
                                            @else
                                                <span class="edu-status" style="font-size: 0.7rem; padding: 2px 8px; background: rgba(245,158,11,0.1); color: #d97706;">Menunggu</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if($peserta->status_pendaftaran == 'menunggu')
                                                <div style="display: flex; gap: 4px; justify-content: center;">
                                                    <form action="{{ route('murobi.edukasi.peserta.approve', $peserta->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-edu-action" style="background: rgba(16,185,129,0.1); color: #059669; border-color: #a7f3d0;" title="Terima" onclick="return confirm('Terima pendaftaran peserta ini?')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('murobi.edukasi.peserta.reject', $peserta->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-edu-action" style="background: rgba(239,68,68,0.1); color: #dc2626; border-color: #fecaca;" title="Tolak" onclick="return confirm('Tolak pendaftaran peserta ini?')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span style="font-size: 0.8rem; color: var(--text-muted);">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="peserta-empty-msg">
                            <i class="fas fa-user-slash"></i>
                            Belum ada peserta yang mendaftar di kelas ini.
                        </div>
                    @endif
                </div>
                <div class="edu-modal-footer">
                    <button type="button" class="btn-edu-cancel" onclick="closeModal('pendaftarModal{{ $item->id }}')">Tutup</button>
                </div>
            </div>
        </div>
        @endif
    @endforeach

    @push('myscript')
    <script>
        // ===== MODAL SYSTEM =====
        function openModal(id) {
            var modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(id) {
            var modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        // Close modal on backdrop click
        document.querySelectorAll('.edu-modal').forEach(function(modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.edu-modal.show').forEach(function(modal) {
                    modal.classList.remove('show');
                });
                document.body.style.overflow = '';
            }
        });

        // ===== JENIS SELECTOR - ADD MODAL =====
        function selectJenis(mode, value, el) {
            // Update visual selection
            var container = el.parentElement;
            container.querySelectorAll('.jenis-option').forEach(function(opt) {
                opt.classList.remove('selected');
            });
            el.classList.add('selected');

            // Update hidden input
            document.getElementById('addJenisInput').value = value;

            // Toggle conditional fields
            document.getElementById('addFieldsVideo').classList.remove('show');
            document.getElementById('addFieldsArtikel').classList.remove('show');
            document.getElementById('addFieldsKelas').classList.remove('show');

            // Clear all konten field names first
            document.querySelectorAll('#addEdukasiModal .add-konten-field').forEach(function(field) {
                field.removeAttribute('name');
                field.removeAttribute('required');
            });

            if (value === 'video') {
                document.getElementById('addFieldsVideo').classList.add('show');
                var field = document.querySelector('#addFieldsVideo .add-konten-field');
                field.setAttribute('name', 'konten');
                field.setAttribute('required', 'required');
            } else if (value === 'artikel') {
                document.getElementById('addFieldsArtikel').classList.add('show');
                var field = document.querySelector('#addFieldsArtikel .add-konten-field');
                field.setAttribute('name', 'konten');
                field.setAttribute('required', 'required');
            } else if (value === 'kelas') {
                document.getElementById('addFieldsKelas').classList.add('show');
                var field = document.querySelector('#addFieldsKelas .add-konten-field');
                field.setAttribute('name', 'konten');
                field.setAttribute('required', 'required');
            }
        }

        // ===== JENIS SELECTOR - EDIT MODALS =====
        function selectJenisEdit(el, itemId, value) {
            // Update visual selection
            var container = el.parentElement;
            container.querySelectorAll('.jenis-option').forEach(function(opt) {
                opt.classList.remove('selected');
            });
            el.classList.add('selected');

            // Update hidden input
            var modal = el.closest('.edu-modal');
            modal.querySelector('.edit-jenis-input').value = value;

            // Toggle kelas fields
            var kelasFields = document.getElementById('editKelasFields' + itemId);
            if (kelasFields) {
                if (value === 'kelas') {
                    kelasFields.classList.add('show');
                } else {
                    kelasFields.classList.remove('show');
                }
            }

            // Update hint text
            var hint = document.getElementById('editKontenHint' + itemId);
            if (hint) {
                if (value === 'video') {
                    hint.innerHTML = '<i class="fas fa-info-circle"></i> Masukkan link video YouTube lengkap';
                } else if (value === 'artikel') {
                    hint.innerHTML = '<i class="fas fa-info-circle"></i> Tulis teks artikel edukasi pranikah';
                } else {
                    hint.innerHTML = '<i class="fas fa-info-circle"></i> Deskripsi kelas, pembicara, lokasi, dll.';
                }
            }
        }

        // ===== FILTER =====
        function filterEdukasi(jenis, btn) {
            // Update active button
            document.querySelectorAll('.edu-filter-btn').forEach(function(b) {
                b.classList.remove('active');
            });
            btn.classList.add('active');

            // Filter rows
            var rows = document.querySelectorAll('#edukasiTable tbody tr[data-jenis]');
            var visibleCount = 0;

            rows.forEach(function(row) {
                if (jenis === 'all' || row.dataset.jenis === jenis) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update count
            var resultCount = document.getElementById('resultCount');
            if (resultCount) {
                resultCount.textContent = visibleCount + ' materi ditemukan';
            }
        }

        // ===== AUTO-DISMISS ALERTS =====
        setTimeout(function() {
            document.querySelectorAll('.edu-alert').forEach(function(alert) {
                alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() { alert.remove(); }, 400);
            });
        }, 5000);
    </script>
    @endpush
@endsection
