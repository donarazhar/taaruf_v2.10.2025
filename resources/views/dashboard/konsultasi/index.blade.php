@extends('dashboard.dashlayouts.style')
@section('content')

    <div class="container pt-5 pb-5">
        <!-- Hero Section -->
        <div class="card mb-4" style="border-radius: 20px; border: none; overflow: hidden; position: relative;">
            <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 3rem 2rem; color: white;">
                <h2 class="font-weight-bold mb-2">Konsultasi Murobbi</h2>
                <p class="mb-0" style="opacity: 0.9; font-size: 1.1rem;">Diskusikan persiapan dan kriteria pasangan Anda</p>
                
                <i class="bi bi-chat-dots-fill" style="position: absolute; right: 2rem; bottom: -1rem; font-size: 8rem; opacity: 0.15;"></i>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px;">
            <i class="bi bi-check-circle-fill mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-6 mb-4">
                <div class="bg-white p-4 h-100" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>
                        <h5 class="mb-0 fw-bold text-dark">Konsultasi dengan Murobbi</h5>
                    </div>
                    <p class="text-muted" style="font-size: 0.9rem;">Bingung menentukan pilihan atau butuh saran pra-ta'aruf? Ajukan jadwal konsultasi dengan Murobbi Anda.</p>
                    
                    <form action="{{ route('dashboard.konsultasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold" style="font-size: 0.85rem;">Topik Konsultasi</label>
                            <select name="topik_konsultasi" class="form-select text-dark" required>
                                <option value="">Pilih Topik...</option>
                                <option value="Saran Pemilihan Calon">Saran Pemilihan Calon</option>
                                <option value="Persiapan Ta'aruf">Persiapan Ta'aruf</option>
                                <option value="Diskusi Kriteria">Diskusi Kriteria Pasangan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold" style="font-size: 0.85rem;">Pesan Tambahan</label>
                            <textarea name="pesan" rows="4" class="form-control text-dark" placeholder="Jelaskan secara singkat apa yang ingin didiskusikan..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="border-radius: 20px; font-weight: 600;">
                            Ajukan Jadwal Konsultasi <i class="bi bi-send ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Riwayat Konsultasi -->
            <div class="col-lg-6 mb-4">
                <div class="bg-white p-4 h-100" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);">
                    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Konsultasi</h5>
                    @if(isset($riwayatKonsultasi) && $riwayatKonsultasi->count() > 0)
                        <div style="max-height: 450px; overflow-y: auto; padding-right: 10px;">
                            @foreach($riwayatKonsultasi as $konsultasi)
                                <div class="border-start border-3 border-{{ $konsultasi->status == 'menunggu' ? 'warning' : ($konsultasi->status == 'dijadwalkan' ? 'primary' : 'success') }} ps-3 mb-3 pb-2 border-bottom">
                                    <h6 class="fw-bold mb-1 text-dark" style="font-size: 0.95rem;">{{ $konsultasi->topik_konsultasi }}</h6>
                                    <p class="text-muted mb-1" style="font-size: 0.8rem;">
                                        <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($konsultasi->created_at)->format('d M Y') }}
                                        <span class="badge bg-{{ $konsultasi->status == 'menunggu' ? 'warning text-dark' : ($konsultasi->status == 'dijadwalkan' ? 'primary' : 'success') }} ms-2">
                                            {{ ucfirst($konsultasi->status) }}
                                        </span>
                                    </p>
                                    @if($konsultasi->pesan_balasan_murobbi)
                                    <div class="bg-light p-2 rounded mt-2" style="font-size: 0.85rem; border-left: 2px solid var(--success-color);">
                                        <strong>Balasan Murobbi:</strong><br>
                                        {{ $konsultasi->pesan_balasan_murobbi }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-chat-square-text text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Belum ada riwayat pengajuan konsultasi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
