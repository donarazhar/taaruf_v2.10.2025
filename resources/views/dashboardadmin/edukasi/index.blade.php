@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        .edukasi-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius-lg);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .edukasi-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .edukasi-header h1 { font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; }
        .edukasi-header p { opacity: 0.9; font-size: 1rem; margin: 0; }

        .card-custom {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }

        .table-custom th {
            background-color: var(--primary);
            color: white;
        }
    </style>

    <div class="container-fluid">
        <div class="edukasi-header">
            <h1><i class="fas fa-book-open" style="margin-right: 8px;"></i> Kelola Edukasi Pranikah</h1>
            <p>Manajemen Artikel, Video YouTube, dan Kelas Pranikah</p>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="m-0 font-weight-bold text-primary">Daftar Materi Edukasi</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addEdukasiModal">
                    <i class="fas fa-plus"></i> Tambah Materi Baru
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-custom" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Jenis</th>
                            <th width="25%">Judul</th>
                            <th width="30%">Konten / Tgl Kelas</th>
                            <th width="10%">Status</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listEdukasi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($item->jenis == 'video')
                                    <span class="badge badge-danger"><i class="fab fa-youtube"></i> Video</span>
                                @elseif($item->jenis == 'artikel')
                                    <span class="badge badge-info"><i class="fas fa-file-alt"></i> Artikel</span>
                                @else
                                    <span class="badge badge-success"><i class="fas fa-chalkboard-teacher"></i> Kelas</span>
                                @endif
                            </td>
                            <td>{{ $item->judul }}</td>
                            <td>
                                @if($item->jenis == 'kelas')
                                    <strong>Tgl:</strong> {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}<br>
                                    <strong>Kuota:</strong> {{ $item->kuota }} orang<br>
                                    @php $countDaftar = isset($pendaftar[$item->id]) ? count($pendaftar[$item->id]) : 0; @endphp
                                    <span class="text-primary">{{ $countDaftar }} pendaftar</span>
                                @else
                                    {{ Str::limit($item->konten, 50) }}
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $item->status == 'aktif' ? 'badge-success' : 'badge-secondary' }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $item->id }}"><i class="fas fa-edit"></i> Edit</button>
                                <a href="{{ route('murobi.edukasi.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus materi ini?')"><i class="fas fa-trash"></i> Hapus</a>
                                
                                @if($item->jenis == 'kelas')
                                    <button class="btn btn-sm btn-info mt-1" data-toggle="modal" data-target="#pendaftarModal{{ $item->id }}"><i class="fas fa-users"></i> Peserta</button>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Edukasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('murobi.edukasi.update', $item->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Jenis</label>
                                                <select name="jenis" class="form-control" required>
                                                    <option value="video" {{ $item->jenis == 'video' ? 'selected' : '' }}>Video YouTube</option>
                                                    <option value="artikel" {{ $item->jenis == 'artikel' ? 'selected' : '' }}>Artikel</option>
                                                    <option value="kelas" {{ $item->jenis == 'kelas' ? 'selected' : '' }}>Kelas / Seminar Pranikah</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Konten (URL Video / Teks Artikel / Deskripsi Kelas)</label>
                                                <textarea name="konten" class="form-control" rows="5" required>{{ $item->konten }}</textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal Kegiatan (Khusus Kelas)</label>
                                                    <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ $item->tanggal_kegiatan }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kuota (Khusus Kelas)</label>
                                                    <input type="number" name="kuota" class="form-control" value="{{ $item->kuota }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="aktif" {{ $item->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Pendaftar Kelas -->
                        @if($item->jenis == 'kelas')
                        <div class="modal fade" id="pendaftarModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Daftar Peserta Kelas: {{ $item->judul }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if(isset($pendaftar[$item->id]) && count($pendaftar[$item->id]) > 0)
                                            <table class="table table-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Peserta</th>
                                                        <th>Email / NIP</th>
                                                        <th>Tanggal Daftar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pendaftar[$item->id] as $idx => $peserta)
                                                    <tr>
                                                        <td>{{ $idx + 1 }}</td>
                                                        <td>{{ $peserta->nama }}</td>
                                                        <td>{{ $peserta->karyawan_email }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($peserta->created_at)->format('d M Y H:i') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="alert alert-info">Belum ada peserta yang mendaftar di kelas ini.</div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada materi edukasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Edukasi -->
    <div class="modal fade" id="addEdukasiModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Materi Edukasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('murobi.edukasi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis Materi</label>
                            <select name="jenis" class="form-control" required id="jenisSelect">
                                <option value="video">Video YouTube</option>
                                <option value="artikel">Artikel</option>
                                <option value="kelas">Kelas / Seminar Pranikah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Membangun Keluarga Sakinah" required>
                        </div>
                        <div class="form-group">
                            <label id="kontenLabel">URL Video YouTube</label>
                            <textarea name="konten" class="form-control" rows="5" placeholder="Masukkan URL / Teks" required></textarea>
                            <small class="text-muted" id="kontenHelp">Untuk video, masukkan link YouTube (contoh: https://www.youtube.com/watch?v=XXXXX)</small>
                        </div>
                        
                        <div id="kelasFields" style="display: none; background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                            <h6>Pengaturan Kelas</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kuota Peserta</label>
                                    <input type="number" name="kuota" class="form-control" placeholder="Contoh: 50">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="aktif">Aktif</option>
                                <option value="draft">Draft (Sembunyikan)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('jenisSelect').addEventListener('change', function() {
            const jenis = this.value;
            const label = document.getElementById('kontenLabel');
            const help = document.getElementById('kontenHelp');
            const kelasFields = document.getElementById('kelasFields');
            
            if (jenis === 'video') {
                label.innerText = 'URL Video YouTube';
                help.innerText = 'Untuk video, masukkan link YouTube (contoh: https://www.youtube.com/watch?v=XXXXX)';
                kelasFields.style.display = 'none';
            } else if (jenis === 'artikel') {
                label.innerText = 'Teks Artikel';
                help.innerText = 'Masukkan teks isi artikel edukasi di sini.';
                kelasFields.style.display = 'none';
            } else if (jenis === 'kelas') {
                label.innerText = 'Deskripsi Kelas';
                help.innerText = 'Masukkan informasi tentang kelas/seminar, pembicara, lokasi, dll.';
                kelasFields.style.display = 'block';
            }
        });
    </script>
    @endpush
@endsection
