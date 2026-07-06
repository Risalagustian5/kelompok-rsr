<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Villa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('admin.villas.index') }}" class="btn btn-secondary mb-3">&larr; Kembali</a>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Villa Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.villas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama_villa" class="form-label">Nama Villa</label>
                            <input type="text" name="nama_villa" id="nama_villa" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="harga-input" class="form-label">Harga / Malam (Rp)</label>
                                <input type="text" name="harga" id="harga-input" class="form-control" required placeholder="Contoh: 5.000.000">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Villa</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="form-label">Foto Villa</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Simpan Data Villa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const hargaInput = document.getElementById('harga-input');
    hargaInput.addEventListener('keyup', function(e) {
        let val = this.value.replace(/[^0-9]/g, '');
        this.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
</script>
</body>
</html>