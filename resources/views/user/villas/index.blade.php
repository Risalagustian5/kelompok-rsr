<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Villa - RSR App</title>
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
            <header class="content-header pb-3 mb-4 border-bottom bg-white">
                <div class="px-2">
                    <h2 class="h4 fw-semibold text-dark m-0">Temukan Villa Impian Anda 👋</h2>
                    <p class="text-muted small m-0 mt-1">Pilih kenyamanan terbaik untuk liburan Anda.</p>
                </div>
            </header>

            <section class="content-body px-4">
                <!-- Grid Tampilan Katalog Villa -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse($villas as $v)
                    <div class="col">
                        <div class="card h-100 border-0 bg-white shadow-sm custom-card overflow-hidden">
                           <img src="{{ asset('storage/' . $v->foto_url) }}" alt="{{ $v->nama_villa }}" class="w-100 card-img-top object-fit-cover" style="height: 200px;">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h4 class="h5 fw-bold text-dark mb-1">{{ $v->nama_villa }}</h4>
                                    <p class="text-muted small mb-3">📍 {{ $v->lokasi }}</p>
                                </div>
                                <div>
                                    <p class="fs-5 fw-bold text-primary m-0 mb-3">
                                        Rp {{ number_format($v->harga ?? 0, 0, ',', '.') }} <span class="fs-6 text-muted fw-normal">/ malam</span>
                                    </p>
                                    <a href="{{ route('villas.show', $v->id) }}" class="btn btn-detail w-100 py-2">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- FIX: Tampilan Ketika Data Kosong Berada di Tengah & Memiliki Jarak yang Pas -->
                    <div class="col-12 w-100 text-center py-5 my-4">
                        <div class="p-5 bg-white rounded-3 shadow-sm d-inline-block mx-auto" style="max-width: 500px; width: 100%;">
                            <span class="fs-1 d-block mb-3">🏡</span>
                            <p class="text-muted fs-6 m-0 fw-medium">Belum ada villa tersedia saat ini.</p>
                        </div>
                    </div>
                    @endforelse
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