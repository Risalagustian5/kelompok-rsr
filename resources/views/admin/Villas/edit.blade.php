<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Villa - SAVIOUR Admin</title>
  <link rel="stylesheet" href="{{ asset('css/ADMIN.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard-wrapper">

  <aside class="sidebar">
    <div>
      <div class="sidebar-brand">
        <h3>SAVIOUR Admin</h3>
      </div>
      <ul class="sidebar-menu">
        <li>
          <a href="{{ route('admin.dashboard') }}">
            <span class="menu-icon">📊</span> Dashboard
          </a>
        </li>
        <li>
          <a href="{{ route('admin.users') }}">
            <span class="menu-icon">👥</span> Kelola User
          </a>
        </li>
        <li class="active">
          <a href="{{ route('admin.villas.index') }}">
            <span class="menu-icon">🏨</span> Kelola Villa
          </a>
        </li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">
          <span>🚪</span> Keluar
        </button>
      </form>
    </div>
  </aside>

  <div class="main-content">

    <div class="content-header">
      <div class="content-header-left">
        <span class="page-icon">✏️</span>
        <h2>Edit Data Villa</h2>
      </div>
      <div class="user-profile">
        <span>{{ Auth::user()->name }}</span>
        <span class="badge-admin-header">ADMIN</span>
      </div>
    </div>

    <div class="content-body">
      <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.villas.index') }}" class="btn" style="background-color: #6b7280; color: white; text-decoration: none; padding: 8px 16px;">⬅️ Kembali ke List</a>
      </div>

      <div class="table-card" style="padding: 25px; max-width: 700px; margin: 0 auto; box-sizing: border-box;">
        <h3 style="margin-top: 0; color: #1f2937; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; font-weight: 600;">Form Edit (Sync Supabase Cloud)</h3>
        
        <form action="{{ route('admin.villas.update', $villa->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
          @csrf
          @method('PUT')

          <div>
            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Nama Villa</label>
            <input type="text" name="nama_villa" value="{{ $villa->nama_villa }}" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-family: 'Poppins';">
          </div>

          <div style="display: flex; gap: 16px;">
            <div style="flex: 1;">
              <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Harga / Malam (Rp)</label>
              <input type="number" name="harga" value="{{ $villa->harga }}" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-family: 'Poppins';">
            </div>
            <div style="flex: 1;">
              <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Lokasi</label>
              <input type="text" name="lokasi" value="{{ $villa->lokasi }}" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-family: 'Poppins';">
            </div>
          </div>

          <div>
            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Deskripsi Villa</label>
            <textarea name="deskripsi" rows="4" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-family: 'Poppins';">{{ $villa->deskripsi }}</textarea>
          </div>

          <div>
            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Foto Villa</label>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px; background: #f9fafb; padding: 10px; border-radius: 6px; border: 1px solid #edf2f7;">
              <img src="{{ $villa->foto_url }}" style="width: 100px; height: 65px; object-fit: cover; border-radius: 6px;">
              <span style="font-size: 12px; color: #6b7280;">Kosongkan file di bawah jika tidak ingin mengganti foto aktif.</span>
            </div>
            <input type="file" name="foto" style="width: 100%; padding: 6px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; background: white;">
          </div>

          <button type="submit" class="btn" style="background-color: #f59e0b; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; font-family: 'Poppins'; margin-top: 10px;">
            Simpan Perubahan & Sync API
          </button>
        </form>

        <div class="footer" style="margin-top: 30px;">
          © 2026 Kelompok Orang Orang Gantenk!!
        </div>
      </div>
    </div>

  </div></div></body>
</html>