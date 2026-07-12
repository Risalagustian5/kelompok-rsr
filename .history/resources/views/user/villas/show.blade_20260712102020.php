<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        /* Foto utama villa */
        .villa-image-large { 
            width: 100%; 
            height: 400px; 
            object-fit: cover; 
            border-radius: 15px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }

        .info-card { 
            background: white; 
            padding: 25px; 
            border-radius: 15px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
        }

        .price-tag { 
            font-size: 24px; 
            font-weight: 700; 
            color: #2563eb; 
            margin-bottom: 15px; 
        }

        .btn-booking { 
            width: 100%; 
            background: #059669; 
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 8px; 
            font-weight: 600; 
            cursor: pointer; 
            margin-top: 10px; 
        }

        .btn-booking:hover { background: #047857; }

        .back-link { 
            text-decoration: none; 
            color: #64748b; 
            font-size: 14px; 
            margin-bottom: 20px; 
            display: inline-block; 
        }

        .form-group { margin-bottom: 15px; }
        .form-group label { 
            display: block; 
            font-size: 13px; 
            color: #64748b; 
            margin-bottom: 5px; 
        }
        .form-group input { 
            width: 100%; 
            padding: 8px; 
            border: 1px solid #cbd5e1; 
            border-radius: 6px; 
            box-sizing: border-box; 
        }

        /* Gaya Alert Notifikasi */
        .alert { 
            padding: 12px 15px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            font-size: 14px; 
            font-weight: 500; 
        }
        .alert-success { 
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
        }
        .alert-danger { 
            background-color: #f8d7da; 
            color: #721c24; 
            border: 1px solid #f5c6cb; 
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
            
            @if(session('success'))
                <div class="alert alert-success">
                    🎉 {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <div class="detail-container">
                <!-- Kolom kiri: foto + deskripsi -->
                <div>
                    <img src="{{ asset('storage/' . $villa->foto_url) }}" 
                         alt="{{ $villa->nama_villa }}" 
                         class="villa-image-large">

                    <div class="info-card" style="margin-top: 25px;">
                        <h1>{{ $villa->nama_villa }}</h1>
                        <p>📍 {{ $villa->lokasi }}</p>
                        <hr>
                        <h4>Deskripsi</h4>
                        <p>{{ $villa->deskripsi ?? 'Villa ini memiliki fasilitas lengkap untuk kenyamanan Anda.' }}</p>
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
