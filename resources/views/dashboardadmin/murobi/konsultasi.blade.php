@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== KONSULTASI PAGE STYLES ===== */

        /* --- Hero Header --- */
        .kons-hero {
            background: linear-gradient(135deg, var(--primary) 0%, #1a6fb5 50%, var(--accent) 100%);
            border-radius: var(--radius-lg);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .kons-hero::before {
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

        .kons-hero::after {
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

        .kons-hero-inner {
            position: relative;
            z-index: 1;
        }

        .kons-hero .breadcrumb-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s;
        }

        .kons-hero .breadcrumb-link:hover { color: #fff; }

        .kons-hero .breadcrumb-sep {
            color: rgba(255,255,255,0.4);
            margin: 0 6px;
            font-size: 0.8rem;
        }

        .kons-hero .breadcrumb-active {
            color: rgba(255,255,255,0.95);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .kons-hero h1 {
            font-size: 1.65rem;
            font-weight: 800;
            margin: 0.75rem 0 0.35rem 0;
            letter-spacing: -0.02em;
        }

        .kons-hero p {
            opacity: 0.85;
            font-size: 0.95rem;
            margin: 0;
        }

        /* --- Stats Row --- */
        .kons-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .kons-stat-card {
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

        .kons-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .kons-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .kons-stat-icon.total { background: rgba(15,76,129,0.1); color: var(--primary); }
        .kons-stat-icon.menunggu { background: rgba(245,158,11,0.1); color: #f59e0b; }
        .kons-stat-icon.dijadwalkan { background: rgba(59,130,246,0.1); color: #3b82f6; }
        .kons-stat-icon.selesai { background: rgba(16,185,129,0.1); color: #10b981; }

        .kons-stat-info h3 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            color: var(--text-main);
            line-height: 1.2;
        }

        .kons-stat-info span {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- Alert --- */
        .kons-alert {
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            animation: konsSlideDown 0.4s ease;
        }

        .kons-alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .kons-alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        body.dark-mode .kons-alert-success { background: rgba(16,185,129,0.15); color: #6ee7b7; border-color: rgba(16,185,129,0.3); }
        body.dark-mode .kons-alert-danger { background: rgba(239,68,68,0.15); color: #fca5a5; border-color: rgba(239,68,68,0.3); }

        .kons-alert .close-alert {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            opacity: 0.5;
            font-size: 1.1rem;
            color: inherit;
            transition: opacity 0.2s;
        }

        .kons-alert .close-alert:hover { opacity: 1; }

        @keyframes konsSlideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Filter Tabs --- */
        .kons-toolbar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .kons-filter-btn {
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

        .kons-filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .kons-filter-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 2px 8px rgba(15,76,129,0.25);
        }

        .kons-filter-btn .filter-count {
            background: rgba(0,0,0,0.08);
            padding: 2px 7px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            min-width: 22px;
            text-align: center;
        }

        .kons-filter-btn.active .filter-count {
            background: rgba(255,255,255,0.25);
            color: #fff;
        }

        /* --- Card Grid: Konsultasi Items --- */
        .kons-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .kons-item {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .kons-item:hover {
            box-shadow: var(--shadow-md);
        }

        .kons-item-main {
            display: flex;
            align-items: stretch;
        }

        /* Status Stripe */
        .kons-status-stripe {
            width: 5px;
            flex-shrink: 0;
        }

        .kons-status-stripe.menunggu { background: #f59e0b; }
        .kons-status-stripe.dijadwalkan { background: #3b82f6; }
        .kons-status-stripe.selesai { background: #10b981; }

        /* Item Content */
        .kons-item-body {
            flex: 1;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .kons-item-num {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .kons-item-info {
            flex: 1;
            min-width: 200px;
        }

        .kons-item-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .kons-item-email {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .kons-item-topic {
            flex: 1.5;
            min-width: 200px;
        }

        .kons-item-topic-label {
            font-weight: 700;
            font-size: 0.88rem;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .kons-item-topic-date {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .kons-item-pesan-preview {
            flex: 1;
            min-width: 150px;
            font-size: 0.85rem;
            color: var(--text-muted);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 200px;
        }

        /* Status Badge */
        .kons-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .kons-status-badge.menunggu {
            background: rgba(245,158,11,0.1);
            color: #b45309;
        }

        .kons-status-badge.menunggu::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f59e0b;
            animation: konsPulse 2s infinite;
        }

        .kons-status-badge.dijadwalkan {
            background: rgba(59,130,246,0.1);
            color: #1d4ed8;
        }

        .kons-status-badge.dijadwalkan::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #3b82f6;
        }

        .kons-status-badge.selesai {
            background: rgba(16,185,129,0.1);
            color: #059669;
        }

        .kons-status-badge.selesai::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
        }

        @keyframes konsPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* Tanggapi Button */
        .btn-tanggapi {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--primary);
            background: transparent;
            color: var(--primary);
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            flex-shrink: 0;
            white-space: nowrap;
        }

        .btn-tanggapi:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15,76,129,0.2);
        }

        .btn-tanggapi.selesai-btn {
            border-color: var(--gray-300);
            color: var(--text-muted);
        }

        .btn-tanggapi.selesai-btn:hover {
            background: var(--gray-100);
            color: var(--text-main);
            border-color: var(--gray-400);
            box-shadow: none;
        }

        /* --- Slide Panel Modal --- */
        .kons-panel-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(3px);
            z-index: 9998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .kons-panel-overlay.show {
            display: block;
            opacity: 1;
        }

        .kons-panel {
            position: fixed;
            top: 0;
            right: -520px;
            width: 500px;
            max-width: 95vw;
            height: 100vh;
            background: var(--white);
            z-index: 9999;
            box-shadow: -8px 0 30px rgba(0,0,0,0.15);
            transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .kons-panel.show {
            right: 0;
        }

        /* Panel Header */
        .kons-panel-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            padding: 1.5rem 1.75rem;
            flex-shrink: 0;
        }

        .kons-panel-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .kons-panel-header h5 {
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kons-panel-close {
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

        .kons-panel-close:hover { background: rgba(255,255,255,0.3); }

        .kons-panel-peserta {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kons-panel-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .kons-panel-peserta-name {
            font-weight: 600;
            font-size: 0.92rem;
        }

        .kons-panel-peserta-email {
            font-size: 0.78rem;
            opacity: 0.75;
        }

        /* Panel Body */
        .kons-panel-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.75rem;
        }

        .kons-detail-section {
            margin-bottom: 1.75rem;
        }

        .kons-detail-label {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .kons-detail-value {
            font-size: 0.92rem;
            color: var(--text-main);
            line-height: 1.6;
        }

        .kons-detail-topic {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--text-main);
        }

        .kons-detail-date {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .kons-detail-message {
            background: var(--gray-50);
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            border-left: 3px solid var(--primary);
            font-size: 0.9rem;
            color: var(--text-main);
            line-height: 1.65;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /* Previous Reply */
        .kons-prev-reply {
            background: rgba(16,185,129,0.06);
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            border-left: 3px solid #10b981;
            font-size: 0.88rem;
            color: var(--text-main);
            line-height: 1.6;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .kons-prev-reply-empty {
            color: var(--text-muted);
            font-style: italic;
            font-size: 0.85rem;
        }

        /* Divider */
        .kons-divider {
            border: none;
            height: 1px;
            background: var(--gray-200);
            margin: 1.5rem 0;
        }

        /* Form Section */
        .kons-form-section h6 {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kons-form-section h6 i {
            color: var(--primary);
        }

        .kons-form-group {
            margin-bottom: 1.25rem;
        }

        .kons-form-group label {
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--text-main);
            margin-bottom: 0.4rem;
            display: block;
        }

        .kons-form-control {
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

        .kons-form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15,76,129,0.08);
        }

        .kons-form-control::placeholder { color: var(--gray-400); }
        textarea.kons-form-control { resize: vertical; min-height: 100px; }

        /* Status Options */
        .kons-status-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .kons-status-option {
            padding: 0.65rem 0.75rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: center;
            position: relative;
        }

        .kons-status-option:hover { border-color: var(--gray-300); }

        .kons-status-option.selected { border-width: 2px; }
        .kons-status-option.selected.opt-menunggu { border-color: #f59e0b; background: rgba(245,158,11,0.06); }
        .kons-status-option.selected.opt-dijadwalkan { border-color: #3b82f6; background: rgba(59,130,246,0.06); }
        .kons-status-option.selected.opt-selesai { border-color: #10b981; background: rgba(16,185,129,0.06); }

        .kons-status-option input { position: absolute; opacity: 0; width: 0; height: 0; }

        .kons-status-option .status-opt-icon {
            font-size: 1.2rem;
            display: block;
            margin-bottom: 3px;
        }

        .kons-status-option .status-opt-icon.icon-menunggu { color: #f59e0b; }
        .kons-status-option .status-opt-icon.icon-dijadwalkan { color: #3b82f6; }
        .kons-status-option .status-opt-icon.icon-selesai { color: #10b981; }

        .kons-status-option .status-opt-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .kons-status-option .check-mark {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 0.55rem;
            color: #fff;
        }

        .kons-status-option.selected .check-mark {
            display: flex;
        }

        .kons-status-option.selected.opt-menunggu .check-mark { background: #f59e0b; }
        .kons-status-option.selected.opt-dijadwalkan .check-mark { background: #3b82f6; }
        .kons-status-option.selected.opt-selesai .check-mark { background: #10b981; }

        /* Panel Footer */
        .kons-panel-footer {
            padding: 1.25rem 1.75rem;
            border-top: 1px solid var(--gray-100);
            background: var(--gray-50);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .btn-kons-cancel {
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

        .btn-kons-cancel:hover { background: var(--gray-100); }

        .btn-kons-submit {
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

        .btn-kons-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15,76,129,0.25);
        }

        /* --- Empty State --- */
        .kons-empty {
            text-align: center;
            padding: 4rem 2rem;
        }

        .kons-empty-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        .kons-empty-icon i { font-size: 1.75rem; color: var(--primary); }

        .kons-empty h6 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.4rem;
        }

        .kons-empty p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0;
        }

        /* --- Stagger --- */
        .kons-stagger > * {
            animation: konsFadeInUp 0.4s ease forwards;
            opacity: 0;
        }

        .kons-stagger > *:nth-child(1) { animation-delay: 0.05s; }
        .kons-stagger > *:nth-child(2) { animation-delay: 0.1s; }
        .kons-stagger > *:nth-child(3) { animation-delay: 0.15s; }
        .kons-stagger > *:nth-child(4) { animation-delay: 0.2s; }
        .kons-stagger > *:nth-child(5) { animation-delay: 0.25s; }

        @keyframes konsFadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Jenkel Badge */
        .kons-jenkel {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            margin-left: 6px;
        }

        .kons-jenkel.pria { background: rgba(59,130,246,0.1); color: #2563eb; }
        .kons-jenkel.wanita { background: rgba(236,72,153,0.1); color: #db2777; }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            .kons-hero { padding: 1.5rem; }
            .kons-hero h1 { font-size: 1.3rem; }
            .kons-stats { grid-template-columns: repeat(2, 1fr); }
            .kons-item-body { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
            .kons-item-pesan-preview { max-width: 100%; }
            .kons-panel { width: 100%; max-width: 100vw; }
            .kons-status-options { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .kons-stats { grid-template-columns: 1fr; }
        }
    </style>

    <div class="container-fluid kons-stagger">
        {{-- Hero --}}
        <div class="kons-hero">
            <div class="kons-hero-inner">
                <div style="margin-bottom: 0.75rem;">
                    <a href="/dashboardadmin" class="breadcrumb-link"><i class="fas fa-home"></i> Dashboard</a>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-active">Konsultasi Pra-Ta'aruf</span>
                </div>
                <h1><i class="fas fa-comments" style="margin-right: 8px;"></i> Konsultasi Pra-Ta'aruf</h1>
                <p>Kelola permintaan jadwal konsultasi dari peserta ta'aruf</p>
            </div>
        </div>

        {{-- Stats --}}
        @php
            $cTotal = $listKonsultasi->count();
            $cMenunggu = $listKonsultasi->where('status', 'menunggu')->count();
            $cDijadwalkan = $listKonsultasi->where('status', 'dijadwalkan')->count();
            $cSelesai = $listKonsultasi->where('status', 'selesai')->count();
        @endphp
        <div class="kons-stats">
            <div class="kons-stat-card">
                <div class="kons-stat-icon total"><i class="fas fa-comments"></i></div>
                <div class="kons-stat-info">
                    <h3>{{ $cTotal }}</h3>
                    <span>Total</span>
                </div>
            </div>
            <div class="kons-stat-card">
                <div class="kons-stat-icon menunggu"><i class="fas fa-clock"></i></div>
                <div class="kons-stat-info">
                    <h3>{{ $cMenunggu }}</h3>
                    <span>Menunggu</span>
                </div>
            </div>
            <div class="kons-stat-card">
                <div class="kons-stat-icon dijadwalkan"><i class="fas fa-calendar-check"></i></div>
                <div class="kons-stat-info">
                    <h3>{{ $cDijadwalkan }}</h3>
                    <span>Dijadwalkan</span>
                </div>
            </div>
            <div class="kons-stat-card">
                <div class="kons-stat-icon selesai"><i class="fas fa-check-circle"></i></div>
                <div class="kons-stat-info">
                    <h3>{{ $cSelesai }}</h3>
                    <span>Selesai</span>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if (Session::get('success'))
            <div class="kons-alert kons-alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ Session::get('success') }}</span>
                <button class="close-alert" onclick="this.parentElement.remove();">&times;</button>
            </div>
        @endif
        @if (Session::get('error'))
            <div class="kons-alert kons-alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ Session::get('error') }}</span>
                <button class="close-alert" onclick="this.parentElement.remove();">&times;</button>
            </div>
        @endif

        {{-- Filter Toolbar --}}
        <div class="kons-toolbar">
            <button class="kons-filter-btn active" onclick="filterKonsultasi('all', this)">
                <i class="fas fa-th-list"></i> Semua
                <span class="filter-count">{{ $cTotal }}</span>
            </button>
            <button class="kons-filter-btn" onclick="filterKonsultasi('menunggu', this)">
                <i class="fas fa-clock"></i> Menunggu
                <span class="filter-count">{{ $cMenunggu }}</span>
            </button>
            <button class="kons-filter-btn" onclick="filterKonsultasi('dijadwalkan', this)">
                <i class="fas fa-calendar-check"></i> Dijadwalkan
                <span class="filter-count">{{ $cDijadwalkan }}</span>
            </button>
            <button class="kons-filter-btn" onclick="filterKonsultasi('selesai', this)">
                <i class="fas fa-check-circle"></i> Selesai
                <span class="filter-count">{{ $cSelesai }}</span>
            </button>
        </div>

        {{-- Konsultasi List --}}
        @if($listKonsultasi->count() > 0)
            <div class="kons-list" id="konsultasiList">
                @foreach($listKonsultasi as $index => $konsultasi)
                <div class="kons-item" data-status="{{ $konsultasi->status }}">
                    <div class="kons-item-main">
                        <div class="kons-status-stripe {{ $konsultasi->status }}"></div>
                        <div class="kons-item-body">
                            <div class="kons-item-num">{{ $index + 1 }}</div>

                            <div class="kons-item-info">
                                <div class="kons-item-name">
                                    {{ $konsultasi->nama }}
                                    <span class="kons-jenkel {{ $konsultasi->jenkel }}">
                                        <i class="fas {{ $konsultasi->jenkel == 'pria' ? 'fa-mars' : 'fa-venus' }}"></i>
                                        {{ ucfirst($konsultasi->jenkel) }}
                                    </span>
                                </div>
                                <div class="kons-item-email">{{ $konsultasi->karyawan_email }}</div>
                            </div>

                            <div class="kons-item-topic">
                                <div class="kons-item-topic-label">{{ $konsultasi->topik_konsultasi }}</div>
                                <div class="kons-item-topic-date">
                                    <i class="fas fa-calendar-alt" style="margin-right:3px; font-size:0.7rem;"></i>
                                    {{ \Carbon\Carbon::parse($konsultasi->created_at)->format('d M Y, H:i') }}
                                </div>
                            </div>

                            <div class="kons-item-pesan-preview" title="{{ $konsultasi->pesan }}">
                                {{ Str::limit($konsultasi->pesan, 50) }}
                            </div>

                            <span class="kons-status-badge {{ $konsultasi->status }}">
                                {{ ucfirst($konsultasi->status) }}
                            </span>

                            <button class="btn-tanggapi {{ $konsultasi->status == 'selesai' ? 'selesai-btn' : '' }}" onclick="openTanggapiPanel({{ $konsultasi->id }})">
                                <i class="fas {{ $konsultasi->status == 'selesai' ? 'fa-eye' : 'fa-reply' }}"></i>
                                {{ $konsultasi->status == 'selesai' ? 'Lihat' : 'Tanggapi' }}
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="edu-card-wrapper">
                <div class="kons-empty">
                    <div class="kons-empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h6>Belum Ada Permintaan Konsultasi</h6>
                    <p>Permintaan konsultasi dari peserta ta'aruf akan muncul di sini.</p>
                </div>
            </div>
        @endif
    </div>

    {{-- ========================================== --}}
    {{-- SLIDE PANEL OVERLAY --}}
    {{-- ========================================== --}}
    <div class="kons-panel-overlay" id="konsPanelOverlay"></div>

    {{-- SLIDE PANELS (one per konsultasi) --}}
    @foreach($listKonsultasi as $konsultasi)
    <div class="kons-panel" id="konsPanel{{ $konsultasi->id }}">
        <div class="kons-panel-header">
            <div class="kons-panel-header-top">
                <h5><i class="fas fa-reply"></i> Tanggapi Konsultasi</h5>
                <button class="kons-panel-close" onclick="closeTanggapiPanel({{ $konsultasi->id }})">&times;</button>
            </div>
            <div class="kons-panel-peserta">
                <div class="kons-panel-avatar">
                    {{ strtoupper(substr($konsultasi->nama, 0, 1)) }}
                </div>
                <div>
                    <div class="kons-panel-peserta-name">{{ $konsultasi->nama }}</div>
                    <div class="kons-panel-peserta-email">{{ $konsultasi->karyawan_email }}</div>
                </div>
            </div>
        </div>

        <div class="kons-panel-body">
            {{-- Topic --}}
            <div class="kons-detail-section">
                <div class="kons-detail-label"><i class="fas fa-tag"></i> Topik Konsultasi</div>
                <div class="kons-detail-topic">{{ $konsultasi->topik_konsultasi }}</div>
                <div class="kons-detail-date">
                    <i class="fas fa-calendar-alt"></i> Diajukan: {{ \Carbon\Carbon::parse($konsultasi->created_at)->format('d M Y, H:i') }}
                </div>
            </div>

            {{-- Pesan Peserta --}}
            <div class="kons-detail-section">
                <div class="kons-detail-label"><i class="fas fa-envelope"></i> Pesan dari Peserta</div>
                <div class="kons-detail-message">{{ $konsultasi->pesan }}</div>
            </div>

            {{-- Previous Reply --}}
            @if($konsultasi->pesan_balasan_murobbi)
            <div class="kons-detail-section">
                <div class="kons-detail-label"><i class="fas fa-comment-dots"></i> Balasan Sebelumnya</div>
                <div class="kons-prev-reply">{{ $konsultasi->pesan_balasan_murobbi }}</div>
            </div>
            @endif

            <hr class="kons-divider">

            {{-- Response Form --}}
            <div class="kons-form-section">
                <h6><i class="fas fa-pen-fancy"></i> Formulir Tanggapan</h6>

                <form action="{{ route('murobi.konsultasi.update', $konsultasi->id) }}" method="POST" id="formKons{{ $konsultasi->id }}">
                    @csrf

                    {{-- Status Selection --}}
                    <div class="kons-form-group">
                        <label>Ubah Status</label>
                        <div class="kons-status-options">
                            <label class="kons-status-option opt-menunggu {{ $konsultasi->status == 'menunggu' ? 'selected' : '' }}" onclick="selectKonsStatus(this, {{ $konsultasi->id }})">
                                <input type="radio" name="status" value="menunggu" {{ $konsultasi->status == 'menunggu' ? 'checked' : '' }}>
                                <span class="check-mark"><i class="fas fa-check"></i></span>
                                <span class="status-opt-icon icon-menunggu"><i class="fas fa-clock"></i></span>
                                <span class="status-opt-label">Menunggu</span>
                            </label>
                            <label class="kons-status-option opt-dijadwalkan {{ $konsultasi->status == 'dijadwalkan' ? 'selected' : '' }}" onclick="selectKonsStatus(this, {{ $konsultasi->id }})">
                                <input type="radio" name="status" value="dijadwalkan" {{ $konsultasi->status == 'dijadwalkan' ? 'checked' : '' }}>
                                <span class="check-mark"><i class="fas fa-check"></i></span>
                                <span class="status-opt-icon icon-dijadwalkan"><i class="fas fa-calendar-check"></i></span>
                                <span class="status-opt-label">Dijadwalkan</span>
                            </label>
                            <label class="kons-status-option opt-selesai {{ $konsultasi->status == 'selesai' ? 'selected' : '' }}" onclick="selectKonsStatus(this, {{ $konsultasi->id }})">
                                <input type="radio" name="status" value="selesai" {{ $konsultasi->status == 'selesai' ? 'checked' : '' }}>
                                <span class="check-mark"><i class="fas fa-check"></i></span>
                                <span class="status-opt-icon icon-selesai"><i class="fas fa-check-circle"></i></span>
                                <span class="status-opt-label">Selesai</span>
                            </label>
                        </div>
                    </div>

                    {{-- Reply --}}
                    <div class="kons-form-group">
                        <label>Pesan Balasan Murobi</label>
                        <textarea name="pesan_balasan_murobbi" class="kons-form-control" rows="4" placeholder="Sebutkan jadwal konsultasi, lokasi, atau link pertemuan virtual (Zoom/GMeet)...">{{ $konsultasi->pesan_balasan_murobbi }}</textarea>
                    </div>
                </form>
            </div>
        </div>

        <div class="kons-panel-footer">
            <button type="button" class="btn-kons-cancel" onclick="closeTanggapiPanel({{ $konsultasi->id }})">Batal</button>
            <button type="submit" form="formKons{{ $konsultasi->id }}" class="btn-kons-submit">
                <i class="fas fa-paper-plane"></i> Kirim Tanggapan
            </button>
        </div>
    </div>
    @endforeach

    @push('myscript')
    <script>
        // ===== SLIDE PANEL SYSTEM =====
        function openTanggapiPanel(id) {
            // Show overlay
            var overlay = document.getElementById('konsPanelOverlay');
            overlay.classList.add('show');

            // Show panel
            var panel = document.getElementById('konsPanel' + id);
            if (panel) {
                // Small delay to trigger CSS transition
                setTimeout(function() {
                    panel.classList.add('show');
                }, 10);
            }

            document.body.style.overflow = 'hidden';
        }

        function closeTanggapiPanel(id) {
            var overlay = document.getElementById('konsPanelOverlay');
            var panel = document.getElementById('konsPanel' + id);

            if (panel) {
                panel.classList.remove('show');
            }

            // Delay hiding overlay to match panel animation
            setTimeout(function() {
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }, 350);
        }

        // Close on overlay click
        document.getElementById('konsPanelOverlay').addEventListener('click', function() {
            // Find currently open panel
            var openPanel = document.querySelector('.kons-panel.show');
            if (openPanel) {
                var id = openPanel.id.replace('konsPanel', '');
                closeTanggapiPanel(id);
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                var openPanel = document.querySelector('.kons-panel.show');
                if (openPanel) {
                    var id = openPanel.id.replace('konsPanel', '');
                    closeTanggapiPanel(id);
                }
            }
        });

        // ===== STATUS SELECTION =====
        function selectKonsStatus(el, id) {
            var container = el.parentElement;
            container.querySelectorAll('.kons-status-option').forEach(function(opt) {
                opt.classList.remove('selected');
            });
            el.classList.add('selected');
            // Radio is auto-selected by the label click
        }

        // ===== FILTER =====
        function filterKonsultasi(status, btn) {
            // Update active button
            document.querySelectorAll('.kons-filter-btn').forEach(function(b) {
                b.classList.remove('active');
            });
            btn.classList.add('active');

            // Filter items
            var items = document.querySelectorAll('.kons-item');
            items.forEach(function(item) {
                if (status === 'all' || item.dataset.status === status) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // ===== AUTO-DISMISS ALERTS =====
        setTimeout(function() {
            document.querySelectorAll('.kons-alert').forEach(function(alert) {
                alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() { alert.remove(); }, 400);
            });
        }, 5000);
    </script>
    @endpush
@endsection
