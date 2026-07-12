<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Villa - RSR App</title>
    
    <!-- CDN Bootstrap 5.3 CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    
    <!-- CSS Eksternal Bawaan -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <!-- Font Poppins -->
    <link href="https://googleapis.com" rel="stylesheet">
    
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        /* Memastikan gambar tetap proporsional dan tingginya seragam */
        .img-fixed-height { height: 200px; object-fit: cover; width: 100%; }
        /* Animasi halus saat card di-hover */
        .card-hover { transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    </style>
</head>
<body class="font-poppins bg-light">

<div class="dashboard-wrapper">

    @include('user.sidebar')

    <main class="main-content container-fluid p-4">
        <header class="content-header mb-4">
            <div>
                <h2 class="fw-bold m-0" style="font-size: 24px;">Temukan Villa Impian Anda 👋</h2>
                <p class="text-muted mt-1 small">Pilih kenyamanan terbaik untuk liburan Anda.</p>
            </div>
        </header>

        <section class="content-body">
            <!-- d-flex dan flex-wrap memaksa card berjajar ke samping (horizontal) secara otomatis -->
            <div class="d-flex flex-wrap gap-4">
                @forelse($villas as $v)
                <!-- Mengatur lebar card dasar (300px) dan flex-grow agar responsif di ruang kosong -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden card-hover" style="flex: 1 1 300px; max-width: 340px;">
                    <img src="{{ asset('storage/' . $v->foto_url) }}" alt="{{ $v->nama_villa }}" class="card-img-top img-fixed-height">
                    
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <span class="fw-bold text-dark d-block mb-1" style="font-size: 15px;">{{ $v->nama_villa }}</span>
                            <p class="text-secondary small mb-3">📍 {{ $v->lokasi }}</p>
                        </div>
                        
                        <div>
                            <p class="fw-bold text-primary mb-3" style="font-size: 18px;">
                                Rp {{ number_format($v->harga ?? 0, 0, ',', '.') }} <span class="text-muted fw-normal" style="font-size: 13px;">/ malam</span>
                            </p>
                            <a href="{{ route('villas.show', $v->id) }}" class="btn btn-primary w-100 py-2 fw-semibold rounded-3" style="font-size: 14px;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="w-100 text-center py-5">
                    <p class="text-secondary fs-5">Belum ada villa tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </section>
    </main>
</div>

<!-- JS Bootstrap -->
<script src="https://jsdelivr.net"></script>
</body>
</html>
