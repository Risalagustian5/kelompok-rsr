<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - RSR App</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS Anda -->
    <link rel="stylesheet" href="{{ asset('css/Pengaturan.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    @include('user.sidebar')

    <!-- Susunan flexbox bawaan Bootstrap menjaga footer tetap berada di bawah secara dinamis -->
    <main class="main-content d-flex flex-column justify-content-between">
        
        <div>
            <!-- Header: Navigasi Flexbox Responsif -->
            <header class="content-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-3 mb-4 border-bottom bg-white">
                <div class="content-header-left d-flex align-items-center gap-2">
                    <span class="page-icon">⚙️</span>
                    <h2 class="h4 fw-semibold text-dark m-0">Pengaturan</h2>
                </div>
                <div class="user-profile bg-white px-3 py-2 rounded-pill shadow-sm fw-medium mt-2 mt-sm-0">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </header>

            <section class="content-body px-4">

                <!-- BOOTSTRAP ALERT NOTIFIKASI SUKSES -->
                @if(session('success'))
                    <div class="alert alert-success alert-custom border-success shadow-sm" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- SETTINGS CARD (FORM GANTI PASSWORD) -->
                <div class="card settings-card border-0 shadow-sm p-4 mx-auto ms-md-0" style="max-width: 500px;">
                    <h4 class="fs-6 fw-bold text-dark mb-4">Ganti Password</h4>
                    
                    <form action="{{ route('pengaturan.password') }}" method="POST">
                        @csrf

                        <!-- BOOTSTRAP ALERT NOTIFIKASI ERROR -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-custom border-danger shadow-sm mb-4" role="alert">
                                @foreach($errors->all() as $error)
                                    <p class="mb-1 last-mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <!-- Form Fields: Struktur Vertikal dengan Gap Presisi -->
                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Password Lama</label>
                            <input type="password" name="current_password" class="form-control custom-input">
                        </div>

                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Password Baru</label>
                            <input type="password" name="new_password" class="form-control custom-input">
                        </div>

                        <div class="mb-4 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control custom-input">
                        </div>

                        <button type="submit" class="btn-save mt-2">Ubah Password</button>
                    </form>
                </div>

            </section>
        </div>

        <!-- Footer -->
        <footer class="footer mt-5">
            <p class="m-0">© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>

</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>