@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MODERN PERTANYAAN PAGE STYLES ===== */
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

        /* ===== STATS BAR ===== */
        .stats-bar {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
            border: 2px solid var(--gray-200);
            flex: 1;
            min-width: 200px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--black);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
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
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--black);
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
            vertical-align: top;
        }

        .modern-table tbody td:first-child {
            text-align: center;
            font-weight: 700;
            color: var(--black);
        }

        .modern-table tbody td:last-child {
            text-align: center;
        }

        /* ===== TABLE CONTENT ===== */
        .email-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: var(--gray-100);
            color: var(--gray-700);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid var(--gray-300);
        }

        .email-badge i {
            font-size: 0.9rem;
        }

        .question-text {
            font-size: 0.9rem;
            color: var(--gray-800);
            line-height: 1.6;
            max-width: 500px;
        }

        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: var(--gray-100);
            color: var(--gray-600);
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid var(--gray-300);
        }

        .date-badge i {
            font-size: 0.85rem;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

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

        .btn-action-modern i {
            font-size: 0.9rem;
        }

        .btn-action-modern.btn-view {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
        }

        .btn-action-modern.btn-view:hover {
            background: rgba(34, 197, 94, 0.25);
            color: #16a34a;
        }

        .btn-action-modern.btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #dc2626;
        }

        .btn-action-modern.btn-delete:hover {
            background: rgba(239, 68, 68, 0.25);
            color: #dc2626;
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

        /* ===== MODAL ===== */
        .modal-modern {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-modern.show {
            display: flex;
        }

        .modal-dialog-modern {
            background: var(--white);
            border-radius: var(--radius-xl);
            max-width: 600px;
            width: 100%;
            box-shadow: var(--shadow-xl);
            animation: modalSlideIn 0.3s ease-out;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header-modern {
            padding: 24px 28px;
            border-bottom: 2px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--gray-50);
        }

        .modal-title-modern {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--black);
            margin: 0;
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: var(--gray-200);
            color: var(--gray-700);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--black);
            color: var(--white);
            transform: rotate(90deg);
        }

        .modal-body-modern {
            padding: 28px;
            overflow-y: auto;
            flex: 1;
        }

        .question-detail {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .detail-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 1rem;
            color: var(--gray-900);
            padding: 12px 16px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-200);
        }

        /* ===== RESPONSIVE ===== */
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

            .stats-bar {
                gap: 16px;
            }

            .stat-item {
                min-width: 100%;
            }

            .question-text {
                max-width: 100%;
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
                        <i class="fas fa-question-circle"></i>
                    </div>
                    Data Pertanyaan
                </h1>
                <p class="page-subtitle-modern">Kelola pertanyaan dari pengguna aplikasi Ta'aruf</p>
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
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Pertanyaan</div>
                    <div class="stat-value">{{ $pertanyaan->total() }}</div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Halaman Ini</div>
                    <div class="stat-value">{{ $pertanyaan->count() }}</div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Hari Ini</div>
                    <div class="stat-value">{{ $pertanyaan->where('tgl_tanya', '>=', now()->startOfDay())->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card-modern">
            <div class="table-card-header-modern">
                <h6 class="table-card-title-modern">
                    <i class="fas fa-table"></i>
                    Daftar Pertanyaan Masuk
                </h6>
                <div style="color: var(--gray-600); font-size: 0.9rem;">
                    <i class="fas fa-database"></i> 
                    Menampilkan <strong>{{ $pertanyaan->count() }}</strong> dari <strong>{{ $pertanyaan->total() }}</strong> pertanyaan
                </div>
            </div>
            
            <div class="table-card-body-modern">
                @if($pertanyaan->count() > 0)
                    <div class="table-wrapper-modern">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th style="width: 220px;">Email Pengirim</th>
                                    <th>Pertanyaan</th>
                                    <th style="width: 150px;">Tanggal</th>
                                    <th style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pertanyaan as $d)
                                    <tr>
                                        <td><strong>{{ $pertanyaan->firstItem() + $loop->index }}</strong></td>
                                        <td>
                                            <div class="email-badge">
                                                <i class="fas fa-envelope"></i>
                                                {{ $d->email }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="question-text">
                                                {{ Str::limit($d->pertanyaan, 150) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date-badge">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ \Carbon\Carbon::parse($d->tgl_tanya)->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="#" class="btn-action-modern btn-view view-question" 
                                                   data-id="{{ $d->id }}"
                                                   data-email="{{ $d->email }}"
                                                   data-question="{{ $d->pertanyaan }}"
                                                   data-date="{{ \Carbon\Carbon::parse($d->tgl_tanya)->format('d F Y, H:i') }}"
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Menampilkan <strong>{{ $pertanyaan->firstItem() }}</strong> 
                            sampai <strong>{{ $pertanyaan->lastItem() }}</strong> 
                            dari <strong>{{ $pertanyaan->total() }}</strong> pertanyaan
                        </div>
                        {{ $pertanyaan->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada pertanyaan masuk</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal-modern" id="modal-detail">
        <div class="modal-dialog-modern">
            <div class="modal-header-modern">
                <h5 class="modal-title-modern">
                    <i class="fas fa-question-circle"></i> Detail Pertanyaan
                </h5>
                <button type="button" class="modal-close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body-modern">
                <div class="question-detail">
                    <div class="detail-group">
                        <div class="detail-label">
                            <i class="fas fa-envelope"></i> Email Pengirim
                        </div>
                        <div class="detail-value" id="detail-email"></div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">
                            <i class="far fa-calendar-alt"></i> Tanggal Dikirim
                        </div>
                        <div class="detail-value" id="detail-date"></div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">
                            <i class="fas fa-comment-alt"></i> Pertanyaan
                        </div>
                        <div class="detail-value" id="detail-question" style="white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            // View question detail
            $(".view-question").click(function(e) {
                e.preventDefault();
                
                const email = $(this).data('email');
                const question = $(this).data('question');
                const date = $(this).data('date');
                
                // Fill modal content
                $('#detail-email').text(email);
                $('#detail-date').text(date);
                $('#detail-question').text(question);
                
                // Show modal
                $("#modal-detail").addClass('show');
            });

            // Close modal handler
            $('[data-dismiss="modal"]').click(function() {
                $("#modal-detail").removeClass('show');
            });

            // Close modal when clicking outside
            $("#modal-detail").click(function(e) {
                if (e.target === this) {
                    $(this).removeClass('show');
                }
            });

            // Close modal with ESC key
            $(document).keyup(function(e) {
                if (e.key === "Escape") {
                    $("#modal-detail").removeClass('show');
                }
            });
        });
    </script>
@endpush