<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Projek Laravel Kelompok</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom override agar tampilan tetap identik seperti versi asli --}}
    <link rel="stylesheet" href="{{ asset('css/login-bootstrap.css') }}">
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="page-wrapper d-flex flex-column flex-md-row">

        <div class="brand-side flex-fill d-flex align-items-center">
            <div class="brand-content">
                <div class="brand-logo d-flex align-items-center gap-2 mb-5">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <rect width="36" height="36" rx="10" fill="white" fill-opacity="0.2"/>
                        <path d="M10 18L16 24L26 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>LaravelKelompok</span>
                </div>
                <h1 class="mb-4">Selamat datang<br>kembali! </h1>
                <p class="mb-5">Platform kolaborasi terbaik untuk kelompok belajar kamu. Akses semua proyek dan tugas dalam satu tempat.</p>
                <div class="feature-list d-flex flex-column gap-3">
                    <div class="feature-item d-flex align-items-center gap-3">
                        <div class="feature-icon d-flex align-items-center justify-content-center">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <span>Manajemen proyek kelompok</span>
                    </div>
                    <div class="feature-item d-flex align-items-center gap-3">
                        <div class="feature-icon d-flex align-items-center justify-content-center">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <span>Kolaborasi real-time</span>
                    </div>
                    <div class="feature-item d-flex align-items-center gap-3">
                        <div class="feature-icon d-flex align-items-center justify-content-center">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <span>Pantau perkembangan tugas</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-side flex-fill d-flex align-items-center justify-content-center">
            <div class="login-card">

                <div class="card-header d-flex align-items-center gap-3 mb-4">
                    <div class="avatar-group d-flex">
                        <div class="avatar av1 rounded-circle d-flex align-items-center justify-content-center">R</div>
                        <div class="avatar av2 rounded-circle d-flex align-items-center justify-content-center">S</div>
                        <div class="avatar av3 rounded-circle d-flex align-items-center justify-content-center">R</div>
                    </div>
                    <div class="badge">Kelompok Orang Orang Gantenk</div>
                </div>

                <h2 class="mb-2">Masuk ke Akun</h2>
                <p class="subtitle mb-4">Masukkan kredensial kamu untuk melanjutkan</p>

                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-start gap-2 px-3 py-2 mb-4" role="alert">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error d-flex align-items-start gap-2 px-3 py-2 mb-4" role="alert">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <div>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-wrapper position-relative">
                            <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="label-row d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="form-label mb-0">Password</label>
                            <!-- <a href="#" class="forgot-link">Lupa password?</a> -->
                        </div>
                        <div class="input-wrapper position-relative">
                            <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Tampilkan password">
                                <svg id="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="remember-row mb-4">
                        <label class="checkbox-label d-flex align-items-center gap-2">
                            <input type="checkbox" name="remember">
                            <span class="checkmark d-flex align-items-center justify-content-center"></span>
                            <span>Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login w-100 d-flex align-items-center justify-content-center gap-2">
                        <span>Masuk Sekarang</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>

                </form>

                <div class="divider my-4"><span>atau</span></div>

                <div class="register-link">
                    Belum punya akun? <a href="/register">Daftar sekarang</a>
                </div>

                <div class="footer-text mt-4">© 2026 Kelompok Orang Orang Gantenk!!</div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
                : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
        }
    </script>

</body>
</html>