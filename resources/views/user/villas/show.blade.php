<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">

    @include('user.sidebar')

    <main class="main-content d-flex flex-column justify-content-between">
        <div>
            <!-- Header -->
            <header class="content-header d-flex flex-row justify-content-between align-items-center pb-3 mb-4 border-bottom bg-white">
                <a href="{{ route('villas.index') }}" class="back-link btn-back text-decoration-none">
                    <span class="back-icon">←</span>
                    <span>Kembali ke Jelajah</span>
                </a>
                <h2 class="h4 fw-semibold text-dark m-0 d-none d-sm-block">Detail Villa</h2>
            </header>

            <section class="content-body px-4">
                <!-- Grid Utama Menggunakan Row & Col Bootstrap -->
                <div class="row g-4">
                    <!-- Kolom Kiri: Image & Deskripsi -->
                    <div class="col-100 col-lg-7">
                        <img src="{{ asset('storage/' . $villa->foto_url) }}" alt="{{ $villa->nama_villa }}" class="villa-image-large w-100 img-fluid shadow">
                        
                        <div class="card border-0 shadow-sm p-4 mt-4 custom-card">
                            <h1 class="h3 fw-bold text-dark mb-2">{{ $villa->nama_villa }}</h1>
                            <p class="text-muted mb-3">📍 {{ $villa->lokasi }}</p>
                            <hr class="text-black-50">
                            <h4 class="h6 fw-bold text-primary text-uppercase tracking-wider mb-2">Deskripsi</h4>
                            <p class="text-secondary lh-lg text-justify m-0">
                                {{ $villa->deskripsi ?? 'Villa ini memiliki fasilitas lengkap untuk kenyamanan Anda.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Pricing & Booking Form -->
                    <div class="col-100 col-lg-5">
                        <div class="card border-0 shadow-sm p-4 custom-card">
                            <div class="text-primary fs-3 fw-bold mb-3">
                                Rp {{ number_format($villa->harga ?? 0, 0, ',', '.') }} 
                                <small class="fs-6 text-muted fw-normal">/ malam</small>
                            </div>
                            
                            <form action="{{ route('villas.book', $villa->id) }}" method="POST">
                                @csrf 
                                <div class="mb-3 d-flex flex-column gap-1">
                                    <label class="form-label text-secondary small fw-medium m-0">Tanggal Check-in</label>
                                    <input type="date" name="check_in" class="form-control custom-input" required>
                                </div>
                                <div class="mb-3 d-flex flex-column gap-1">
                                    <label class="form-label text-secondary small fw-medium m-0">Tanggal Check-out</label>
                                    <input type="date" name="check_out" class="form-control custom-input" required>
                                </div>
                                <div class="mb-4 d-flex flex-column gap-1">
                                    <label class="form-label text-secondary small fw-medium m-0">Jumlah Tamu</label>
                                    <input type="number" name="jumlah_tamu" class="form-control custom-input" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-confirm w-100 py-2fw-bold">Pesan Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="footer mt-5">
            <p class="m-0">© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>