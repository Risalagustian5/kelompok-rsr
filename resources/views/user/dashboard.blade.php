<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2=family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">
    
    @include('user.sidebar')

    <main class="main-content">
        <header class="content-header">
            <h2>Selamat Datang Kembali! 👋</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <section class="content-body">
            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

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

            <div class="welcome-box">
                <h3>Halo, Selamat! Anda Berhasil Masuk 🎉</h3>
                <p>Ini adalah halaman utama sistem setelah proses autentikasi berhasil.</p>
            </div>
        </section>

        <footer class="footer">
            <p>© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>
</div>

</body>
</html>