@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 col-lg-6 col-xl-5 py-4">
            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Sistem Manajemen Karyawan</h2>
                <p class="text-muted">Silahkan login untuk melanjutkan</p>
            </div>
            
            <!-- Login Card -->
            <div class="card border-0 shadow overflow-hidden">
                <div class="row g-0">
                    <!-- Left Blue Sidebar -->
                    <div class="col-md-5 bg-primary text-white">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center h-100 p-4">
                            <div class="mb-4">
                                <div class="rounded-circle bg-white bg-opacity-25 p-3 mb-3 mx-auto" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user-shield fa-3x text-white"></i>
                                </div>
                                <h5 class="fw-bold">Selamat Datang</h5>
                            </div>
                            <p class="small mb-0">Masukkan kredensial Anda untuk mengakses dashboard</p>
                        </div>
                    </div>
                    
                    <!-- Right Login Form -->
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                    <i class="fas fa-sign-in-alt text-primary"></i>
                                </div>
                                <h4 class="fw-bold mb-0">Login</h4>
                            </div>
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                            id="email" name="email" value="{{ old('email') }}" 
                                            placeholder="Masukkan email Anda" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="password" class="form-label">Password</label>
                                        <a href="#" class="text-primary small text-decoration-none">Lupa password?</a>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                            id="password" name="password" 
                                            placeholder="Masukkan password Anda" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary rounded-pill py-2">
                                        <i class="fas fa-sign-in-alt me-2"></i> Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-4">
                <p class="text-muted small mb-0">
                    &copy; {{ date('Y') }} Sistem Manajemen Karyawan. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection