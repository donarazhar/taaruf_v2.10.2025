@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        :root {
            --black: #0f172a;
        }
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
        
        .alert-danger-modern {
            background: rgba(239, 68, 68, 0.1);
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }

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

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table th {
            background: var(--gray-50);
            color: var(--gray-600);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px;
            text-align: left;
            border-bottom: 2px solid var(--gray-200);
        }

        .modern-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-100);
            transition: all 0.2s ease;
        }

        .modern-table tbody tr:hover td {
            background: rgba(2, 132, 199, 0.02);
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: var(--radius-md);
            color: var(--white);
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            color: var(--white);
        }

        .btn-action.edit { background: var(--primary); }
        .btn-action.delete { background: #ef4444; }

        .btn-add {
            padding: 10px 20px;
            background: var(--primary);
            color: var(--white);
            border-radius: var(--radius-md);
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-add:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-300);
            margin-bottom: 16px;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 1.1rem;
            margin: 0;
        }

        /* Modal Styles */
        .modal-modern {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1050;
            align-items: center;
            justify-content: center;
        }

        .modal-modern.show {
            display: flex;
        }

        .modal-dialog-modern {
            background: var(--white);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: modalFadeIn 0.3s ease-out;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.95) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-header-modern {
            padding: 24px 28px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--white);
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        .modal-title-modern {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--black);
            margin: 0;
            letter-spacing: -0.01em;
        }

        .modal-close {
            background: var(--gray-100);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: var(--gray-200);
            color: var(--gray-800);
        }

        .modal-body-modern {
            padding: 28px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            border: 2px solid var(--gray-200); 
            border-radius: var(--radius-md); 
            padding: 12px; 
            font-size: 1rem; 
            width: 100%; 
            box-sizing: border-box;
            transition: border-color 0.2s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
        }

    </style>

    <div class="content-area">
        <!-- Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Manajemen Admin</h1>
                <p class="page-subtitle">Kelola data administrator sistem</p>
            </div>
            <div>
                <button class="btn-add" id="btn-add-admin">
                    <i class="fas fa-plus"></i> Tambah Admin Baru
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (Session::get('success'))
            <div class="alert-modern alert-success-modern">
                <i class="fas fa-check-circle" style="font-size: 1.25rem;"></i>
                <div>
                    <strong>Berhasil!</strong> {{ Session::get('success') }}
                </div>
            </div>
        @endif
        
        @if (Session::get('warning'))
            <div class="alert-modern alert-warning-modern">
                <i class="fas fa-exclamation-circle" style="font-size: 1.25rem;"></i>
                <div>
                    <strong>Peringatan!</strong> {{ Session::get('warning') }}
                </div>
            </div>
        @endif

        @if (Session::get('error'))
            <div class="alert-modern alert-danger-modern">
                <i class="fas fa-times-circle" style="font-size: 1.25rem;"></i>
                <div>
                    <strong>Gagal!</strong> {{ Session::get('error') }}
                </div>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert-modern alert-danger-modern">
                <i class="fas fa-times-circle" style="font-size: 1.25rem;"></i>
                <div>
                    <strong>Gagal!</strong> Terdapat kesalahan input data.
                    <ul style="margin-top: 5px; margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-card-header">
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <h6 class="table-card-title">Daftar Administrator</h6>
                    <div style="color: var(--gray-600); font-size: 0.9rem;">
                        <i class="fas fa-user-shield"></i> Total: <strong>{{ $admins->count() }}</strong> admin
                    </div>
                </div>
            </div>
            
            <div class="table-card-body">
                @if($admins->count() > 0)
                    <div class="table-wrapper">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Bergabung</th>
                                    <th style="width: 120px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $index => $admin)
                                    <tr>
                                        <td><strong>{{ $index + 1 }}</strong></td>
                                        <td style="font-weight: 700; color: var(--gray-900);">{{ $admin->name }}</td>
                                        <td style="color: var(--gray-600);">{{ $admin->email }}</td>
                                        <td>
                                            @if($admin->role === 'murobi')
                                                <span style="background: #e0e7ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">Murobi</span>
                                            @else
                                                <span style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">Admin</span>
                                            @endif
                                        </td>
                                        <td style="color: var(--gray-600);">{{ \Carbon\Carbon::parse($admin->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <div style="display: flex; gap: 8px; justify-content: center;">
                                                <button class="btn-action edit btn-edit-admin" 
                                                    data-id="{{ $admin->id }}" 
                                                    data-name="{{ $admin->name }}" 
                                                    data-email="{{ $admin->email }}" 
                                                    data-role="{{ $admin->role }}"
                                                    title="Edit Admin">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                @if($datauser->id != $admin->id)
                                                <a href="/masteradmin/delete/{{ $admin->id }}" class="btn-action delete" title="Hapus Admin" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @else
                                                <button class="btn-action" style="background: var(--gray-300); cursor: not-allowed;" title="Tidak dapat menghapus diri sendiri" disabled>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-shield"></i>
                        <p>Belum ada data admin</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Tambah Admin -->
    <div class="modal-modern" id="modal-addAdmin">
        <div class="modal-dialog-modern">
            <div class="modal-header-modern">
                <h5 class="modal-title-modern">Tambah Admin Baru</h5>
                <button type="button" class="modal-close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('masteradmin.store') }}" method="POST">
                @csrf
                <div class="modal-body-modern">
                    <div class="form-group">
                        <label for="name" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label for="email" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Alamat Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Masukkan alamat email">
                    </div>
                    <div class="form-group">
                        <label for="role" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Role</label>
                        <select name="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="murobi">Murobi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Password</label>
                        <input type="text" name="password" class="form-control" required minlength="6" placeholder="Masukkan password (min. 6 karakter)">
                    </div>
                </div>
                <div style="padding: 20px 28px; border-top: 2px solid var(--gray-200); background: var(--gray-50); display: flex; justify-content: flex-end; gap: 12px; border-radius: 0 0 var(--radius-xl) var(--radius-xl);">
                    <button type="button" class="btn" style="padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; background: var(--gray-200); color: var(--gray-700); border: none; cursor: pointer;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" style="padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; background: var(--primary); color: var(--white); border: none; cursor: pointer;">Simpan Admin</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Admin -->
    <div class="modal-modern" id="modal-editAdmin">
        <div class="modal-dialog-modern">
            <div class="modal-header-modern">
                <h5 class="modal-title-modern">Edit Data Admin</h5>
                <button type="button" class="modal-close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('masteradmin.update') }}" method="POST">
                @csrf
                <div class="modal-body-modern">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="alert-modern alert-warning-modern" style="padding: 10px 16px; margin-bottom: 20px;">
                        <i class="fas fa-info-circle"></i>
                        <span>Kosongkan kolom password jika tidak ingin mengubah password.</span>
                    </div>

                    <div class="form-group">
                        <label for="edit-name" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Nama Lengkap</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Alamat Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-role" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Role</label>
                        <select name="role" id="edit-role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="murobi">Murobi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-password" style="font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block;">Ubah Password (Opsional)</label>
                        <input type="text" name="password" id="edit-password" class="form-control" minlength="6" placeholder="Ketik password baru untuk mengubahnya...">
                    </div>
                </div>
                <div style="padding: 20px 28px; border-top: 2px solid var(--gray-200); background: var(--gray-50); display: flex; justify-content: flex-end; gap: 12px; border-radius: 0 0 var(--radius-xl) var(--radius-xl);">
                    <button type="button" class="btn" style="padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; background: var(--gray-200); color: var(--gray-700); border: none; cursor: pointer;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" style="padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; background: var(--primary); color: var(--white); border: none; cursor: pointer;">Update Data</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('myscript')
    <script>
        $(function() {
            // Tambah Admin modal
            $("#btn-add-admin").click(function(e) {
                e.preventDefault();
                $("#modal-addAdmin").addClass('show');
            });

            // Edit Admin modal
            $(".btn-edit-admin").click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var role = $(this).data('role');
                
                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-email').val(email);
                $('#edit-role').val(role);
                $('#edit-password').val(''); // Clear password field
                
                $("#modal-editAdmin").addClass('show');
            });

            // Close modal handler
            $('[data-dismiss="modal"]').click(function() {
                $(".modal-modern").removeClass('show');
            });

            // Close modal when clicking outside
            $(".modal-modern").click(function(e) {
                if (e.target === this) {
                    $(this).removeClass('show');
                }
            });

            // Close modal with ESC key
            $(document).keyup(function(e) {
                if (e.key === "Escape") {
                    $(".modal-modern").removeClass('show');
                }
            });
        });
    </script>
@endpush