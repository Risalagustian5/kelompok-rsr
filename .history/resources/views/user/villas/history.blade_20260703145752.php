<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .table-container { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .bg-warning { background: #fef3c7; color: #92400e; }
        .bg-success { background: #d1fae5; color: #065f46; }
        .bg-cancelled { background: #fee2e2; color: #991b1b; }
        .btn-cancel { background:#f59e0b; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer; font-size:12px; }
        .villa-thumb { width:80px; height:60px; object-fit:cover; border-radius:8px; }
    </style>
</head>
<body>
<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="sidebar-brand"><h3>RSR APP</h3></div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            <li><a href="{{ route('villas.index') }}">🏡 Jelajah Villa</a></li>
            <li class="active"><a href="{{ route('history') }}">📋 Riwayat Pesanan</a></li>
            <li><a href="{{ route('profile') }}">👤 Profil Saya</a></li>
        </ul>
    </aside>
    <main class="main-content">
        <header class="content-header"><h2>Riwayat Pesanan Anda</h2></header>
        <section class="content-body">
            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Villa</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                        <tr>
                            <td>
                                <img src="{{ $b->villa->foto ?? 'https://ui-avatars.com/api/?name=Villa&background=random' }}" 
                                     alt="{{ $b->villa->nama_villa ?? 'Villa' }}" class="villa-thumb">
                            </td>
                            <td>{{ $b->villa->nama_villa ?? '-' }}</td>
                            <td>{{ $b->villa->lokasi ?? '-' }}</td>
                            <td>Rp {{ number_format($b->villa->harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $b['check_in'] }}</td>
                            <td>{{ $b['check_out'] }}</td>
                            <td>
                                <span class="badge 
                                @if($b['status'] == 'pending') bg-warning
@elseif($b['status'] == 'confirmed') bg-success
@elseif($b['status'] == 'cancelled') bg-cancelled
@endif
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td>
                                @if($b->status == 'pending' || $b->status == 'confirmed')
                                    <form action="{{ route('bookings.user.cancel', $b->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn-cancel">Batalkan</button>
                                    </form>
                                @else
                                    ❌ Tidak ada aksi
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" style="text-align: center; padding:20px;">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>
