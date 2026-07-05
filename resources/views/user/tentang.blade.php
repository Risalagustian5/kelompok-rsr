<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kelompok - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/Tentang.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="sidebar-brand">
            <h3>RSR App</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">📊 Dashboard</a>
            </li>
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
            <h2>📁 Tentang Kelompok</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <section class="content-body">

            <div class="welcome-box">
                <h3>Kelompok Risal_Satria_Rif'al 🚀</h3>
                <p>Project Laravel untuk mata kuliah Pemrograman Web. Kelompok ini terdiri dari mahasiswa yang bersemangat belajar teknologi web modern.</p>
            </div>

            <div class="cards-grid">
                @foreach($anggota as $a)
                <div class="member-card">
                    <div class="member-avatar">👤</div>
                    <p class="member-name">{{ $a->name }}</p>
                    <p class="member-jurusan">{{ $a->profile->jurusan ?? 'Jurusan belum diisi' }}</p>
                    <p class="member-nim">NIM: {{ $a->profile->nim ?? '-' }}</p>
                </div>
                @endforeach
            </div>

        </section>

        <footer class="footer">
            <p>© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>

</div>
</body>
</html>