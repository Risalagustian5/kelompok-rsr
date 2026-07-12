<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kelompok - RSR App</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS Anda (Untuk animasi, hover sidebar, dan gradient background kustom) -->
    <link rel="stylesheet" href="{{ asset('css/Tentang.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    @include('user.sidebar')

    <!-- Ditambahkan d-flex flex-column agar footer bisa menempel di bawah secara fleksibel -->
    <main class="main-content d-flex flex-column justify-content-between">
        
        <div>
            <!-- Header: Menggunakan Bootstrap flexbox utilities -->
            <header class="content-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-3 mb-4 border-bottom">
                <h2 class="h3 fw-semibold text-dark m-0">📁 Tentang Kelompok</h2>
                <div class="user-profile bg-white px-3 py-2 rounded-pill shadow-sm fw-medium mt-2 mt-sm-0">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </header>

            <section class="content-body">
                <!-- Welcome Box: Properti padding, radius, dan shadow diatur melalui custom CSS Anda -->
                <div class="welcome-box shadow">
                    <h3 class="fw-semibold mb-2">Kelompok Risal_Satria_Rif'al 🚀</h3>
                    <p class="fw-light lh-lg opacity-90 m-0">Project Laravel untuk mata kuliah Pemrograman Web. Kelompok ini terdiri dari mahasiswa yang bersemangat belajar teknologi web modern.</p>
                </div>

                <!-- Grid Anggota: Menggunakan sistem Grid Bootstrap 5 yang sepenuhnya responsif -->
                <!-- Layar HP: 1 kolom | Tablet: 2 kolom | Laptop kecil: 3 kolom | Layar Lebar: 4 kolom -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($anggota as $a)
                        <div class="col">
                            <!-- member-card kustom tetap dipakai untuk efek hover angkat kartu -->
                            <div class="member-card h-100 bg-white shadow-sm rounded-3 text-center p-4">
                                <div class="member-avatar display-5 mb-2 d-inline-block">👤</div>
                                <p class="member-name fs-6 fw-bold text-dark mb-1">{{ $a }}</p>
                                <p class="member-jurusan small text-muted mb-1">Sistem Informasi</p>
                                <p class="member-nim small text-secondary m-0">Universitas Al-Ghifari</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="footer mt-5 py-3 text-center text-muted border-top">
            <p class="small m-0">© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
        
    </main>

</div>

<!-- Bootstrap 5 JavaScript Bundle JS (Opsional, pasang jika membutuhkan komponen interaktif seperti modal/dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>