<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tugas Kelompok</title>
    <!-- Memanggil file CSS khusus dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Link font agar makin estetik -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="dashboard-wrapper">
        <!-- 1. SIDEBAR NAVIGASI -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h3>SAVIOUR App</h3>
            </div>
            <ul class="sidebar-menu">
                <li class="active"><a href="#">📊 Dashboard</a></li>
                <li><a href="#">👤 Profil Saya</a></li>
                <li><a href="#">📁 Data Kelompok</a></li>
                <li><a href="#">⚙️ Pengaturan</a></li>
            </ul>
            <div class="sidebar-footer">
                <!-- Tombol Logout -->
                <form action="/" method="GET">
                    @csrf
                    <button type="submit" class="btn-logout">🚪 Keluar</button>
                </form>
            </div>
        </aside>

        <!-- 2. KONTEN UTAMA -->
        <main class="main-content">
            <!-- Header Atas -->
            <header class="content-header">
                <h2>Selamat Datang Kembali! 👋</h2>
                <div class="user-profile">
                    <span>RRS</span>
                </div>
            </header>

            <!-- Area Card Statistik/Informasi -->
            <section class="content-body">
                <div class="cards-grid">
                    <div class="card">
                        <h4>Status Akun</h4>
                        <p class="status-active">Aktif</p>
                    </div>
                    <div class="card">
                        <h4>Aktivitas Terakhir</h4>
                        <p>Baru saja login</p>
                    </div>
                    <div class="card">
                        <h4>Project Kelompok</h4>
                        <p>Progress 75%</p>
                    </div>
                </div>

                <!-- Box Welcome Message -->
                <div class="welcome-box">
                    <h3>Halo, Selamat! Anda Berhasil Masuk 🎉</h3>
                    <p>Ini adalah halaman utama sistem setelah proses autentikasi berhasil. Semua fitur rahasia dan data kelompok kalian sekarang sudah bisa diakses dengan aman di sini.</p>
                </div>
            </section>
        </main>
    </div>

</body>
</html>