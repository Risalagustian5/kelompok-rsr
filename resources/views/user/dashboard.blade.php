<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RSR App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">
    
    @include('user.sidebar')

    <main class="main-content d-flex flex-column justify-content-between">
        <div>
            <!-- Header -->
            <header class="content-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-3 mb-4 border-bottom bg-white">
                <h2 class="h4 fw-semibold text-dark m-0">Selamat Datang Kembali! 👋</h2>
                <div class="user-profile bg-white px-3 py-2 rounded-pill shadow-sm fw-medium mt-2 mt-sm-0">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </header>

            <section class="content-body px-4">
                @if(session('success'))
                    <div class="alert alert-success alert-custom border-success shadow-sm mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Stats Grid Bawaan Bootstrap -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-4">
                    <div class="col">
                        <div class="card h-100 bg-white border-0 p-4 shadow-sm custom-card">
                            <h4 class="text-muted small fw-bold tracking-wider mb-2">Status Akun</h4>
                            <p class="fs-4 fw-semibold m-0 text-success">Aktif</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 bg-white border-0 p-4 shadow-sm custom-card">
                            <h4 class="text-muted small fw-bold tracking-wider mb-2">Aktivitas Terakhir</h4>
                            <p class="fs-5 fw-medium m-0 text-dark">Baru saja login</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 bg-white border-0 p-4 shadow-sm custom-card">
                            <h4 class="text-muted small fw-bold tracking-wider mb-2">Project Kelompok</h4>
                            <p class="fs-5 fw-semibold m-0 text-primary">Progress 75%</p>
                        </div>
                    </div>
                </div>

                <!-- Welcome Box -->
                <div class="welcome-box shadow-sm mb-4">
                    <h3 class="fw-semibold mb-2">Halo, Selamat! Anda Berhasil Masuk 🎉</h3>
                    <p class="fw-light lh-lg opacity-90 m-0">Ini adalah halaman utama sistem setelah proses autentikasi berhasil.</p>
                </div>
            </section>
        </div>

        <footer class="footer mt-5">
            <p class="m-0">© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>