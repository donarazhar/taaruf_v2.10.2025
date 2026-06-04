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
            font-weight: 700;
            color: var(--text-main);
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
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .employee-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--accent);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .employee-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent);
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
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            background: var(--primary-light);
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .employee-ref {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 4px;
            display: block;
        }

        .employee-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 10px 0 6px;
            line-height: 1.3;
        }

        .employee-criteria {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .employee-avatar {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            object-fit: cover;
            border: 2px solid var(--gray-100);
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            margin: 32px 0;
            display: flex;
            justify-content: center;
        }

        /* ===== DATA TABLE ===== */
        .table-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--gray-200);
            background: var(--white);
        }

        .table-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
        }

        .table-body {
            padding: 0;
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
            background: var(--gray-50);
            color: var(--text-muted);
        }

        .modern-table thead th {
            padding: 16px 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--gray-200);
        }

        .modern-table tbody tr {
            transition: all 0.2s ease;
        }

        .modern-table tbody tr:not(:last-child) td {
            border-bottom: 1px solid var(--gray-100);
        }

        .modern-table tbody tr:hover {
            background: var(--gray-50);
        }

        .modern-table tbody td {
            padding: 16px 20px;
            text-align: left;
            color: var(--text-main);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .table-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            vertical-align: middle;
            margin-right: 12px;
            border: 2px solid var(--white);
            box-shadow: var(--shadow-sm);
        }

        .btn-view {
            padding: 8px 16px;
            background: var(--primary-light);
            color: var(--primary);
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-view:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-1px);
        }

        .btn-delete {
            padding: 8px 16px;
            background: #ffe4e6;
            color: #e11d48;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete:hover {
            background: #e11d48;
            color: var(--white);
            transform: translateY(-1px);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .employee-grid {
                grid-template-columns: 1fr;
            }

            .table-body {
                padding: 0;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 12px 16px;
                font-size: 0.85rem;
            }
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: 0.5;
            color: var(--primary);
        }

        .empty-state p {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
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
            min-width: 36px;
            height: 36px;
            padding: 8px 12px;
            background: var(--white);
            color: var(--text-muted);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .pagination-wrapper .page-link:hover {
            background: var(--gray-50);
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination-wrapper .page-item.active .page-link {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .pagination-wrapper .page-item.disabled .page-link {
            background: var(--gray-50);
            color: var(--gray-400);
            border-color: var(--gray-200);
            cursor: not-allowed;
            opacity: 0.6;
        }

        @media (max-width: 576px) {
            .pagination-wrapper .page-link {
                min-width: 32px;
                height: 32px;
                padding: 4px 8px;
                font-size: 0.85rem;
            }
            .pagination-wrapper .pagination {
                gap: 4px;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Data Karyawan</h1>
    </div>

    <!-- Dashboard Cards -->
    <div class="employee-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
        <!-- Laki-laki Card -->
        <div class="employee-card" style="border-left: 4px solid var(--primary);">
            <div class="employee-header" style="margin-bottom: 0;">
                <div class="employee-info">
                    <h5 style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Laki-laki</h5>
                    <div style="font-size: 2.5rem; font-weight: 800; color: var(--text-main); margin-top: 8px;">{{ $totalLaki }}</div>
                </div>
                <div style="width: 60px; height: 60px; border-radius: var(--radius-md); background: var(--primary-light); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.8rem;">
                    <i class="fas fa-male"></i>
                </div>
            </div>
            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 16px; border-top: 1px solid var(--gray-100); padding-top: 12px;">
                <i class="fas fa-chart-line text-success"></i> Total pendaftar Laki-laki
            </div>
        </div>

        <!-- Perempuan Card -->
        <div class="employee-card" style="border-left: 4px solid #e11d48;">
            <div class="employee-header" style="margin-bottom: 0;">
                <div class="employee-info">
                    <h5 style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Perempuan</h5>
                    <div style="font-size: 2.5rem; font-weight: 800; color: var(--text-main); margin-top: 8px;">{{ $totalPerempuan }}</div>
                </div>
                <div style="width: 60px; height: 60px; border-radius: var(--radius-md); background: #ffe4e6; display: flex; align-items: center; justify-content: center; color: #e11d48; font-size: 1.8rem;">
                    <i class="fas fa-female"></i>
                </div>
            </div>
            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 16px; border-top: 1px solid var(--gray-100); padding-top: 12px;">
                <i class="fas fa-chart-line text-success"></i> Total pendaftar Perempuan
            </div>
        </div>

        <!-- Belum Terverifikasi Card -->
        <div class="employee-card" style="border-left: 4px solid var(--warning);">
            <div class="employee-header" style="margin-bottom: 0;">
                <div class="employee-info">
                    <h5 style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Belum Verifikasi</h5>
                    <div style="font-size: 2.5rem; font-weight: 800; color: var(--text-main); margin-top: 8px;">{{ $belumVerifikasi }}</div>
                </div>
                <div style="width: 60px; height: 60px; border-radius: var(--radius-md); background: #fef3c7; display: flex; align-items: center; justify-content: center; color: var(--warning); font-size: 1.8rem;">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>
            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 16px; border-top: 1px solid var(--gray-100); padding-top: 12px;">
                <i class="fas fa-info-circle text-warning"></i> Akun menunggu persetujuan Admin
            </div>
        </div>
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