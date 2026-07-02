<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Edit Villa</title>
  <link rel="stylesheet" href="{{ asset('css/ADMIN.css') }}" />
</head>
<body>
<div class="dashboard-wrapper">
  <div class="main-content">
    <div class="table-card" style="padding: 25px; max-width: 700px; margin: 0 auto;">
      <h3>Form Edit Data Villa</h3>
      <form action="{{ route('admin.villas.update', $villa['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
          <label>Nama Villa</label>
          <input type="text" name="nama_villa" value="{{ $villa['nama_villa'] }}" required style="width: 100%; padding: 10px;">
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
          <div style="flex: 1;">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" value="{{ $villa['harga'] }}" required style="width: 100%; padding: 10px;">
          </div>
          <div style="flex: 1;">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $villa['lokasi'] }}" required style="width: 100%; padding: 10px;">
          </div>
        </div>

        <div style="margin-bottom: 15px;">
          <label>Deskripsi</label>
          <textarea name="deskripsi" style="width: 100%; padding: 10px;">{{ $villa['deskripsi'] ?? '' }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
          <label>Foto Saat Ini:</label><br>
          <img src="{{ $villa['foto'] }}" style="width: 150px; margin-bottom: 10px;" onerror="this.src='https://ui-avatars.com/api/?name=Villa';">
          <input type="file" name="foto" style="display: block;">
        </div>

        <button type="submit" style="padding: 10px 20px; background: #f59e0b; color: white; border: none; border-radius: 5px;">Simpan Perubahan</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>