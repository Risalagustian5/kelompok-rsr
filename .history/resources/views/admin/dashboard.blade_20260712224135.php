<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - SAVIOUR Admin</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Custom override agar tampilan tetap identik seperti versi asli --}}
  <link rel="stylesheet" href="{{ asset('css/admin-bootstrap.css') }}" />
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
        <li class="active">
          <a href="{{ route('admin.dashboard') }}">
            <span class="menu-icon">📊</span> Dashboard
          </a>
        </li>
        <li>
          <a href="{{ route('admin.users') }}">
            <span class="menu-icon">👥</span> Kelola User
          </a>
        </li>
        <li>
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
        <span class="page-icon">📊</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-profile">
        <span>{{ Auth::user()->name }}</span>
        <span class="badge-admin-header">ADMIN</span>
      </div>
    </div>

    <div class="content-body">

      <div class="cards-grid">
        <div class="card">
          <h4>Total User</h4>
          <p>{{ \App\Models\User::count() }}</p>
        </div>
        <div class="card">
          <h4>Admin</h4>
          <p>{{ \App\Models\User::where('role', 'admin')->count() }}</p>
        </div>
        <div class="card">
          <h4>User Aktif</h4>
          <p class="status-active">{{ \App\Models\User::where('role', 'user')->count() }}</p>
        </div>
        <div class="card">
          <h4>Total Villa</h4>
          <p>{{ \App\Models\Villa::count() }}</p>
        </div>
      </div>

      <div class="welcome-box">
        <h3>Selamat Datang, {{ Auth::user()->name }} 👋</h3>
        <p>Ini adalah halaman dashboard SAVIOUR Admin. Kamu dapat mengelola data user, villa, memantau aktivitas sistem, dan mengatur berbagai pengaturan dari sini.</p>
      </div>

    </div>

    <div class="footer">
      © 2026 Kelompok Orang Orang Gantenk!!
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>