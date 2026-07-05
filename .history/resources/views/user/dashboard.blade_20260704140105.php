<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h3>RSR APP</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">📊 Dashboard</a>
            </li>
            <li class="{{ request()->is('villas*') ? 'active' : '' }}">
                <a href="{{ route('villas.index') }}">🏡 Jelajah Villa</a>
            </li>
            <li class="{{ request()->is('history') ? 'active' : '' }}">
                <a href="{{ route('history') }}">📋 Riwayat Pesanan</a>
            </li>
            <hr style="border: 0; border-top: 1px solid #334155; margin: 10px 0;">
            <li class="{{ request()->is('profile') ? 'active' : '' }}">
                <a href="{{ route('profile') }}">👤 Profil Saya</a>
            </li>
            <li class="{{ request()->is('tentang') ? 'active' : '' }}">
                <a href="{{ route('tentang') }}">📁 Tentang Kelompok</a>
            </li>
            <li class="{{ request()->is('pengaturan') ? 'active' : '' }}">
                <a href="{{ route('pengaturan') }}">⚙️ Pengaturan</a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="content-header">
            <h2>Selamat Datang Kembali! 👋</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <section class="content-body">
            @if(session('success'))
                <div style="background: #d1d7fa; color: #a71582; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
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