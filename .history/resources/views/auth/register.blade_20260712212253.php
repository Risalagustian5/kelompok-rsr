<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | LaravelKelompok</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/register-bootstrap.css') }}">
</head>

<body>

<div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-auth">

    <div class="card shadow-lg border-0 auth-card">

        <div class="row g-0 h-100">

            <!-- ===========================
                    LEFT PANEL
            ============================ -->

            <div class="col-lg-5 left-panel">

                <div class="left-content">

                    <div class="brand d-flex align-items-center">

                        <div class="brand-icon me-2">

                            <svg width="20" height="20" fill="none" stroke="white"
                                stroke-width="2.5" viewBox="0 0 24 24">

                                <polyline points="20 6 9 17 4 12"/>

                            </svg>

                        </div>

                        <h5 class="text-white fw-bold mb-0">
                            LaravelKelompok
                        </h5>

                    </div>

                    <div class="hero-text">

                        <h1 class="fw-bold text-white">

                            Bergabung <br>
                            bersama kami!

                        </h1>

                        <p>

                            Daftar sekarang dan mulai mengelola proyek
                            kelompok dengan lebih mudah,
                            aman dan profesional.

                        </p>

                    </div>

                    <div class="feature-list">

                        <div class="feature-item">

                            <div class="check-icon">

                                ✓

                            </div>

                            <span>
                                Gratis tanpa biaya
                            </span>

                        </div>

                        <div class="feature-item">

                            <div class="check-icon">

                                ✓

                            </div>

                            <span>

                                Kelola tim kelompok

                            </span>

                        </div>

                        <div class="feature-item">

                            <div class="check-icon">

                                ✓

                            </div>

                            <span>

                                Akses dari mana saja

                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ===========================
                    RIGHT PANEL
            ============================ -->

            <div class="col-lg-7 bg-white">

                <div class="form-wrapper">

                    <div class="team-badge">

                        <span class="badge rounded-pill text-bg-primary px-3 py-2">

                            Kelompok Orang Orang Gantenk

                        </span>

                    </div>

                    <div class="mb-4">

                        <h2 class="fw-bold">

                            Buat Akun Baru

                        </h2>

                        <p class="text-muted">

                            Lengkapi data berikut
                            untuk membuat akun.

                        </p>

                    </div>

                    @if ($errors->any())

                    <div class="alert alert-danger">

                        {{ $errors->first() }}

                    </div>

                    @endif

                    @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                    @endif

                    <form action="{{ route('register') }}" method="POST">

                        @csrf

                        <!-- Nama -->

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama lengkap">

                            @error('name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                            @enderror

                        </div>

                        <!-- Email -->

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="nama@email.com">

                            @error('email')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                            @enderror

                        </div>

                        <!-- Password -->

                        <div class="mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <div class="input-group">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter">
                                    