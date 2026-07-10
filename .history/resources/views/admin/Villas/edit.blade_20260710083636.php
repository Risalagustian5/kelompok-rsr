<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Villa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Form Edit Data Villa</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.villas.update', $villa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Villa</label>
                            <input type="text" name="nama_villa" class="form-control" value="{{ $villa->nama_villa }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="{{ $villa->harga }}" required
                                >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="{{ $villa->lokasi }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $villa->deskripsi }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Foto Saat Ini:</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $villa->foto_url) }}" alt="Foto Villa" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                            <label class="form-label">Ganti Foto (Pilih file untuk mengubah):</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="text" name="harga" id="harga-input" class="form-control" required>
<script>
    const hargaInput = document.getElementById('harga-input');
    hargaInput.addEventListener('keyup', function(e) {
        let val = this.value.replace(/[^0-9]/g, '');
        this.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
</script>
</body>
</html>