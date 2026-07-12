<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Villa - RSR App</title>
    
    <!-- 1. CDN Bootstrap 5.3 CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    
    <!-- 2. CSS Eksternal Anda (Diletakkan di bawah Bootstrap agar bisa override jika perlu) -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Internal Kustom (Hanya untuk efek hover & tinggi gambar yang tidak ada di Bootstrap) -->
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .card-hover:hover { transform: translateY(-5px); transition: transform 0.3s ease; }
        .img-fixed-height { height: 200px; object-fit: cover; }
    </style>
</head>
<body class="font-poppins bg-light"> <!-- Ditambahkan bg-light untuk latar belakang abu-abu terang standar dashboard -->

<div class="dashboard-wrapper">

    @include('user.sidebar')

    <main class="main-content container-fluid py-4"> <!-- Ditambahkan container & padding vertikal -->
        <header class="content-header mb-4"> <!-- Ditambahkan margin bottom -->
            <div>
                <h2 class="fw-bold">Temukan Villa Impian Anda 👋</h2>
                <p class="text-secondary m-0">Pilih kenyamanan terbaik untuk liburan Anda.</p> <!-- Menggunakan text-secondary untuk warna #64748b -->
            </div>
        </header>

        <section class="content-body">
            <!-- Grid System Bootstrap (Responsif: 1 kolom di HP, 2 kolom di tablet, 3 kolom di desktop kecil, 4 kolom di layar besar) -->
            <div class="row g-4"> 
                @forelse($villas as $v)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <!-- Card Bootstrap -->
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                        <img src="{{ asset('storage/' . $v->foto_url) }}" alt="{{ $v->nama_villa }}" class="card-img-top img-fixed-height">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold text-dark mb-1">{{ $v->nama_villa }}</h5>
                                <p class="card-text text-secondary small mb-3">📍 {{ $v->lokasi }}</p>
                            </div>
                            <div>
                                <p class="card-text fw-bold text-primary fs-5 mb-3">
                                    Rp {{ number_format($v->harga ?? 0, 0, ',', '.') }} <span class="text-secondary fw-normal fs-6">/ malam</span>
                                </p>
                                <a href="{{ route('villas.show', $v->id) }}" class="btn btn-primary w-100 py-2 fw-semibold rounded-3">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Tampilan jika data kosong -->
                <div class="col-12 text-center py-5">
                    <p class="text-secondary fs-5">Belum ada villa tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </section>
    </main>
</div>

<!-- JS Bootstrap (Diperlukan jika sidebar atau komponen Bootstrap lainnya membutuhkan interaksi data-bs-toggle) -->
<script src="https://jsdelivr.net"></script>
</body>
</html>
