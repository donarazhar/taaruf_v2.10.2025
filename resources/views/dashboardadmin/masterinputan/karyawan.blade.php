@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MODERN TABLE STYLES ===== */
        .page-header {
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--black);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .page-subtitle {
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
        .table-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 32px;
            transition: all 0.3s ease;
        }

        .table-card:hover {
            box-shadow: var(--shadow-md);
        }

        .table-card-header {
            padding: 24px 28px;
            border-bottom: 2px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .table-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--black);
            margin: 0;
        }

        .table-card-body {
            padding: 28px;
        }

        /* ===== MODERN TABLE ===== */
        .table-wrapper {
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

        /* ===== TABLE ELEMENTS ===== */
        .table-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-200);
        }

        .table-nip {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: var(--black);
            font-size: 0.85rem;
        }

        .table-name {
            font-weight: 600;
            color: var(--gray-900);
        }

        .table-email {
            font-size: 0.85rem;
            color: var(--gray-600);
        }

        .gender-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .gender-male {
            background: rgba(0, 0, 0, 0.1);
            color: var(--black);
        }

        .gender-female {
            background: rgba(0, 0, 0, 0.05);
            color: var(--gray-700);
        }

        /* ===== STATUS BADGES ===== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .status-badge:hover {
            transform: scale(1.1);
        }

        .status-verified {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
        }

        .status-verified:hover {
            background: rgba(34, 197, 94, 0.25);
            border-color: #16a34a;
        }

        .status-pending {
            background: rgba(251, 191, 36, 0.15);
            color: #d97706;
        }

        .status-pending:hover {
            background: rgba(251, 191, 36, 0.25);
            border-color: #d97706;
        }

        .status-sent {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
        }

        .status-sent:hover {
            background: rgba(34, 197, 94, 0.25);
            border-color: #16a34a;
        }

        .status-not-sent {
            background: rgba(239, 68, 68, 0.15);
            color: #dc2626;
        }

        .status-not-sent:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: #dc2626;
        }

        /* ===== ACTION BUTTON ===== */
        .btn-action {
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

        .btn-action:hover {
            background: var(--gray-900);
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
            color: var(--white);
        }

        .btn-action i {
            font-size: 0.9rem;
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
            max-width: 900px;
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

        /* ===== LOADING STATE ===== */
        .loading-spinner {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--gray-200);
            border-top-color: var(--black);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

        /* Pagination arrows */
        .page-link[rel="prev"],
        .page-link[rel="next"] {
            font-weight: 700;
        }

        .page-link svg {
            width: 16px;
            height: 16px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .table-card-header {
                padding: 20px;
            }

            .table-card-body {
                padding: 20px;
            }

            .modern-table {
                font-size: 0.8rem;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 12px 8px;
            }

            .table-avatar {
                width: 32px;
                height: 32px;
            }

            .modal-dialog-modern {
                max-width: 100%;
            }

            .modal-header-modern,
            .modal-body-modern {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .pagination-wrapper {
                margin-top: 24px;
                padding: 16px 0;
            }

            .page-link {
                min-width: 36px;
                height: 36px;
                padding: 6px 10px;
                font-size: 0.85rem;
            }

            .pagination {
                gap: 6px;
            }

            /* Hide some page numbers on mobile */
            .page-item:not(.active):not(:first-child):not(:last-child):not(:nth-child(2)):not(:nth-last-child(2)) {
                display: none;
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Data Pengguna</h1>
                <p class="page-subtitle">Kelola data pengguna aplikasi Ta'aruf</p>
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

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-card-header">
                <h6 class="table-card-title">Daftar Pengguna Terdaftar</h6>
                <div style="color: var(--gray-600); font-size: 0.9rem;">
                    <i class="fas fa-users"></i> Total: <strong>{{ $karyawan->total() }}</strong> pengguna
                </div>
            </div>
            
            <div class="table-card-body">
                @if($karyawan->count() > 0)
                    <div class="table-wrapper">
                        <table class="modern-table" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 100px;">NIP</th>
                                    <th style="width: 70px;">Foto</th>
                                    <th style="width: 150px;">Nama</th>
                                    <th style="width: 180px;">Email</th>
                                    <th style="width: 70px;">Gender</th>
                                    <th style="width: 120px;">Referensi</th>
                                    <th style="width: 80px;">Status</th>
                                    <th style="width: 80px;">Email</th>
                                    <th style="width: 70px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $d)
                                    <tr>
                                        <td><strong>{{ $karyawan->firstItem() + $loop->index }}</strong></td>
                                        <td><span class="table-nip">{{ $d->nip }}</span></td>
                                        <td>
                                            @if ($d->foto == null)
                                                <img src="{{ asset('assets/img/nophoto.png') }}" alt="avatar" class="table-avatar">
                                            @else
                                                @php
                                                    $path = Storage::url('uploads/karyawan/img/' . $d->foto);
                                                @endphp
                                                <img src="{{ $path }}" alt="{{ $d->nama }}" class="table-avatar">
                                            @endif
                                        </td>
                                        <td><span class="table-name">{{ $d->nama }}</span></td>
                                        <td><span class="table-email">{{ $d->email }}</span></td>
                                        <td>
                                            <span class="gender-badge {{ $d->jenkel == 'pria' ? 'gender-male' : 'gender-female' }}">
                                                {{ $d->jenkel == 'pria' ? 'P' : 'W' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span style="font-size: 0.85rem; color: var(--gray-600);">
                                                {{ $d->referensi_detail ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="/masterkaryawan/{{ $d->id }}/verifikasi" 
                                               class="status-badge {{ $d->status == 1 ? 'status-verified' : 'status-pending' }}"
                                               title="{{ $d->status == 1 ? 'Terverifikasi' : 'Menunggu Verifikasi' }}">
                                                <i class="fas {{ $d->status == 1 ? 'fa-check' : 'fa-clock' }}"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="status-badge {{ $d->email_verification_token != null ? 'status-sent' : 'status-not-sent' }}"
                                                  title="{{ $d->email_verification_token != null ? 'Email Terkirim' : 'Email Belum Terkirim' }}">
                                                <i class="fas {{ $d->email_verification_token != null ? 'fa-check' : 'fa-times' }}"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn-action view" id="{{ $d->id }}" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Menampilkan <strong>{{ $karyawan->firstItem() }}</strong> 
                            sampai <strong>{{ $karyawan->lastItem() }}</strong> 
                            dari <strong>{{ $karyawan->total() }}</strong> pengguna
                        </div>
                        {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <p>Belum ada data pengguna</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal View -->
    <div class="modal-modern" id="modal-viewKaryawan">
        <div class="modal-dialog-modern">
            <div class="modal-header-modern">
                <h5 class="modal-title-modern">Detail Profile Pengguna</h5>
                <button type="button" class="modal-close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body-modern" id="loadeditform">
                <div class="loading-spinner">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            // View button click handler
            $(".view").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                
                // Show modal
                $("#modal-viewKaryawan").addClass('show');
                
                // Show loading spinner
                $('#loadeditform').html(`
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                    </div>
                `);
                
                // AJAX request
                $.ajax({
                    type: 'POST',
                    url: '/masterkaryawan/viewkaryawan',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);
                    },
                    error: function() {
                        $('#loadeditform').html(`
                            <div class="empty-state">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>Gagal memuat data. Silakan coba lagi.</p>
                            </div>
                        `);
                    }
                });
            });

            // Close modal handler
            $('[data-dismiss="modal"]').click(function() {
                $("#modal-viewKaryawan").removeClass('show');
            });

            // Close modal when clicking outside
            $("#modal-viewKaryawan").click(function(e) {
                if (e.target === this) {
                    $(this).removeClass('show');
                }
            });

            // Close modal with ESC key
            $(document).keyup(function(e) {
                if (e.key === "Escape") {
                    $("#modal-viewKaryawan").removeClass('show');
                }
            });
        });
    </script>
@endpush