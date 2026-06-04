@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MODERN LOG CHAT PAGE STYLES ===== */
        :root {
            --primary: #0053C5;
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
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
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
            background: #0053C5;
            color: #FFFFFF;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modern-table thead th {
            padding: 16px 12px;
            font-size: 0.8rem;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            white-space: nowrap;
        }

        .modern-table thead th:first-child {
            border-radius: var(--radius-md) 0 0 0;
            text-align: center;
        }

        .modern-table thead th:last-child {
            border-radius: 0 var(--radius-md) 0 0;
            text-align: center;
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
            color: var(--gray-700);
            vertical-align: middle;
        }

        .modern-table tbody td:first-child {
            text-align: center;
            font-weight: 700;
            color: var(--black);
        }

        .modern-table tbody td:last-child {
            text-align: center;
        }

        .table-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--white);
            box-shadow: var(--shadow-sm);
            margin-right: 12px;
        }

        /* ===== ACTION BUTTONS ===== */
        .btn-action-modern {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: var(--black);
            color: var(--white);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-action-modern:hover {
            background: var(--gray-900);
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
            color: var(--white);
        }

        .btn-view {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
        }

        .btn-view:hover {
            background: rgba(34, 197, 94, 0.25);
            color: #16a34a;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #dc2626;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.25);
            color: #dc2626;
        }

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
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header-modern">
            <div>
                <h1 class="page-title-modern">
                    <div class="page-title-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    Log Chat Ta'aruf
                </h1>
                <p class="page-subtitle-modern">Riwayat percakapan antar pengguna dalam proses Ta'aruf</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (Session::get('success'))
            <div class="alert-modern alert-success-modern">
                <i class="fas fa-check-circle"></i>
                <span>{{ Session::get('success') }}</span>
            </div>
        @endif
        
        @if (Session::get('error'))
            <div class="alert-modern alert-warning-modern">
                <i class="fas fa-exclamation-triangle"></i>
                <span>{{ Session::get('error') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="table-card-modern">
            <div class="table-card-header-modern">
                <h6 class="table-card-title-modern">
                    <i class="fas fa-table"></i>
                    Daftar History Chat
                </h6>
            </div>
            
            <div class="table-card-body-modern">
                @if($resultChat && count($resultChat) > 0)
                    <div class="table-wrapper-modern">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No.</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resultChat as $data)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                @php
                                                    $pathAuth = !empty($data['data'][0]['foto_auth']) ? Storage::url('uploads/karyawan/img/' . $data['data'][0]['foto_auth']) : 'https://ui-avatars.com/api/?name=' . urlencode($data['data'][0]['nama_auth']) . '&background=random&color=fff&size=200';
                                                @endphp
                                                <img src="{{ $pathAuth }}" alt="Pengirim" class="table-avatar">
                                                <strong>{{ $data['data'][0]['nama_auth'] }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                @php
                                                    $pathProfile = !empty($data['data'][0]['foto_profile']) ? Storage::url('uploads/karyawan/img/' . $data['data'][0]['foto_profile']) : 'https://ui-avatars.com/api/?name=' . urlencode($data['data'][0]['nama_profile']) . '&background=random&color=fff&size=200';
                                                @endphp
                                                <img src="{{ $pathProfile }}" alt="Penerima" class="table-avatar">
                                                <strong>{{ $data['data'][0]['nama_profile'] }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 8px; justify-content: center;">
                                                <a href="{{ route('historychat', ['id' => $data['id_progress']]) }}" class="btn-action-modern btn-view" title="Lihat Chat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('deletehistorychat', ['id' => $data['id_progress']]) }}" class="btn-action-modern btn-delete" title="Hapus Chat" onclick="return confirm('Apakah Anda yakin ingin menghapus history chat ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-comments"></i>
                        <p>Belum ada riwayat percakapan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
