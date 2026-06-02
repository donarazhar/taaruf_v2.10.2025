@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MODERN PROGRESS TAARUF STYLES ===== */
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
            --gray-50: #FAFAFA;
            --white: #FFFFFF;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
            --shadow-xl: 0 12px 32px rgba(0, 0, 0, 0.2);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        /* ===== PAGE HEADER ===== */
        .page-header-modern {
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title-modern {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--black);
            margin: 0;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title-icon {
            width: 48px;
            height: 48px;
            background: var(--black);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-subtitle-modern {
            font-size: 0.95rem;
            color: var(--gray-600);
            margin-top: 4px;
        }

        /* ===== ALERT MESSAGES ===== */
        .alert-modern {
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

        .alert-success-modern {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border-left: 4px solid #22c55e;
        }

        .alert-warning-modern {
            background: rgba(251, 191, 36, 0.1);
            color: #d97706;
            border-left: 4px solid #fbbf24;
        }

        /* ===== STATS BAR ===== */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-icon.success {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
        }

        .stat-icon.pending {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
        }

        .stat-icon.total {
            background: rgba(0, 0, 0, 0.1);
            color: var(--black);
        }

        .stat-content {
            flex: 1;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--gray-600);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--black);
            line-height: 1;
        }

        /* ===== TABLE CARD ===== */
        .table-card-modern {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 32px;
            transition: all 0.3s ease;
        }

        .table-card-modern:hover {
            box-shadow: var(--shadow-md);
        }

        .table-card-header-modern {
            padding: 24px 28px;
            border-bottom: 2px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .table-card-title-modern {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--black);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-card-body-modern {
            padding: 28px;
        }

        /* ===== MODERN TABLE ===== */
        .table-wrapper-modern {
            overflow-x: auto;
            border-radius: var(--radius-md);
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.9rem;
        }

        .modern-table thead {
            background: var(--black);
            color: var(--white);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modern-table thead th {
            padding: 16px 12px;
            font-size: 0.8rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            white-space: nowrap;
        }

        .modern-table thead th:first-child {
            border-radius: var(--radius-md) 0 0 0;
        }

        .modern-table thead th:last-child {
            border-radius: 0 var(--radius-md) 0 0;
        }

        .modern-table tbody tr {
            border-bottom: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:hover {
            background: var(--gray-50);
        }

        .modern-table tbody tr:last-child {
            border-bottom: none;
        }

        .modern-table tbody td {
            padding: 16px 12px;
            text-align: center;
            color: var(--gray-700);
            vertical-align: middle;
        }

        .modern-table tbody td:first-child {
            font-weight: 700;
            color: var(--black);
        }

        /* ===== COUPLE CARD ===== */
        .couple-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
            border: 2px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .couple-card:hover {
            border-color: var(--black);
            box-shadow: var(--shadow-sm);
        }

        .couple-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--white);
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
        }

        .couple-info {
            flex: 1;
            text-align: left;
        }

        .couple-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 6px;
        }

        .couple-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .couple-status.cocok {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
        }

        .couple-status.tidak-cocok {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
        }

        .couple-status.belum {
            background: rgba(0, 0, 0, 0.1);
            color: var(--gray-700);
        }

        .couple-status i {
            font-size: 0.85rem;
        }

        /* ===== PASANGAN CONTAINER ===== */
        .pasangan-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            align-items: start;
        }

        /* ===== DATE BADGE ===== */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: var(--gray-100);
            color: var(--gray-700);
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid var(--gray-300);
        }

        .date-badge i {
            font-size: 0.9rem;
        }

        /* ===== ACTION BUTTONS ===== */
        .btn-action-modern {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--success);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .btn-action-modern:hover {
            background: #16a34a;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: var(--white);
        }

        .btn-action-modern i {
            font-size: 1rem;
        }

        .btn-action-modern.disabled {
            background: var(--gray-300);
            color: var(--gray-500);
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ===== MATCH INDICATOR ===== */
        .match-indicator {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            font-size: 1.2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 32px;
            padding: 20px 0;
            gap: 16px;
        }

        .pagination-info {
            text-align: center;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .pagination-info strong {
            color: var(--black);
            font-weight: 700;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            background: var(--white);
            color: var(--gray-700);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: var(--gray-100);
            border-color: var(--black);
            color: var(--black);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .page-item.active .page-link {
            background: var(--black);
            color: var(--white);
            border-color: var(--black);
            box-shadow: var(--shadow-md);
        }

        .page-item.disabled .page-link {
            background: var(--gray-100);
            color: var(--gray-400);
            border-color: var(--gray-200);
            cursor: not-allowed;
            opacity: 0.6;
        }

        .page-item.disabled .page-link:hover {
            transform: none;
            box-shadow: none;
            background: var(--gray-100);
            border-color: var(--gray-200);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 968px) {
            .pasangan-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-title-modern {
                font-size: 1.5rem;
            }

            .table-card-header-modern {
                padding: 20px;
            }

            .table-card-body-modern {
                padding: 20px;
            }

            .modern-table {
                font-size: 0.8rem;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 12px 8px;
            }

            .couple-avatar {
                width: 40px;
                height: 40px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stats-bar {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .page-link {
                min-width: 36px;
                height: 36px;
                padding: 6px 10px;
                font-size: 0.85rem;
            }

            .pagination {
                gap: 6px;
            }

            .page-item:not(.active):not(:first-child):not(:last-child):not(:nth-child(2)):not(:nth-last-child(2)) {
                display: none;
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header-modern">
            <div>
                <h1 class="page-title-modern">
                    <div class="page-title-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    Data Progress Ta'aruf
                </h1>
                <p class="page-subtitle-modern">Monitoring proses ta'aruf dan status kecocokan pasangan</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (Session::get('success'))
            <div class="alert-modern alert-success-modern">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="currentColor"/>
                </svg>
                <span>{{ Session::get('success') }}</span>
            </div>
        @endif
        
        @if (Session::get('warning'))
            <div class="alert-modern alert-warning-modern">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 21H23L12 2L1 21ZM13 18H11V16H13V18ZM13 14H11V10H13V14Z" fill="currentColor"/>
                </svg>
                <span>{{ Session::get('warning') }}</span>
            </div>
        @endif

        <!-- Stats Bar -->
        <div class="stats-bar">
            @php
                $totalProgress = $allDataProgress->count();
                $cocokBoth = $allDataProgress->where('authStatus', 1)->where('profileStatus', 1)->count();
                $pending = $allDataProgress->filter(function($item) {
                    return $item->authStatus === null || $item->profileStatus === null || 
                           $item->authStatus === 2 || $item->profileStatus === 2;
                })->count();
            @endphp

            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Progress</div>
                    <div class="stat-value">{{ $totalProgress }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Saling Cocok</div>
                    <div class="stat-value">{{ $cocokBoth }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Menunggu</div>
                    <div class="stat-value">{{ $pending }}</div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card-modern">
            <div class="table-card-header-modern">
                <h6 class="table-card-title-modern">
                    <i class="fas fa-table"></i>
                    Daftar Progress Ta'aruf
                </h6>
                <div style="color: var(--gray-600); font-size: 0.9rem;">
                    <i class="fas fa-database"></i> 
                    Total: <strong>{{ $allDataProgress->count() }}</strong> progress
                </div>
            </div>
            
            <div class="table-card-body-modern">
                @if($allDataProgress->count() > 0)
                    <div class="table-wrapper-modern">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Pasangan Ta'aruf</th>
                                    <th style="width: 150px;">Tanggal</th>
                                    <th style="width: 120px;">Status</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allDataProgress as $data)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>
                                            <div class="pasangan-container">
                                                <!-- Person 1 -->
                                                <div class="couple-card">
                                                    @php
                                                        $path1 = $data->foto_auth ? Storage::url('uploads/karyawan/img/' . $data->foto_auth) : asset('assets/img/nophoto.png');
                                                    @endphp
                                                    <img src="{{ $path1 }}" alt="{{ $data->nama_auth }}" class="couple-avatar">
                                                    <div class="couple-info">
                                                        <div class="couple-name">{{ $data->nama_auth }}</div>
                                                        <span class="couple-status 
                                                            @if($data->authStatus == 1) cocok
                                                            @elseif($data->authStatus === 0) tidak-cocok
                                                            @else belum
                                                            @endif">
                                                            @if($data->authStatus == 1)
                                                                <i class="fas fa-check-circle"></i> Cocok
                                                            @elseif($data->authStatus === 0)
                                                                <i class="fas fa-times-circle"></i> Tidak Cocok
                                                            @else
                                                                <i class="fas fa-clock"></i> Belum
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Person 2 -->
                                                <div class="couple-card">
                                                    @php
                                                        $path2 = $data->foto_profile ? Storage::url('uploads/karyawan/img/' . $data->foto_profile) : asset('assets/img/nophoto.png');
                                                    @endphp
                                                    <img src="{{ $path2 }}" alt="{{ $data->nama_profile }}" class="couple-avatar">
                                                    <div class="couple-info">
                                                        <div class="couple-name">{{ $data->nama_profile }}</div>
                                                        <span class="couple-status 
                                                            @if($data->profileStatus == 1) cocok
                                                            @elseif($data->profileStatus === 0) tidak-cocok
                                                            @else belum
                                                            @endif">
                                                            @if($data->profileStatus == 1)
                                                                <i class="fas fa-check-circle"></i> Cocok
                                                            @elseif($data->profileStatus === 0)
                                                                <i class="fas fa-times-circle"></i> Tidak Cocok
                                                            @else
                                                                <i class="fas fa-clock"></i> Belum
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date-badge">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ date('d M Y', strtotime($data->progress_tgl)) }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($data->profileStatus == 1 && $data->authStatus == 1)
                                                <div class="match-indicator" title="Pasangan Cocok!">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            @else
                                                <span style="color: var(--gray-500); font-size: 0.85rem;">
                                                    <i class="fas fa-hourglass-half"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->profileStatus == 1 && $data->authStatus == 1)
                                                <a href="{{ route('prosescetak', ['id' => $data->id]) }}" 
                                                   target="_blank" 
                                                   class="btn-action-modern">
                                                    <i class="fas fa-print"></i>
                                                    Cetak
                                                </a>
                                            @else
                                                <button class="btn-action-modern disabled" disabled>
                                                    <i class="fas fa-lock"></i>
                                                    Proses
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (if needed) -->
                    @if(method_exists($allDataProgress, 'links'))
                        <div class="pagination-wrapper">
                            <div class="pagination-info">
                                Menampilkan <strong>{{ $allDataProgress->firstItem() }}</strong> 
                                sampai <strong>{{ $allDataProgress->lastItem() }}</strong> 
                                dari <strong>{{ $allDataProgress->total() }}</strong> progress
                            </div>
                            {{ $allDataProgress->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-heart-broken"></i>
                        <p>Belum ada data progress ta'aruf</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection