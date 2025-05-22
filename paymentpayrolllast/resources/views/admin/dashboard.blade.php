@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid p-0">
    <!-- Sidebar + Main Content Layout -->
    <div class="row g-0">
        <!-- Main Content Area -->
        <div class="col-12">
            <!-- Header Section -->
            <div class="bg-light p-4 mb-4 rounded-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1">
                            <i class="fas fa-tachometer-alt text-primary"></i> 
                            <span class="ms-2">Admin Dashboard</span>
                        </h1>
                        <p class="text-muted mb-0">Selamat datang di sistem manajemen karyawan</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            <i class="fas fa-sync-alt me-1"></i> Refresh
                        </button>
                        <button class="btn btn-sm btn-primary rounded-pill px-3">
                            <i class="fas fa-download me-1"></i> Laporan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Cards in Horizontal Layout -->
            <div class="px-2 mb-4">
                <div class="row g-3">
                    <!-- Card Total Karyawan -->
                    <div class="col-md-3">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex h-100">
                                    <div class="p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(78, 115, 223, 0.1); width: 80px;">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div class="p-3">
                                        <div class="text-xs fw-bold text-uppercase text-muted mb-1">Total Karyawan</div>
                                        <div class="h3 mb-0 fw-bold">{{ \App\Models\Karyawan::count() }}</div>
                                        <a href="{{ route('admin.karyawan.index') }}" class="stretched-link text-decoration-none small">
                                            <span class="text-primary">Lihat Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Hadir Hari Ini -->
                    <div class="col-md-3">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex h-100">
                                    <div class="p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(28, 200, 138, 0.1); width: 80px;">
                                        <i class="fas fa-user-check fa-2x text-success"></i>
                                    </div>
                                    <div class="p-3">
                                        <div class="text-xs fw-bold text-uppercase text-muted mb-1">Hadir Hari Ini</div>
                                        <div class="h3 mb-0 fw-bold">{{ \App\Models\Absensi::whereDate('tanggal', today())->where('status', 'hadir')->count() }}</div>
                                        <a href="{{ route('admin.absensi.rekap') }}" class="stretched-link text-decoration-none small">
                                            <span class="text-success">Lihat Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Izin/Sakit Hari Ini -->
                    <div class="col-md-3">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex h-100">
                                    <div class="p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(246, 194, 62, 0.1); width: 80px;">
                                        <i class="fas fa-user-clock fa-2x text-warning"></i>
                                    </div>
                                    <div class="p-3">
                                        <div class="text-xs fw-bold text-uppercase text-muted mb-1">Izin/Sakit Hari Ini</div>
                                        <div class="h3 mb-0 fw-bold">{{ \App\Models\Absensi::whereDate('tanggal', today())->whereIn('status', ['izin', 'sakit'])->count() }}</div>
                                        <a href="{{ route('admin.absensi.rekap') }}" class="stretched-link text-decoration-none small">
                                            <span class="text-warning">Lihat Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Total Gaji Bulan Ini -->
                    <div class="col-md-3">
                        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex h-100">
                                    <div class="p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(54, 185, 204, 0.1); width: 80px;">
                                        <i class="fas fa-money-bill-wave fa-2x text-info"></i>
                                    </div>
                                    <div class="p-3">
                                        <div class="text-xs fw-bold text-uppercase text-muted mb-1">Total Gaji Bulan Ini</div>
                                        <div class="h5 mb-0 fw-bold">
                                            @php
                                                $totalGaji = \App\Models\Gaji::where('bulan', date('m'))
                                                    ->where('tahun', date('Y'))
                                                    ->sum('gaji_bersih');
                                            @endphp
                                            Rp {{ number_format($totalGaji, 0, ',', '.') }}
                                        </div>
                                        <a href="{{ route('admin.gaji.index') }}" class="stretched-link text-decoration-none small">
                                            <span class="text-info">Lihat Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="px-2 mb-4">
                <div class="card border-0 rounded-4 shadow-sm">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-bolt text-warning me-2"></i> Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body px-4 py-3">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="{{ route('admin.karyawan.create') }}" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 text-center">
                                    <div class="card-body p-3">
                                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(78, 115, 223, 0.1);">
                                            <i class="fas fa-user-plus fa-lg text-primary"></i>
                                        </div>
                                        <h6 class="mb-0 text-dark">Tambah Karyawan</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.absensi.rekap') }}" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 text-center">
                                    <div class="card-body p-3">
                                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(54, 185, 204, 0.1);">
                                            <i class="fas fa-calendar-check fa-lg text-info"></i>
                                        </div>
                                        <h6 class="mb-0 text-dark">Rekap Absensi</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.gaji.index') }}" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 text-center">
                                    <div class="card-body p-3">
                                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(28, 200, 138, 0.1);">
                                            <i class="fas fa-money-bill fa-lg text-success"></i>
                                        </div>
                                        <h6 class="mb-0 text-dark">Data Gaji</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('admin.gaji.hitung') }}" method="POST" class="h-100">
                                    @csrf
                                    <input type="hidden" name="bulan" value="{{ date('m') }}">
                                    <input type="hidden" name="tahun" value="{{ date('Y') }}">
                                    <button type="submit" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 text-center w-100" 
                                            style="background-color: white;"
                                            onclick="return confirm('Hitung gaji untuk bulan {{ date('F Y') }}?')">
                                        <div class="card-body p-3">
                                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(246, 194, 62, 0.1);">
                                                <i class="fas fa-calculator fa-lg text-warning"></i>
                                            </div>
                                            <h6 class="mb-0 text-dark">Hitung Gaji</h6>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Tabs -->
            <div class="px-2 mb-4">
                <div class="card border-0 rounded-4 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <ul class="nav nav-tabs card-header-tabs border-bottom-0" id="dashboardTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-medium" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi" type="button" role="tab" aria-controls="absensi" aria-selected="true">
                                    <i class="fas fa-clock me-2"></i>Absensi Hari Ini
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-medium" id="karyawan-tab" data-bs-toggle="tab" data-bs-target="#karyawan" type="button" role="tab" aria-controls="karyawan" aria-selected="false">
                                    <i class="fas fa-users me-2"></i>Karyawan Baru
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-medium" id="statistik-tab" data-bs-toggle="tab" data-bs-target="#statistik" type="button" role="tab" aria-controls="statistik" aria-selected="false">
                                    <i class="fas fa-chart-bar me-2"></i>Statistik Absensi
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content" id="dashboardTabsContent">
                            <!-- Absensi Tab -->
                            <div class="tab-pane fade show active" id="absensi" role="tabpanel" aria-labelledby="absensi-tab">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover align-middle">
                                        <thead class="table-light text-muted small text-uppercase">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Pulang</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $absensiHariIni = \App\Models\Absensi::with('karyawan.user')
                                                    ->whereDate('tanggal', today())
                                                    ->latest()
                                                    ->limit(10)
                                                    ->get();
                                            @endphp
                                            @forelse($absensiHariIni as $absensi)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle me-3" style="width: 40px; height: 40px;">
                                                                <span class="fw-bold text-primary">{{ substr($absensi->karyawan->user->name, 0, 1) }}</span>
                                                            </div>
                                                            <div class="fw-medium">{{ $absensi->karyawan->user->name }}</div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                                                    <td>{{ $absensi->jam_pulang ?? '-' }}</td>
                                                    <td>
                                                        <span class="badge rounded-pill px-3 py-2 {{ $absensi->status == 'hadir' ? 'bg-success-subtle text-success' : ($absensi->status == 'izin' ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') }}">
                                                            {{ ucfirst($absensi->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-5">
                                                        <div class="py-4">
                                                            <i class="fas fa-calendar-day fa-3x text-muted mb-3"></i>
                                                            <p class="text-muted mb-0">Belum ada data absensi hari ini</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end mt-3">
                                    <a href="{{ route('admin.absensi.rekap') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Karyawan Tab -->
                            <div class="tab-pane fade" id="karyawan" role="tabpanel" aria-labelledby="karyawan-tab">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover align-middle">
                                        <thead class="table-light text-muted small text-uppercase">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Posisi</th>
                                                <th>Tanggal Masuk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $karyawanBaru = \App\Models\Karyawan::with('user')
                                                    ->orderBy('tanggal_masuk', 'desc')
                                                    ->limit(5)
                                                    ->get();
                                            @endphp
                                            @forelse($karyawanBaru as $karyawan)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle me-3" style="width: 40px; height: 40px;">
                                                                <span class="fw-bold text-primary">{{ substr($karyawan->user->name, 0, 1) }}</span>
                                                            </div>
                                                            <div class="fw-medium">{{ $karyawan->user->name }}</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-dark px-3 py-2">{{ $karyawan->posisi }}</span>
                                                    </td>
                                                    <td>{{ $karyawan->tanggal_masuk->format('d/m/Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-5">
                                                        <div class="py-4">
                                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                                            <p class="text-muted mb-0">Belum ada data karyawan</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end mt-3">
                                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Statistik Tab -->
                            <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik-tab">
                                @php
                                    $bulanIni = \App\Models\Absensi::whereMonth('tanggal', date('m'))
                                        ->whereYear('tanggal', date('Y'))
                                        ->selectRaw('status, COUNT(*) as total')
                                        ->groupBy('status')
                                        ->get();
                                    
                                    $totalAbsensi = $bulanIni->sum('total');
                                @endphp
                                
                                @if($totalAbsensi > 0)
                                    <div class="row g-4">
                                        @foreach($bulanIni as $status)
                                            <div class="col-md-3">
                                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                                    <div class="card-body p-4 text-center">
                                                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                                                             style="width: 80px; height: 80px; background-color: {{ $status->status == 'hadir' ? 'rgba(28, 200, 138, 0.1)' : ($status->status == 'izin' ? 'rgba(246, 194, 62, 0.1)' : ($status->status == 'sakit' ? 'rgba(54, 185, 204, 0.1)' : 'rgba(231, 74, 59, 0.1)')) }};">
                                                            <i class="fas {{ $status->status == 'hadir' ? 'fa-user-check' : ($status->status == 'izin' ? 'fa-user-clock' : ($status->status == 'sakit' ? 'fa-procedures' : 'fa-user-times')) }} fa-2x text-{{ $status->status == 'hadir' ? 'success' : ($status->status == 'izin' ? 'warning' : ($status->status == 'sakit' ? 'info' : 'danger')) }}"></i>
                                                        </div>
                                                        <h2 class="fw-bold mb-0">{{ $status->total }}</h2>
                                                        <p class="text-uppercase small fw-bold text-muted mb-3">{{ ucfirst($status->status) }}</p>
                                                        <div class="progress rounded-pill" style="height: 10px;">
                                                            <div class="progress-bar bg-{{ $status->status == 'hadir' ? 'success' : ($status->status == 'izin' ? 'warning' : ($status->status == 'sakit' ? 'info' : 'danger')) }}" 
                                                                 role="progressbar" 
                                                                 style="width: {{ ($status->total / $totalAbsensi) * 100 }}%">
                                                            </div>
                                                        </div>
                                                        <p class="small mt-2 mb-0">{{ round(($status->total / $totalAbsensi) * 100, 1) }}% dari total</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                                        <p class="text-muted mb-0">Belum ada data absensi bulan ini</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto refresh dashboard every 5 minutes
setInterval(function() {
    window.location.reload();
}, 300000);
</script>
@endpush