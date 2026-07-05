<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .detail-container { display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; margin-top: 20px; }
        .villa-image-large { width: 100%; height: 450px; object-fit: cover; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .info-card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .price-tag { font-size: 24px; font-weight: 700; color: #2563eb; margin-bottom: 15px; }
        .btn-booking { width: 100%; background: #059669; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 10px; }
        .btn-booking:hover { background: #047857; }
        .back-link { text-decoration: none; color: #64748b; font-size: 14px; margin-bottom: 20px; display: inline-block; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; color: #64748b; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
    </style>
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
            <form action="{{ route('logout') }}" method="POST">
                @csrf 
                <button type="submit" class="btn-logout">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="content-header">
            <a href="{{ route('villas.index') }}" class="back-link">← Kembali ke Jelajah</a>
            <h2>Detail Villa</h2>
        </header>

        <section class="content-body">
            <div class="detail-container">
                <div>
                    <img src="{{ $villa->foto ?? 'https://ui-avatars.com/api/?name=Villa&background=random' }}" class="villa-image-large">
                    <div class="info-card" style="margin-top: 25px;">
                        <h1>{{ $villa->nama_villa }}</h1>
                        <p>📍 {{ $villa->lokasi }}</p>
                        <hr>
                        <h4>Deskripsi</h4>
                        <p>{{ $villa->deskripsi ?? 'Villa ini memiliki fasilitas lengkap untuk kenyamanan Anda.' }}</p>
                    </div>
                </div>

                <div>
                    <div class="info-card">
                        <div class="price-tag">Rp {{ number_format($villa->harga ?? 0, 0, ',', '.') }} <small>/ malam</small></div>
                        
                       
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
