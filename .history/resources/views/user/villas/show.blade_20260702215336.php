<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
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
                        
                        <form action="{{ route('villas.book', $villa->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Check-in</label>
                                <input type="date" name="check_in" required>
                            </div>
                            <div class="form-group">
                                <label>Check-out</label>
                                <input type="date" name="check_out" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Tamu</label>
                                <input type="number" name="jumlah_tamu" min="1" value="1" required>
                            </div>
                            <button type="submit" class="btn-booking">✨ Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
