@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MUROBI PROGRESS PAGE STYLES ===== */

        /* Page Header */
        .progress-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: var(--radius-lg);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .progress-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .progress-header h1 { font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; }
        .progress-header p { opacity: 0.9; font-size: 1rem; margin: 0; }

        /* Pairing Card */
        .pairing-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }

        .pairing-card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pairing-card-title i {
            color: var(--primary);
            font-size: 1.3rem;
        }

        /* Pairing Form */
        .pairing-form {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .select-group {
            flex: 1;
            min-width: 250px;
        }

        .select-group label {
            display: block;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .select-group label i {
            margin-right: 6px;
        }

        .select-group label .label-pria { color: #3b82f6; }
        .select-group label .label-wanita { color: #ec4899; }

        .custom-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            background: var(--white);
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            cursor: pointer;
        }

        .custom-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 76, 129, 0.1);
        }

        /* VS Divider */
        .vs-divider-form {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 1.5rem;
        }

        .vs-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ef4444, #ec4899);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);
        }

        .vs-circle i {
            color: white;
            font-size: 1.3rem;
        }

        /* Preview Section */
        .preview-section {
            display: none;
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: var(--radius-md);
            border: 2px dashed var(--gray-300);
        }

        .preview-section.show {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .preview-person {
            text-align: center;
            flex: 1;
            min-width: 120px;
        }

        .preview-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: var(--shadow-md);
            margin-bottom: 0.5rem;
        }

        .preview-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .preview-heart {
            font-size: 2rem;
            color: #ef4444;
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Submit Button */
        .btn-pasangkan {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-pasangkan:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 76, 129, 0.3);
        }

        .btn-pasangkan:active {
            transform: translateY(0);
        }

        /* Existing Pairs Table */
        .pairs-table-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--gray-200);
        }

        .pairs-table-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        .pairs-table-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pairs-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pairs-table thead th {
            padding: 0.875rem 1rem;
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }

        .pairs-table tbody td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.9rem;
            color: var(--text-main);
            vertical-align: middle;
        }

        .pairs-table tbody tr:hover {
            background: var(--gray-50);
        }

        .pairs-table tbody tr:last-child td {
            border-bottom: none;
        }

        .pair-person {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pair-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-200);
        }

        .pair-info .pair-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pair-info .pair-nip {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: #ecfdf5;
            color: #065f46;
        }

        .empty-pairs {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-muted);
        }

        .empty-pairs i { font-size: 2.5rem; opacity: 0.3; margin-bottom: 0.75rem; }
        .empty-pairs p { margin: 0; }

        /* Alert */
        .alert-murobi {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            animation: fadeInUp 0.3s ease;
        }

        .alert-success-m { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error-m { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Responsive */
        @media (max-width: 768px) {
            .progress-header { padding: 1.5rem; }
            .progress-header h1 { font-size: 1.35rem; }
            .pairing-card { padding: 1.25rem; }
            .pairing-form { flex-direction: column; }
            .vs-divider-form { padding: 0; }
            .preview-section.show { flex-direction: column; }
        }
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="progress-header">
            <h1><i class="fas fa-heart" style="margin-right: 8px;"></i> Murobi - Progress Ta'aruf</h1>
            <p>Pasangkan peserta pria dan wanita untuk memulai proses ta'aruf</p>
        </div>

        <!-- Alerts -->
        @if (Session::get('success'))
            <div class="alert-murobi alert-success-m">
                <i class="fas fa-check-circle"></i>
                <span>{{ Session::get('success') }}</span>
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert-murobi alert-error-m">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ Session::get('error') }}</span>
            </div>
        @endif

        <!-- Pairing Card -->
        <div class="pairing-card">
            <div class="pairing-card-title">
                <i class="fas fa-user-plus"></i> Pasangkan Peserta Ta'aruf
            </div>

            <form action="{{ route('murobi.progress.store') }}" method="POST" id="pairingForm">
                @csrf

                <div class="pairing-form">
                    <!-- Select Pria -->
                    <div class="select-group">
                        <label><i class="fas fa-mars label-pria"></i> Pilih Pria</label>
                        <select name="email_pria" id="selectPria" class="custom-select" required onchange="updatePreview()">
                            <option value="">-- Pilih Karyawan Pria --</option>
                            @foreach($listPria as $pria)
                                @php
                                    $isInProgress = in_array($pria->email, $inProgressEmails);
                                @endphp
                                <option value="{{ $pria->email }}" 
                                        data-nama="{{ $pria->nama }}" 
                                        data-foto="{{ !empty($pria->foto) ? Storage::url('uploads/karyawan/img/' . $pria->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($pria->nama) . '&background=3b82f6&color=fff&size=200' }}"
                                        {{ $isInProgress ? 'disabled' : '' }}>
                                    {{ $pria->nama }} ({{ $pria->nip }}) {{ $isInProgress ? '- (Sedang Progress)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- VS Divider -->
                    <div class="vs-divider-form">
                        <div class="vs-circle">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>

                    <!-- Select Wanita -->
                    <div class="select-group">
                        <label><i class="fas fa-venus label-wanita"></i> Pilih Wanita</label>
                        <select name="email_wanita" id="selectWanita" class="custom-select" required onchange="updatePreview()">
                            <option value="">-- Pilih Karyawan Wanita --</option>
                            @foreach($listWanita as $wanita)
                                @php
                                    $isInProgress = in_array($wanita->email, $inProgressEmails);
                                @endphp
                                <option value="{{ $wanita->email }}" 
                                        data-nama="{{ $wanita->nama }}" 
                                        data-foto="{{ !empty($wanita->foto) ? Storage::url('uploads/karyawan/img/' . $wanita->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($wanita->nama) . '&background=ec4899&color=fff&size=200' }}"
                                        {{ $isInProgress ? 'disabled' : '' }}>
                                    {{ $wanita->nama }} ({{ $wanita->nip }}) {{ $isInProgress ? '- (Sedang Progress)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="preview-section" id="previewSection">
                    <div class="preview-person">
                        <img class="preview-avatar" id="previewPriaImg" src="" alt="Pria">
                        <div class="preview-name" id="previewPriaName">-</div>
                    </div>
                    <div class="preview-heart">❤️</div>
                    <div class="preview-person">
                        <img class="preview-avatar" id="previewWanitaImg" src="" alt="Wanita">
                        <div class="preview-name" id="previewWanitaName">-</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-pasangkan" onclick="return confirm('Apakah Anda yakin ingin memasangkan pasangan ini?')">
                    <i class="fas fa-heart"></i> Pasangkan Sekarang
                </button>
            </form>
        </div>

        <!-- Existing Pairs Table -->
        <div class="pairs-table-card">
            <div class="pairs-table-header">
                <h3><i class="fas fa-list"></i> Daftar Pasangan yang Sudah Dipasangkan</h3>
            </div>

            @if($existingPairs->count() > 0)
                <div style="overflow-x: auto;">
                    <table class="pairs-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Pria</th>
                                <th>Wanita</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($existingPairs as $index => $pair)
                                <tr>
                                    <td><strong>{{ $index + 1 }}</strong></td>
                                    <td>
                                        <div class="pair-person">
                                            @php
                                                $fotoPria = !empty($pair->foto_pria) ? Storage::url('uploads/karyawan/img/' . $pair->foto_pria) : 'https://ui-avatars.com/api/?name=' . urlencode($pair->nama_pria ?? 'P') . '&background=3b82f6&color=fff&size=200';
                                            @endphp
                                            <img src="{{ $fotoPria }}" alt="" class="pair-avatar">
                                            <div class="pair-info">
                                                <div class="pair-name">{{ $pair->nama_pria ?? '-' }}</div>
                                                <div class="pair-nip">{{ $pair->nip_pria ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="pair-person">
                                            @php
                                                $fotoWanita = !empty($pair->foto_wanita) ? Storage::url('uploads/karyawan/img/' . $pair->foto_wanita) : 'https://ui-avatars.com/api/?name=' . urlencode($pair->nama_wanita ?? 'W') . '&background=ec4899&color=fff&size=200';
                                            @endphp
                                            <img src="{{ $fotoWanita }}" alt="" class="pair-avatar">
                                            <div class="pair-info">
                                                <div class="pair-name">{{ $pair->nama_wanita ?? '-' }}</div>
                                                <div class="pair-nip">{{ $pair->nip_wanita ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $pair->progress_tgl ? \Carbon\Carbon::parse($pair->progress_tgl)->format('d M Y') : '-' }}</td>
                                    <td>
                                        <span class="status-badge status-active">
                                            <i class="fas fa-check-circle"></i> Aktif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-pairs">
                    <i class="fas fa-heart-broken"></i>
                    <p>Belum ada pasangan yang dipasangkan</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function updatePreview() {
            const selectPria = document.getElementById('selectPria');
            const selectWanita = document.getElementById('selectWanita');
            const previewSection = document.getElementById('previewSection');

            const priaOption = selectPria.options[selectPria.selectedIndex];
            const wanitaOption = selectWanita.options[selectWanita.selectedIndex];

            if (selectPria.value && selectWanita.value) {
                document.getElementById('previewPriaImg').src = priaOption.dataset.foto;
                document.getElementById('previewPriaName').textContent = priaOption.dataset.nama;
                document.getElementById('previewWanitaImg').src = wanitaOption.dataset.foto;
                document.getElementById('previewWanitaName').textContent = wanitaOption.dataset.nama;
                previewSection.classList.add('show');
            } else {
                previewSection.classList.remove('show');
            }
        }
    </script>
@endsection
