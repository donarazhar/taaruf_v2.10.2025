@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MODERN BERITA STYLES ===== */
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

        /* ===== NEWS IMAGE ===== */
        .news-image {
            width: 80px;
            height: 60px;
            border-radius: var(--radius-md);
            object-fit: cover;
            border: 2px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .news-image:hover {
            transform: scale(1.5);
            z-index: 100;
            box-shadow: var(--shadow-lg);
        }

        /* ===== TEXT STYLES ===== */
        .news-title {
            font-weight: 600;
            color: var(--gray-900);
            text-align: left;
            line-height: 1.4;
        }

        .news-subtitle {
            color: var(--gray-600);
            text-align: left;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .news-content {
            color: var(--gray-600);
            text-align: left;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .news-link {
            color: var(--black);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.3s ease;
        }

        .news-link:hover {
            color: var(--gray-700);
            gap: 8px;
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

            .news-image {
                width: 60px;
                height: 45px;
            }

            .modal-dialog-modern {
                max-width: 100%;
            }

            .modal-header-modern,
            .modal-body-modern {
                padding: 20px;
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Data Berita & Artikel</h1>
                <p class="page-subtitle">Kelola konten berita dan artikel aplikasi Ta'aruf</p>
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
                <h6 class="table-card-title">Daftar Berita & Artikel</h6>
                <div style="color: var(--gray-600); font-size: 0.9rem;">
                    <i class="fas fa-newspaper"></i> Total: <strong>{{ $databerita->count() }}</strong> artikel
                </div>
            </div>
            
            <div class="table-card-body">
                @if($databerita->count() > 0)
                    <div class="table-wrapper">
                        <table class="modern-table" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 100px;">Foto</th>
                                    <th style="width: 200px;">Judul</th>
                                    <th style="width: 180px;">Sub Judul</th>
                                    <th style="width: 220px;">Isi</th>
                                    <th style="width: 150px;">Link</th>
                                    <th style="width: 70px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($databerita as $d)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>
                                            @if ($d->foto == null || $d->foto == '')
                                                <img class="news-image" src="{{ asset('assets/img/preview.png') }}" alt="No Image">
                                            @else
                                                @php
                                                    $path = Storage::url('uploads/berita/' . $d->foto);
                                                @endphp
                                                <img class="news-image" src="{{ $path }}" alt="{{ $d->judul }}">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="news-title">{{ $d->judul }}</div>
                                        </td>
                                        <td>
                                            <div class="news-subtitle">{{ $d->subjudul }}</div>
                                        </td>
                                        <td>
                                            <div class="news-content">
                                                {{ Illuminate\Support\Str::limit($d->isi, $limit = 50, $end = '...') }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($d->link)
                                                <a href="{{ $d->link }}" target="_blank" class="news-link">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    Buka Link
                                                </a>
                                            @else
                                                <span style="color: var(--gray-400); font-size: 0.85rem;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn-action edit" id="{{ $d->id }}" title="Edit Berita">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <p>Belum ada data berita</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal-modern" id="modal-editBerita">
        <div class="modal-dialog-modern">
            <div class="modal-header-modern">
                <h5 class="modal-title-modern">Edit Berita & Artikel</h5>
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
            // Edit button click handler
            $(".edit").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                
                // Show modal
                $("#modal-editBerita").addClass('show');
                
                // Show loading spinner
                $('#loadeditform').html(`
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                    </div>
                `);
                
                // AJAX request
                $.ajax({
                    type: 'POST',
                    url: '/masterberita/editberita',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);

                        // Initialize TinyMCE after modal content is loaded
                        tinymce.init({
                            selector: '#isiberitaedit',
                            height: 300,
                            plugins: [
                                'advlist autolink lists link image charmap print preview anchor',
                                'searchreplace visualblocks code fullscreen',
                                'insertdatetime media table paste code help wordcount'
                            ],
                            toolbar: 'undo redo | formatselect | ' +
                                'bold italic backcolor | alignleft aligncenter ' +
                                'alignright alignjustify | bullist numlist outdent indent | ' +
                                'removeformat | help',
                            content_style: 'body { font-family: "Inter", "Helvetica", sans-serif; font-size: 14px }',
                            menubar: false,
                            statusbar: false
                        });
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
                // Remove TinyMCE instance before closing
                tinymce.remove('#isiberitaedit');
                $("#modal-editBerita").removeClass('show');
            });

            // Close modal when clicking outside
            $("#modal-editBerita").click(function(e) {
                if (e.target === this) {
                    tinymce.remove('#isiberitaedit');
                    $(this).removeClass('show');
                }
            });

            // Close modal with ESC key
            $(document).keyup(function(e) {
                if (e.key === "Escape") {
                    tinymce.remove('#isiberitaedit');
                    $("#modal-editBerita").removeClass('show');
                }
            });
        });
    </script>
@endpush