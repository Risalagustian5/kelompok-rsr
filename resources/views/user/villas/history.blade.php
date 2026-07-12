<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - RSR App</title>
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
                <h2 class="h4 fw-semibold text-dark m-0 px-2">Riwayat Pesanan Anda</h2>
            </header>
            
            <section class="content-body px-4">
                @if(session('success'))
                    <div class="alert alert-success alert-custom border-success shadow-sm mb-4" role="alert">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <!-- Table Container Card -->
                <div class="card border-0 shadow-sm p-4 table-card">
                    <div class="table-responsive">
                        <table class="table align-middle custom-table m-0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Villa</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $b)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $b->villa->foto_url) }}" 
                                             alt="{{ $b->villa->nama_villa }}" 
                                             class="gambar-pesanan img-thumbnail object-fit-cover shadow-sm">
                                    </td>
                                    <td class="fw-medium text-dark">{{ $b->villa->nama_villa ?? '-' }}</td>
                                    <td class="text-secondary">{{ $b->villa->lokasi ?? '-' }}</td>
                                    <td class="fw-semibold text-primary">Rp {{ number_format($b->villa->harga ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-secondary">{{ $b['check_in'] }}</td>
                                    <td class="text-secondary">{{ $b['check_out'] }}</td>
                                    <td>
                                        <!-- Custom Badge State System -->
                                        <span class="badge custom-badge-state 
                                        @if($b['status'] == 'pending') badge-pending
                                        @elseif($b['status'] == 'confirmed') badge-confirmed
                                        @elseif($b['status'] == 'cancelled') badge-cancelled
                                        @endif">
                                            {{ $b['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center column-gap-2">
                                            @if($b['status'] == 'pending' || $b['status'] == 'confirmed')
                                                <form action="{{ route('bookings.user.cancel', $b['id']) }}" method="POST" class="m-0">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn btn-cancel py-1 px-3">Batalkan</button>
                                                </form>
                                            @else
                                                <span class="text-muted small">❌ No Action</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">Belum ada pesanan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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