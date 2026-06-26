@extends('layouts.app', ['title' => 'Dashboard BOSS'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.css">
        <style>
            :root {
                --primary: #0d6efd;
                --primary-light: #e7f1ff;
                --secondary: #6c757d;
                --success: #198754;
                --warning: #ffc107;
                --danger: #dc3545;
                --info: #0dcaf0;
                --dark: #212529;
                --light: #f8f9fa;
            }

            .dashboard-card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                transition: all 0.3s ease;
                overflow: hidden;
                background: white;
                height: 100%;
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            }

            .card-icon-wrapper {
                width: 60px;
                height: 60px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.75rem;
                color: white;
                flex-shrink: 0;
            }

            .card-value {
                font-size: 1.75rem;
                font-weight: 700;
                line-height: 1.2;
                color: var(--dark);
            }

            .card-label {
                font-size: 0.875rem;
                color: #6c757d;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                font-weight: 600;
            }

            .stat-card {
                border-left: 4px solid var(--primary);
                padding-left: 1rem;
            }

            .chart-container {
                position: relative;
                height: 300px;
            }

            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 50rem;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .list-item {
                transition: all 0.3s ease;
                border-left: 3px solid transparent;
                background-color: #f8f9fa;
                border-radius: 0.5rem;
            }

            .list-item:hover {
                transform: translateX(5px);
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
                background-color: #e7f1ff;
                border-left-color: var(--primary);
            }

            .recent-list::-webkit-scrollbar {
                width: 6px;
            }

            .recent-list::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .recent-list::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }

            .recent-list::-webkit-scrollbar-thumb:hover {
                background: #a8a8a8;
            }

            .text-gradient {
                background: linear-gradient(135deg, var(--primary), #0a58ca);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .progress-custom {
                height: 8px;
                border-radius: 4px;
            }

            .section-header {
                padding: 20px 0;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .breadcrumb-item.active {
                color: var(--primary);
            }

            .icon-bg-primary {
                background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            }

            .icon-bg-success {
                background: linear-gradient(135deg, #198754 0%, #157347 100%);
            }

            .icon-bg-warning {
                background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            }

            .icon-bg-info {
                background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
            }

            .icon-bg-danger {
                background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
            }

            .icon-bg-purple {
                background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
            }

            .document-icon {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
                color: white;
                flex-shrink: 0;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Dashboard BOSS</h1>
                        <p class="mb-0 text-muted">Sistem Bantaeng Office Smart Service - Pusat Data dan Dokumen Administrasi</p>
                    </div>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><i class="bi bi-house-door"></i> Dashboard</div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon-wrapper icon-bg-primary me-3">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div>
                                    <div class="card-label">Total Dokumen</div>
                                    <div class="card-value">{{ number_format($totalDokumen) }}</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-arrow-up text-success"></i>
                                    {{ $dokumenBaru }} dokumen baru bulan ini
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon-wrapper icon-bg-success me-3">
                                    <i class="bi bi-folder2-open"></i>
                                </div>
                                <div>
                                    <div class="card-label">Total Kategori</div>
                                    <div class="card-value">{{ number_format($totalKategori) }}</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-grid"></i>
                                    {{ $kategoriAktif }} kategori aktif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon-wrapper icon-bg-warning me-3">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <div class="card-label">Total Pengguna</div>
                                    <div class="card-value">{{ number_format($totalUsers) }}</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-person-plus"></i>
                                    {{ $userBaru }} pengguna baru
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon-wrapper icon-bg-info me-3">
                                    <i class="bi bi-arrow-repeat"></i>
                                </div>
                                <div>
                                    <div class="card-label">Versi Dokumen</div>
                                    <div class="card-value">{{ number_format($totalVersi) }}</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-file-earmark-arrow-up"></i>
                                    {{ $dokumenRevisi }} dokumen revisi
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Summary -->
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Status Dokumen</p>
                                    <div class="d-flex gap-3 mt-2">
                                        <div>
                                            <span class="status-badge bg-success text-white">Aktif</span>
                                            <span class="fw-bold ms-1">{{ $dokumenAktif }}</span>
                                        </div>
                                        <div>
                                            <span class="status-badge bg-warning text-dark">Pending</span>
                                            <span class="fw-bold ms-1">{{ $dokumenPending }}</span>
                                        </div>
                                        <div>
                                            <span class="status-badge bg-danger text-white">Arsip</span>
                                            <span class="fw-bold ms-1">{{ $dokumenArsip }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-primary" style="width: 50px; height: 50px;">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Dokumen per Kategori</p>
                                    <div class="mt-2">
                                        @foreach($topKategori as $kategori)
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <small>{{ Str::limit($kategori->nama, 20) }}</small>
                                                <small class="fw-bold">{{ $kategori->dokumen_count }}</small>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-success" style="width: 50px; height: 50px;">
                                    <i class="bi bi-tags"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="dashboard-card card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Aktivitas Terbaru</p>
                                    <div class="mt-2">
                                        <small class="d-block">
                                            <i class="bi bi-upload text-success"></i>
                                            {{ $uploadBulanIni }} upload bulan ini
                                        </small>
                                        <small class="d-block mt-1">
                                            <i class="bi bi-download text-info"></i>
                                            {{ $downloadBulanIni }} download bulan ini
                                        </small>
                                        <small class="d-block mt-1">
                                            <i class="bi bi-eye text-primary"></i>
                                            {{ $viewBulanIni }} views bulan ini
                                        </small>
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-info" style="width: 50px; height: 50px;">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row mb-4">
                <div class="col-lg-8 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tren Upload Dokumen</h6>
                            <div class="d-flex">
                                <select id="yearSelect" class="form-control form-control-sm">
                                    @foreach(range(date('Y') - 2, date('Y')) as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="documentTrendChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Distribusi Kategori</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height: 250px;">
                                <div id="categoryChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Distribusi Status Dokumen</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="statusChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Top Pengunggah Dokumen</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="topUsersChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Documents & Activities -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Dokumen Terbaru</h6>
                            <a href="{{ route('dokumen.index') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-list-ul"></i> Lihat Semua
                            </a>
                        </div>
                        <div class="card-body recent-list" style="max-height: 400px; overflow-y: auto;">
                            @forelse($recentDocuments as $dokumen)
                                <div class="list-item mb-3 p-3">
                                    <div class="d-flex align-items-start">
                                        <div class="document-icon bg-primary me-3">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="font-weight-bold mb-1">{{ $dokumen->judul }}</h6>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-tag"></i> {{ $dokumen->kategori->nama ?? 'Tanpa Kategori' }}
                                            </small>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-person"></i> {{ $dokumen->user->name ?? 'Unknown' }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i> 
                                                {{ Carbon\Carbon::parse($dokumen->tanggal_dokumen)->format('d M Y') }}
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <span class="status-badge 
                                                @if($dokumen->status == 'aktif') bg-success text-white
                                                @elseif($dokumen->status == 'pending') bg-warning text-dark
                                                @else bg-danger text-white @endif">
                                                {{ ucfirst($dokumen->status) }}
                                            </span>
                                            @if($dokumen->versi > 1)
                                                <br>
                                                <small class="text-muted">v{{ $dokumen->versi }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-file-earmark-x text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Belum ada data dokumen</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Statistik Dokumen per Bulan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Upload</th>
                                            <th>Revisi</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthlyStats as $stat)
                                            <tr>
                                                <td>{{ $stat['month'] }}</td>
                                                <td>
                                                    <span class="badge bg-success">{{ $stat['uploads'] }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">{{ $stat['revisions'] }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $stat['total'] }}</strong>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Version Distribution -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Distribusi Versi Dokumen</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="versionChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>

        <script>
            // Document Trend Chart
            var trendChart = new ApexCharts(document.querySelector("#documentTrendChart"), {
                series: [{
                    name: 'Upload Dokumen',
                    data: @json($monthlyUploads)
                }],
                chart: {
                    type: 'area',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#0d6efd'],
                fill: {
                    gradient: {
                        enabled: true,
                        opacityFrom: 0.7,
                        opacityTo: 0.1
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 4
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: @json($monthLabels),
                    title: {
                        text: 'Bulan'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Dokumen'
                    },
                    min: 0
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " dokumen"
                        }
                    }
                }
            });
            trendChart.render();

            // Category Chart
            var categoryData = @json($categoryData);
            var categoryLabels = @json($categoryLabels);
            
            var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), {
                series: categoryData,
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: categoryLabels,
                colors: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#0dcaf0', '#6f42c1'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                }
            });
            categoryChart.render();

            // Status Chart
            var statusChart = new ApexCharts(document.querySelector("#statusChart"), {
                series: [{{ $dokumenAktif }}, {{ $dokumenPending }}, {{ $dokumenArsip }}],
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: ['Aktif', 'Pending', 'Arsip'],
                colors: ['#198754', '#ffc107', '#dc3545'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });
            statusChart.render();

            // Top Users Chart
            var topUsersChart = new ApexCharts(document.querySelector("#topUsersChart"), {
                series: [{
                    name: 'Jumlah Dokumen',
                    data: @json($topUsersData)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#0d6efd'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + " dokumen"
                    }
                },
                xaxis: {
                    categories: @json($topUsersLabels),
                    title: {
                        text: 'Jumlah Dokumen'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Pengguna'
                    }
                }
            });
            topUsersChart.render();

            // Version Distribution Chart
            var versionChart = new ApexCharts(document.querySelector("#versionChart"), {
                series: [{
                    name: 'Jumlah Dokumen',
                    data: @json($versionData)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: true
                    }
                },
                colors: ['#6f42c1'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '60%',
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + " dokumen"
                    }
                },
                xaxis: {
                    categories: @json($versionLabels),
                    title: {
                        text: 'Versi Dokumen'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Dokumen'
                    }
                }
            });
            versionChart.render();

            // Year filter
            $('#yearSelect').change(function() {
                const year = $(this).val();
                window.location.href = "{{ route('dashboard') }}?year=" + year;
            });
        </script>
    @endpush
@endsection