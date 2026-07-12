<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jelajah Villa - RSR App</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS Custom -->
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="bg-light" style="font-family: 'Poppins', sans-serif;">

<div class="d-flex min-vh-100">
  <!-- Sidebar -->
  @include('user.sidebar')

  <!-- Main Content -->
  <main class="flex-grow-1">
    <!-- Header -->
    <header class="border-bottom p-4 bg-white">
      <h2 class="fw-semibold">Temukan Villa Impian Anda 👋</h2>
      <p class="text-muted">Pilih kenyamanan terbaik untuk liburan Anda.</p>
    </header>

    <!-- Body -->
    <section class="p-4">
      <div class="row g-4">
        @forelse($villas as $v)
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="{{ asset('storage/' . $v->foto_url) }}" class="card-img-top" alt="{{ $v->nama_villa }}">
            <div class="card-body">
              <h4 class="card-title mb-1">{{ $v->nama_villa }}</h4>
              <p class="text-muted small mb-2">📍 {{ $v->lokasi }}</p>
              <p class="fw-bold text-primary fs-5">
                Rp {{ number_format($v->harga ?? 0, 0, ',', '.') }}
                <span class="fw-normal fs-6">/ malam</span>
              </p>
              <a href="{{ route('villas.show', $v->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted">Belum ada villa tersedia saat ini.</p>
        </div>
        @endforelse
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-muted mt-4 border-top pt-3 small">
      © 2026 Jelajah Villa - RSR App
    </footer>
  </main>
</div>

</body>
</html>
