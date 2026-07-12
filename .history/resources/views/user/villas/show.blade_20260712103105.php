<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .detail-container { 
            display: grid; 
            grid-template-columns: 1.5fr 1fr; 
            gap: 30px; 
            margin-top: 20px; 
        }

        .villa-image-large { 
            width: 100%; 
            height: 400px; 
            object-fit: cover; 
            border-radius: 15px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.15); 
        }

        .info-card { 
            background: white; 
            padding: 25px; 
            border-radius: 15px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
        }

        /* Judul villa */
        .villa-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            text-align: left;
            letter-spacing: 0.5px;
        }

        /* Lokasi villa */
        .villa-location {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        .villa-location::before {
            content: "📍";
            margin-right: 6px;
        }

        /* Heading deskripsi */
        .villa-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2563eb;
            margin-bottom: 8px;
            border-left: 4px solid #2563eb;
            padding-left: 8px;
        }

        /* Isi deskripsi */
        .villa-description {
            text-align: justify;
            font-size: 15px;
            color: #374151;
            line-height: 1.7;
            margin-top: 5px;
        }

        .price-tag { 
            font-size: 26px; 
            font-weight: 700; 
            color: #2563eb; 
            margin-bottom: 15px; 
        }

        .btn-booking { 
            width: 100%; 
            background: linear-gradient(90deg, #059669, #10b981); 
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 8px; 
            font-weight: 600; 
            cursor: pointer; 
            margin-top: 10px; 
            transition: background 0.3s ease;
        }
        .btn-booking:hover { background: linear-gradient(90deg, #047857, #059669); }

        @media (max-width: 768px) {
            .detail-container {
                grid-template-columns: 1fr;
            }
            .villa-image-large {
                height: 250px;
            }
            .villa-title {
                text-align: center;
            }
            .villa-location {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="dashboard-wrapper">

    @include('user.sidebar')

    <main class="main-content">
        <header class="content-header">
            <a href="{{ route('villas.index') }}" class="back-link">← Kembali ke Jelajah</a>
            <h2>Detail Villa</h2>
        </header>

        <section class="content-body">
            <div class="detail-container">
                <!-- Kolom kiri: foto + deskripsi -->
                <div>
                    <img src="{{ asset('storage/' . $villa->foto_url) }}" 
                         alt="{{ $villa->nama_villa }}" 
                         class="villa-image-large">

                    <div class="info-card" style="margin-top: 25px;">
                        <h1 class="villa-title">{{ $villa->nama_villa }}</h1>
                        <p class="villa-location">{{ $villa->lokasi }}</p>
                        <hr>
                        <h4 class="villa-section-title">Deskripsi</h4>
                        <p class="villa-description">
                            {{ $villa->deskripsi ?? 'Villa ini memiliki fasilitas lengkap untuk kenyamanan Anda.' }}
                        </p>
                    </div>
                </div>

                <!-- Kolom kanan: harga + form booking -->
                <div>
                    <div class="info-card">
                        <div class="price-tag">
                            Rp {{ number_format($villa->harga ?? 0, 0, ',', '.') }} 
                            <small>/ malam</small>
                        </div>
                        
                        <form action="{{ route('villas.book', $villa->id) }}" method="POST">
                            @csrf 
                            <div class="form-group">
                                <label>Tanggal Check-in</label>
                                <input type="date" name="check_in" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Check-out</label>
                                <input type="date" name="check_out" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Tamu</label>
                                <input type="number" name="jumlah_tamu" min="1" required>
                            </div>
                            <button type="submit" class="btn-booking">Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
