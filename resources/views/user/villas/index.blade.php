<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Villa - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="sidebar-brand"><h3>RSR APP</h3></div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            <li class="active"><a href="{{ route('villas.index') }}">🏡 Jelajah Villa</a></li>
            <li><a href="{{ route('profile') }}">👤 Profil Saya</a></li>
            <li><a href="{{ route('tentang') }}">📁 Tentang Kelompok</a></li>
        </ul>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="btn-logout">🚪 Keluar</button></form>
        </div>
    </aside>

    <main class="main-content">
        <header class="content-header">
            <h2>Temukan Villa Impian Anda 👋</h2>
        </header>

        <section class="content-body">
            <div class="cards-grid">
                @forelse($villas as $v)
                <div class="card" style="padding: 0; overflow: hidden;">
                    <img src="{{ $v->foto_url }}" style="width: 100%; height: 160px; object-fit: cover;">
                    <div style="padding: 15px;">
                        <h4>{{ $v->nama_villa }}</h4>
                        <p style="color: #64748b; font-size: 13px;">📍 {{ $v->lokasi }}</p>
                        <p style="font-weight: 700; color: #2563eb;">Rp {{ number_format($v->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('villas.show', $v->id) }}" style="display: block; background: #2563eb; color: white; text-align: center; padding: 8px; border-radius: 6px; text-decoration: none; margin-top: 10px;">Lihat Detail</a>
                    </div>
                </div>
                @empty
                <p>Belum ada villa tersedia.</p>
                @endforelse
            </div>
        </section>
    </main>
</div>
</body>
</html>