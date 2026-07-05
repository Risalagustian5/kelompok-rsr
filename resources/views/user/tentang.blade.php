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

    @include('user.sidebar')

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
                        <p class="member-name">{{ $a }}</p>
                        <p class="member-jurusan">Sistem Informasi</p>
                        <p class="member-nim">Universitas Al-Ghifari</p>
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