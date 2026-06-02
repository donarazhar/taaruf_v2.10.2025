@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MODERN DASHBOARD CONTENT STYLES ===== */
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

        /* ===== EMPLOYEE CARDS ===== */
        .employee-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .employee-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .employee-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--black);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .employee-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--black);
        }

        .employee-card:hover::before {
            transform: scaleY(1);
        }

        .employee-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 16px;
            margin-bottom: 16px;
        }

        .employee-info {
            flex: 1;
        }

        .employee-nip {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .employee-ref {
            font-size: 0.7rem;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .employee-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--black);
            margin: 8px 0;
            line-height: 1.3;
        }

        .employee-criteria {
            font-size: 0.8rem;
            color: var(--gray-600);
            line-height: 1.4;
        }

        .employee-avatar {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            object-fit: cover;
            border: 2px solid var(--gray-200);
            flex-shrink: 0;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            margin: 32px 0;
            display: flex;
            justify-content: center;
        }

        /* ===== CHART CARDS ===== */
        .chart-section {
            margin-bottom: 32px;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .chart-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .chart-card:hover {
            border-color: var(--black);
            box-shadow: var(--shadow-md);
        }

        .chart-header {
            padding: 20px 24px;
            border-bottom: 2px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--gray-50);
        }

        .chart-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--black);
            margin: 0;
        }

        .chart-menu {
            color: var(--gray-600);
            cursor: pointer;
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
        }

        .chart-menu:hover {
            background: var(--gray-200);
            color: var(--black);
        }

        .chart-body {
            padding: 24px;
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--gray-700);
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ===== DATA TABLE ===== */
        .table-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 32px;
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 2px solid var(--gray-200);
            background: var(--gray-50);
        }

        .table-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--black);
            margin: 0;
        }

        .table-body {
            padding: 24px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table thead {
            background: var(--black);
            color: var(--white);
        }

        .modern-table thead th {
            padding: 16px 20px;
            font-size: 0.85rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
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

        .modern-table tbody td {
            padding: 16px 20px;
            text-align: center;
            color: var(--gray-700);
            font-size: 0.9rem;
        }

        .table-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            vertical-align: middle;
            margin-right: 8px;
            border: 2px solid var(--gray-200);
        }

        .btn-view {
            padding: 8px 20px;
            background: var(--black);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view:hover {
            background: var(--gray-900);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: var(--white);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .employee-grid {
                grid-template-columns: 1fr;
            }

            .chart-body {
                padding: 16px;
            }

            .table-body {
                padding: 16px;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 12px 10px;
                font-size: 0.8rem;
            }
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

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin: 32px 0;
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination-wrapper .page-item {
            display: inline-block;
        }

        .pagination-wrapper .page-link {
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

        .pagination-wrapper .page-link:hover {
            background: var(--gray-100);
            border-color: var(--black);
            color: var(--black);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .pagination-wrapper .page-item.active .page-link {
            background: var(--black);
            color: var(--white);
            border-color: var(--black);
            box-shadow: var(--shadow-md);
        }

        .pagination-wrapper .page-item.disabled .page-link {
            background: var(--gray-100);
            color: var(--gray-400);
            border-color: var(--gray-200);
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination-wrapper .page-item.disabled .page-link:hover {
            transform: none;
            box-shadow: none;
        }

        /* Pagination arrows */
        .pagination-wrapper .page-link[rel="prev"],
        .pagination-wrapper .page-link[rel="next"] {
            font-weight: 700;
        }

        @media (max-width: 576px) {
            .pagination-wrapper .page-link {
                min-width: 36px;
                height: 36px;
                padding: 6px 10px;
                font-size: 0.85rem;
            }

            .pagination-wrapper .pagination {
                gap: 6px;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Data Karyawan</h1>
    </div>

    <!-- Employee Cards Grid -->
    @if($datakaryawan->count() > 0)
        <div class="employee-grid">
            @foreach ($datakaryawan as $d)
                <div class="employee-card">
                    <div class="employee-header">
                        <div class="employee-info">
                            <div class="employee-nip">
                                {{ $d->nip }}
                                <span class="employee-ref">Ref: {{ $d->referensi_detail ?? '-' }}</span>
                            </div>
                            <h3 class="employee-name">{{ $d->nama }}</h3>
                            <div class="employee-criteria">
                                {{ $d->kriteriaumum }}
                            </div>
                        </div>
                        <div>
                            @if ($d->foto == null)
                                <img src="{{ asset('assets/img/nophoto.png') }}" alt="avatar" class="employee-avatar">
                            @else
                                @php
                                    $path = Storage::url('uploads/karyawan/img/' . $d->foto);
                                @endphp
                                <img src="{{ $path }}" alt="{{ $d->nama }}" class="employee-avatar">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <p>Belum ada data karyawan</p>
        </div>
    @endif

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $datakaryawan->links('vendor.pagination.bootstrap-5') }}
    </div>

    <!-- Charts Section -->
    {{-- <div class="chart-section">
        <div class="chart-grid">
            <!-- Line Chart - Suku -->
            <div class="chart-card">
                <div class="chart-header">
                    <h6 class="chart-title">Grafik Distribusi Suku</h6>
                    <div class="chart-menu">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <div class="chart-body">
                    <canvas id="myAreaChartsuku" height="320"></canvas>
                </div>
            </div>

            <!-- Pie Chart - Pendidikan -->
            <div class="chart-card">
                <div class="chart-header">
                    <h6 class="chart-title">Grafik Pendidikan</h6>
                    <div class="chart-menu">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <div class="chart-body">
                    <canvas id="myPieChartpendidikan" height="280"></canvas>
                    <div class="chart-legend">
                        @foreach ($pendidikan as $d)
                            <div class="legend-item">
                                <span class="legend-dot" style="background: {{ ['#000000', '#1A1A1A', '#404040', '#666666', '#808080', '#999999', '#CCCCCC'][$loop->index % 7] }}"></span>
                                <span>{{ $d->pendidikan }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- History Chat Table -->
    <div class="table-card">
        <div class="table-header">
            <h6 class="table-title">History Chat Ta'aruf</h6>
        </div>
        <div class="table-body">
            <div class="table-responsive">
                @if($resultChat && count($resultChat) > 0)
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
                                        @php
                                            $pathSender = Storage::url('uploads/karyawan/img/' . $data['data'][0]['foto_sender']);
                                        @endphp
                                        <img src="{{ $pathSender }}" alt="Sender" class="table-avatar">
                                        <strong>{{ $data['data'][0]['nama_sender'] }}</strong>
                                    </td>
                                    <td>
                                        @php
                                            $pathProfile = Storage::url('uploads/karyawan/img/' . $data['data'][0]['foto_profile']);
                                        @endphp
                                        <img src="{{ $pathProfile }}" alt="Receiver" class="table-avatar">
                                        <strong>{{ $data['data'][0]['nama_profile'] }}</strong>
                                    </td>
                                    <td>
                                        <a href="{{ route('historychat', ['id' => $data['id_progress']]) }}" class="btn-view">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-comments"></i>
                        <p>Belum ada history chat</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- @push('myscript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Line Chart - Suku
            var ctxSuku = document.getElementById('myAreaChartsuku').getContext('2d');
            var myAreaChartsuku = new Chart(ctxSuku, {
                type: 'line',
                data: {
                    labels: {!! json_encode($suku->pluck('suku')) !!},
                    datasets: [{
                        label: 'Jumlah Pengguna',
                        data: {!! json_encode($suku->pluck('count')) !!},
                        borderColor: '#000000',
                        backgroundColor: 'rgba(0, 0, 0, 0.05)',
                        pointRadius: 4,
                        pointBackgroundColor: '#000000',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#000000',
                        pointHoverBorderColor: '#ffffff',
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#000000',
                            bodyColor: '#666666',
                            borderColor: '#E5E5E5',
                            borderWidth: 2,
                            padding: 12,
                            displayColors: false,
                            bodyFont: {
                                size: 13,
                                weight: '600'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#666666',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#F5F5F5',
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: '#666666',
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                padding: 10
                            }
                        }
                    }
                }
            });

            // Pie Chart - Pendidikan
            var ctxPendidikan = document.getElementById('myPieChartpendidikan').getContext('2d');
            var myPieChartpendidikan = new Chart(ctxPendidikan, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($pendidikan->pluck('pendidikan')) !!},
                    datasets: [{
                        data: {!! json_encode($pendidikan->pluck('count')) !!},
                        backgroundColor: [
                            '#000000', '#1A1A1A', '#404040', '#666666', 
                            '#808080', '#999999', '#CCCCCC'
                        ],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverBorderWidth: 4,
                        hoverBorderColor: '#ffffff'
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#000000',
                            bodyColor: '#666666',
                            borderColor: '#E5E5E5',
                            borderWidth: 2,
                            padding: 12,
                            displayColors: true,
                            bodyFont: {
                                size: 13,
                                weight: '600'
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
@endpush --}}