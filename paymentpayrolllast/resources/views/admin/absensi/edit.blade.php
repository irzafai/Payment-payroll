@extends('layouts.app')

@section('title', 'Edit Absensi')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Section -->
    <div class="bg-light p-4 mb-4 rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="fas fa-calendar-alt text-primary me-2"></i> Edit Absensi
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.absensi.rekap') }}" class="text-decoration-none">Rekap Absensi</a></li>
                        <li class="breadcrumb-item active">Edit Absensi</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.absensi.rekap') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-header bg-white border-0 pt-4 pb-0">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3" style="width: 48px; height: 48px;">
                    <i class="fas fa-user-edit text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Data Absensi Karyawan</h5>
                    <p class="text-muted small mb-0">Silahkan edit data absensi karyawan di bawah ini</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.absensi.update', $absensi) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Karyawan Info Card -->
                <div class="card bg-light border-0 rounded-4 mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3" style="width: 40px; height: 40px;">
                                        <span class="fw-bold text-primary">{{ substr($absensi->karyawan->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <label class="form-label text-muted small mb-0">Nama Karyawan</label>
                                        <h6 class="mb-0">{{ $absensi->karyawan->user->name }}</h6>
                                        <input type="hidden" value="{{ $absensi->karyawan->user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-circle me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-id-card text-info"></i>
                                    </div>
                                    <div>
                                        <label class="form-label text-muted small mb-0">NIK</label>
                                        <h6 class="mb-0">{{ $absensi->karyawan->nik }}</h6>
                                        <input type="hidden" value="{{ $absensi->karyawan->nik }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Fields -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                id="tanggal" name="tanggal" 
                                value="{{ old('tanggal', $absensi->tanggal->format('Y-m-d')) }}" required>
                            <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" 
                                id="jam_masuk" name="jam_masuk" 
                                value="{{ old('jam_masuk', $absensi->jam_masuk) }}">
                            <label for="jam_masuk">Jam Masuk</label>
                            @error('jam_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" 
                                id="jam_pulang" name="jam_pulang" 
                                value="{{ old('jam_pulang', $absensi->jam_pulang) }}">
                            <label for="jam_pulang">Jam Pulang</label>
                            @error('jam_pulang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 h-100">
                            <div class="card-body p-0">
                                <label for="status" class="form-label fw-medium mb-2">Status <span class="text-danger">*</span></label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_hadir" value="hadir" 
                                            {{ old('status', $absensi->status) == 'hadir' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="status_hadir">
                                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                                <i class="fas fa-user-check me-1"></i> Hadir
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_izin" value="izin" 
                                            {{ old('status', $absensi->status) == 'izin' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_izin">
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                                <i class="fas fa-user-clock me-1"></i> Izin
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_sakit" value="sakit" 
                                            {{ old('status', $absensi->status) == 'sakit' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_sakit">
                                            <span class="badge bg-info-subtle text-info px-3 py-2">
                                                <i class="fas fa-procedures me-1"></i> Sakit
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_tanpa_keterangan" value="tanpa keterangan" 
                                            {{ old('status', $absensi->status) == 'tanpa keterangan' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_tanpa_keterangan">
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                                <i class="fas fa-user-times me-1"></i> Tanpa Keterangan
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating h-100">
                            <textarea class="form-control @error('keterangan') is-invalid @enderror h-100" 
                                    id="keterangan" name="keterangan" style="min-height: 100px;">{{ old('keterangan', $absensi->keterangan) }}</textarea>
                            <label for="keterangan">Keterangan</label>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.absensi.rekap') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Update Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection