@extends('dashboard.dashlayouts.app')
@section('content')

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only">Loading...</div>
        </div>
    </div>

    <!-- Header Area -->
    @include('dashboard.dashlayouts.header')

    <div class="page-content-wrapper">
        <div class="container pt-5 pb-5">
            <!-- Hero Section -->
            <div class="card mb-4" style="border-radius: 20px; border: none; overflow: hidden; position: relative;">
                <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 3rem 2rem; color: white;">
                    <h2 class="font-weight-bold mb-2">Edukasi Pranikah</h2>
                    <p class="mb-0" style="opacity: 0.9; font-size: 1.1rem;">Bekal Ilmu Menuju Keluarga Sakinah Mawaddah Warahmah</p>
                    
                    <!-- Decorative Elements -->
                    <i class="fas fa-book-reader" style="position: absolute; right: 2rem; bottom: -1rem; font-size: 8rem; opacity: 0.15;"></i>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px;">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px;">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <!-- Tabs Navigation -->
            <ul class="nav nav-pills mb-4 d-flex justify-content-center" id="edukasiTab" role="tablist" style="background: var(--white); padding: 10px; border-radius: 50px; box-shadow: var(--shadow-sm);">
                <li class="nav-item flex-fill text-center" role="presentation">
                    <a class="nav-link active font-weight-bold" id="video-tab" data-toggle="pill" href="#video" role="tab" style="border-radius: 50px; padding: 12px 0;">
                        <i class="fab fa-youtube mr-1"></i> Video Kajian
                    </a>
                </li>
                <li class="nav-item flex-fill text-center" role="presentation">
                    <a class="nav-link font-weight-bold" id="artikel-tab" data-toggle="pill" href="#artikel" role="tab" style="border-radius: 50px; padding: 12px 0;">
                        <i class="fas fa-file-alt mr-1"></i> Artikel
                    </a>
                </li>
                <li class="nav-item flex-fill text-center" role="presentation">
                    <a class="nav-link font-weight-bold" id="kelas-tab" data-toggle="pill" href="#kelas" role="tab" style="border-radius: 50px; padding: 12px 0;">
                        <i class="fas fa-chalkboard-teacher mr-1"></i> Kelas Pranikah
                    </a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="edukasiTabContent">
                
                <!-- VIDEO TAB -->
                <div class="tab-pane fade show active" id="video" role="tabpanel">
                    <div class="row">
                        @forelse($listVideo as $video)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                                @php
                                    // Extract YouTube Video ID
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video->konten, $match);
                                    $ytId = $match[1] ?? '';
                                @endphp
                                @if($ytId)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $ytId }}" allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center p-5">
                                        <i class="fas fa-video fa-3x"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $video->judul }}</h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fas fa-video fa-3x mb-3"></i>
                            <p>Belum ada video kajian pranikah yang tersedia.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- ARTIKEL TAB -->
                <div class="tab-pane fade" id="artikel" role="tabpanel">
                    <div class="row">
                        @forelse($listArtikel as $artikel)
                        <div class="col-12 mb-4">
                            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <h4 class="font-weight-bold text-primary mb-3">{{ $artikel->judul }}</h4>
                                    <div class="text-muted mb-3" style="font-size: 0.9rem;">
                                        <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
                                    </div>
                                    <p class="mb-0" style="line-height: 1.8;">
                                        {!! nl2br(e($artikel->konten)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fas fa-book-open fa-3x mb-3"></i>
                            <p>Belum ada artikel edukasi yang tersedia.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- KELAS TAB -->
                <div class="tab-pane fade" id="kelas" role="tabpanel">
                    <div class="row">
                        @forelse($listKelas as $kelas)
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; overflow: hidden; border-left: 5px solid var(--primary) !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="font-weight-bold m-0" style="color: var(--primary);">{{ $kelas->judul }}</h5>
                                        <span class="badge badge-primary px-3 py-2" style="border-radius: 20px;">
                                            <i class="fas fa-users"></i> Kuota: {{ $kelas->kuota ?? 'Tak Terbatas' }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <div style="width: 30px; color: var(--primary);"><i class="far fa-calendar-alt fa-lg"></i></div>
                                            <strong>{{ \Carbon\Carbon::parse($kelas->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</strong>
                                        </div>
                                    </div>

                                    <p class="text-muted">{{ $kelas->konten }}</p>

                                    @php
                                        $statusDaftar = $riwayatDaftar[$kelas->id] ?? null;
                                    @endphp

                                    <div class="mt-4 pt-3 border-top">
                                        @if($statusDaftar == 'menunggu')
                                            <button class="btn btn-warning btn-block" disabled style="border-radius: 10px;">
                                                <i class="fas fa-hourglass-half"></i> Menunggu Konfirmasi
                                            </button>
                                        @elseif($statusDaftar == 'diterima')
                                            <button class="btn btn-success btn-block" disabled style="border-radius: 10px;">
                                                <i class="fas fa-check-circle"></i> Pendaftaran Diterima
                                            </button>
                                        @elseif($statusDaftar == 'ditolak')
                                            <button class="btn btn-danger btn-block" disabled style="border-radius: 10px;">
                                                <i class="fas fa-times-circle"></i> Pendaftaran Ditolak
                                            </button>
                                        @else
                                            <form action="{{ route('dashboard.edukasi.daftar', $kelas->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="border-radius: 10px;" onclick="return confirm('Anda yakin ingin mendaftar kelas ini?')">
                                                    Daftar Sekarang <i class="fas fa-arrow-right ml-1"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                            <p>Belum ada jadwal kelas pranikah dalam waktu dekat.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Area -->
    @include('dashboard.dashlayouts.footer')

    @push('myscript')
    <style>
        .nav-pills .nav-link {
            color: var(--text-muted);
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.3);
        }
        .nav-pills .nav-link:hover:not(.active) {
            background-color: rgba(var(--primary-rgb), 0.1);
            color: var(--primary);
        }
    </style>
    @endpush
@endsection
