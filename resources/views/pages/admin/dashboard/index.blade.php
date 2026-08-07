@extends('layouts.app', ['title' => 'Dashboard BOSS'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/pages/admin/dashboard/index.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <!-- Header -->
            <div class="section-header">
                <div class="d-flex justify-content-between align-items-center w-100 flex-wrap gap-3">
                    <div>
                        <h1 class="header-title">Dashboard BOSS</h1>
                        <p class="header-subtitle">
                            <i class="bi bi-clock me-1"></i>
                            Bantaeng Office Smart Service — Pusat Data dan Dokumen Administrasi
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-badge">
                            <i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::now()->format('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-4 col-md-8">
                    <div class="dashboard-card fade-in-up">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <div class="card-label">Total Dokumen</div>
                                    <div class="card-value">{{ number_format($totalDokumen) }}</div>
                                    <div class="stat-footer">
                                        <span class="text-muted">
                                            <i class="bi bi-arrow-up-circle-fill text-success me-1"></i>
                                            {{ $dokumenBaru }} baru bulan ini
                                        </span>
                                        @if($growthPercentage > 0)
                                            <span class="growth-badge up">+{{ $growthPercentage }}%</span>
                                        @elseif($growthPercentage < 0)
                                            <span class="growth-badge down">{{ $growthPercentage }}%</span>
                                        @else
                                            <span class="growth-badge neutral">0%</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-primary">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="dashboard-card fade-in-up">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="card-label mb-3">Aktivitas Terbaru</p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <div class="mini-stat">
                                            <i class="bi bi-upload text-success me-1"></i>
                                            <span class="fw-bold">{{ $uploadBulanIni }}</span>
                                            <span class="text-muted" style="font-size: 11px;">upload bulan ini</span>
                                        </div>
                                        <div class="mini-stat">
                                            <i class="bi bi-calendar-week text-primary me-1"></i>
                                            <span class="fw-bold">{{ $uploadMingguIni }}</span>
                                            <span class="text-muted" style="font-size: 11px;">minggu ini</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <span class="text-muted" style="font-size: 12px;">
                                            <i class="bi bi-clock-history me-1"></i>
                                            Update terakhir: {{ \Carbon\Carbon::now()->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-info" style="width: 48px; height: 48px; font-size: 20px;">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

          

                <div class="col-xl-4 col-md-8  ">
                    <div class="dashboard-card fade-in-up">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <div class="card-label">Total Pengguna</div>
                                    <div class="card-value">{{ number_format($totalUsers) }}</div>
                                    <div class="stat-footer">
                                        <span class="text-muted">
                                            <i class="bi bi-person-plus-fill me-1"></i>
                                            Terdaftar aktif
                                        </span>
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-warning">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Summary -->
            <div class="row g-4 mb-4">
                <div class="col-lg-12">
                    <div class="dashboard-card fade-in-up">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="card-label mb-3">Daftar Dokumen</p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <div class="mini-stat">
                                            <span class="status-badge bg-success">✎ IT & Inteldakim</span>
                                            {{-- <span class="fw-bold ms-2">{{ $dokumenAktif }}</span> --}}
                                        </div>
                                        <div class="mini-stat">
                                            <span class="status-badge bg-warning">✎ Tata Usaha</span>
                                            {{-- <span class="fw-bold ms-2">{{ $dokumenPending }}</span> --}}
                                        </div>
                                        <div class="mini-stat">
                                            <span class="status-badge bg-danger">✎ Verdokjal</span>
                                            {{-- <span class="fw-bold ms-2">{{ $dokumenArsip }}</span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon-wrapper icon-bg-primary" style="width: 48px; height: 48px; font-size: 20px;">
                                    <i class="bi bi-folder"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <div class="dashboard-card chart-card fade-in-up">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6><i class="bi bi-graph-up-arrow text-primary me-2" style="padding: 5px;"></i>Tren Upload Dokumen</h6>
                            <select id="yearSelect" class="form-control form-control-sm" style="width: auto;">
                                @foreach(range(date('Y') - 2, date('Y')) as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="documentTrendChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="dashboard-card chart-card fade-in-up">
                        <div class="card-header">
                            <h6><i class="bi bi-person-circle text-warning me-2" style="padding: 5px;"></i>Top 5 Pengguna Aktif</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height: 250px;">
                                <div id="topUsersChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Documents & Monthly Stats -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="dashboard-card chart-card fade-in-up">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6><i class="bi bi-file-earmark-text text-primary me-2" style="padding: 5px;"></i>Dokumen Terbaru</h6>
                            <a href="{{ route('umkm.index') }}" class="btn btn-primary-custom btn-sm">
                                <i class="bi bi-arrow-right me-1"></i> Lihat Semua
                            </a>
                        </div>
                        <div class="card-body recent-list" style="max-height: 400px; overflow-y: auto;">
                            @forelse($recentDocuments as $dokumen)
                                <div class="list-item">
                                    <div class="d-flex align-items-start">
                                        <div class="document-icon me-3">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </div>
                                        <div class="flex-grow-1 min-w-0">
                                            <div class="list-item-title">{{ Str::limit($dokumen->judul, 50) }}</div>
                                            <div class="list-item-meta">
                                                <span><i class="bi bi-person"></i> {{ $dokumen->user->name ?? 'Unknown' }}</span>
                                                <span><i class="bi bi-clock"></i> {{ Carbon\Carbon::parse($dokumen->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="text-end ms-2 flex-shrink-0">
                                            <span class="status-badge 
                                                @if($dokumen->status == 'aktif') bg-success
                                                @elseif($dokumen->status == 'pending') bg-warning
                                                @else bg-danger @endif">
                                                {{ ucfirst($dokumen->status) }}
                                            </span>
                                            @if($dokumen->versi > 1)
                                                <div class="mt-1">
                                                    <span class="version-badge">v{{ $dokumen->versi }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox text-muted" style="font-size: 48px;"></i>
                                    <p class="text-muted mt-3">Belum ada data dokumen</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="dashboard-card chart-card fade-in-up">
                        <div class="card-header">
                            <h6><i class="bi bi-bar-chart-fill text-success me-2" style="padding: 5px;"></i>Statistik Dokumen 6 Bulan Terakhir</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th class="text-center">Upload</th>
                                            <th class="text-center">Revisi</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthlyStats as $stat)
                                            <tr>
                                                <td><strong>{{ $stat['month'] }}</strong></td>
                                                <td class="text-center">
                                                    <span class="badge-upload">{{ $stat['uploads'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    {{-- <span class="badge-revision">{{ $stat['revisions'] }}</span> --}}
                                                </td>
                                                {{-- <td class="text-end fw-bold">{{ $stat['total'] }}</td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    <i class="bi bi-database-slash me-2"></i>Belum ada data
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
            // Color palette
            const colors = {
                primary: '#4F46E5',
                primaryLight: '#818CF8',
                success: '#10B981',
                warning: '#F59E0B',
                danger: '#EF4444',
                info: '#3B82F6',
                purple: '#8B5CF6'
            };

            // Document Trend Chart
            var trendChart = new ApexCharts(document.querySelector("#documentTrendChart"), {
                series: [{
                    name: 'Upload Dokumen',
                    data: @json($monthlyUploads)
                }],
                chart: {
                    type: 'area',
                    height: '100%',
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                },
                colors: [colors.primary],
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
                    size: 5,
                    colors: ['#fff'],
                    strokeColors: colors.primary,
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                dataLabels: { enabled: false },
                grid: {
                    borderColor: '#F1F5F9',
                    strokeDashArray: 4,
                },
                xaxis: {
                    categories: @json($monthLabels),
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: '#94A3B8'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: '#94A3B8'
                        }
                    },
                    min: 0
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " dokumen"
                        }
                    },
                    theme: 'light',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Inter, sans-serif'
                    }
                }
            });
            trendChart.render();

            // Top Users Chart
            var topUsersData = @json($topUsersData);
            var topUsersLabels = @json($topUsersLabels);
            
            var topUsersChart = new ApexCharts(document.querySelector("#topUsersChart"), {
                series: [{
                    name: 'Jumlah Dokumen',
                    data: topUsersData.length > 0 ? topUsersData : [0]
                }],
                chart: {
                    type: 'bar',
                    height: 250,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                },
                colors: [colors.primary],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: true,
                        barHeight: '45%',
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + " dokumen"
                    },
                    style: {
                        fontSize: '11px',
                        fontWeight: 600,
                        colors: [colors.dark]
                    }
                },
                grid: {
                    borderColor: '#F1F5F9',
                    strokeDashArray: 4,
                },
                xaxis: {
                    categories: topUsersLabels.length > 0 ? topUsersLabels : ['Belum Ada Data'],
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: '#94A3B8'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 600,
                            colors: '#475569'
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " dokumen"
                        }
                    },
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Inter, sans-serif'
                    }
                }
            });
            topUsersChart.render();

            // Year filter
            $('#yearSelect').change(function() {
                const year = $(this).val();
                window.location.href = "{{ route('dashboard') }}?year=" + year;
            });

            // Refresh animation on load
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.fade-in-up');
                cards.forEach((card, index) => {
                    card.style.animationDelay = (index * 0.05) + 's';
                });
            });
        </script>
    @endpush
@endsection
