<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kelola Villa - SAVIOUR Admin</title>
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
        <span class="page-icon">🏨</span>
        <h2>Kelola Data Villa</h2>
      </div>
      <div class="user-profile">
        <span>{{ Auth::user()->name }}</span>
        <span class="badge-admin-header">ADMIN</span>
      </div>
    </div>

    <div class="content-body">

      @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
      @endif

      <div style="margin-bottom: 20px; display: flex; justify-content: flex-end;">
        <a href="{{ route('admin.villas.create') }}" class="btn" style="background-color: #2563eb; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; font-size: 14px;">
          + Tambah Villa Baru
        </a>
      </div>

      <div class="table-card">
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th style="width:40px">No</th>
                <th style="width:140px">Foto (Supabase)</th>
                <th>Nama Villa</th>
                <th>Lokasi</th>
                <th style="width:180px">Harga / Malam</th>
                <th style="width:150px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($villas as $index => $v)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  <img src="{{ $v->foto_url }}" alt="Foto {{ $v->nama_villa }}" style="width: 100px; height: 65px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                </td>
                <td style="font-weight: 600;">{{ $v->nama_villa }}</td>
                <td>
                  <span style="background: #eff6ff; color: #2563eb; font-size: 12px; padding: 4px 10px; border-radius: 50px; font-weight: 500;">
                    📍 {{ $v->lokasi }}
                  </span>
                </td>
                <td style="font-weight: 700; color: #059669;">
                  Rp {{ number_format($v->harga, 0, ',', '.') }}
                </td>
                <td>
                  <div class="aksi-col" style="justify-content: center;">
                    <a href="{{ route('admin.villas.edit', $v->id) }}" class="btn btn-edit" style="background-color: #f59e0b; color: white; text-decoration: none;">Edit</a>
                    
                    <form action="{{ route('admin.villas.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus villa ini, brok?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-hapus">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" style="text-align: center; color: #64748b; padding: 30px;">Belum ada data villa yang tersimpan.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="footer">
          © 2026 Kelompok Orang Orang Gantenk!!
        </div>
      </div>
    </div>

  </div></div></body>
</html>