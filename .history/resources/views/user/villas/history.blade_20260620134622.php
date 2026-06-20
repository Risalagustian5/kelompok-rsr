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
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Villa</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                        <tr>
                            <td>{{ $b->villa->nama_villa }}</td>
                            <td>{{ $b->check_in }}</td>
                            <td>{{ $b->check_out }}</td>
                            <td><span class="badge {{ $b->status == 'pending' ? 'bg-warning' : 'bg-success' }}">{{ ucfirst($b->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align: center;">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>