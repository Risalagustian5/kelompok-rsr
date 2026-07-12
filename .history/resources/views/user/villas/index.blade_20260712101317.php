<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Villa - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover { transform: translateY(-5px); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body { padding: 20px; }
        .btn-detail {
            display: block; 
            background: #2563eb; 
            color: white; 
            text-align: center; 
            padding: 10px; 
            border-radius: 8px; 
            text-decoration: none; 
            font-weight: 600;
            margin-top: 15px;
        }
        .btn-detail:hover { background: #1d4ed8; }
    </style>
</head>
<body>

<div class="dashboard-wrapper">

    @include('user.sidebar')

    <main class="main-content">
        <header class="content-header">
            <div>
                <h2>Temukan Villa Impian Anda 👋</h2>
                <p style="color: #64748b;">Pilih kenyamanan terbaik untuk liburan Anda.</p>
            </div>
        </header>

        <section class="content-body">
            <div class="cards-grid">
                @forelse($villas as $v)
                <div class="card">
                  <img src="{{ asset('storage/' . $v->foto_url) }}" 
                        alt="{{ $v->nama_villa }}" 
                        style="max-width:10px; height:5px; border-radius:2px;">

                    <div class="card-body">
                        <h4 style="margin-bottom: 5px;">{{ $v->nama_villa }}</h4>
                        <p style="color: #64748b; font-size: 13px; margin-bottom: 10px;">📍 {{ $v->lokasi }}</p>
                        <p style="font-weight: 700; color: #2563eb; font-size: 18px;">
                            Rp {{ number_format($v->harga ?? 0, 0, ',', '.') }} <span style="font-size: 12px; font-weight: 400;">/ malam</span>
                        </p>
                        <a href="{{ route('villas.show', $v->id) }}" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
                    <p style="color: #64748b;">Belum ada villa tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </section>
    </main>
</div>
</body>
</html>