<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<div class="dashboard-wrapper">
    <main class="main-content" style="padding: 20px;">
        <a href="{{ route('villas.index') }}" style="margin-bottom: 20px; display: inline-block;">⬅️ Kembali</a>
        <div class="card" style="padding: 20px; max-width: 800px;">
            <img src="{{ $villa->foto_url }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">
            <h1>{{ $villa->nama_villa }}</h1>
            <p><strong>Lokasi:</strong> {{ $villa->lokasi }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($villa->harga, 0, ',', '.') }}</p>
            <p>{{ $villa->deskripsi }}</p>
            <button onclick="alert('Fitur booking akan segera aktif!')" style="background: #059669; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer;">Pesan Sekarang</button>
        </div>
    </main>
</div>
</body>
</html>