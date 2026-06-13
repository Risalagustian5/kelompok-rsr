<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - SAVIOUR Admin</title>
  <link rel="stylesheet" href="{{ asset('css/ADMIN.css') }}" />
</head>
<body>

<div class="dashboard-wrapper">

  <!-- SIDEBAR -->
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
      </ul>
    </div>
    <div class="sidebar-footer">
      <button class="btn-logout">
        <span>🚪</span> Keluar
      </button>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="main-content">

    <!-- HEADER -->
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

    <!-- CONTENT -->
    <div class="content-body">

      <!-- CARDS GRID -->
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
          <h4>Jurusan</h4>
         <p>1</p>
        </div>
      </div>

      <!-- WELCOME BOX -->
      <div class="welcome-box">
        <h3>Selamat Datang, {{ Auth::user()->name }} 👋</h3>
        <p>Ini adalah halaman dashboard SAVIOUR Admin. Kamu dapat mengelola data user, memantau aktivitas sistem, dan mengatur berbagai pengaturan dari sini.</p>
      </div>

    </div>

    <div class="footer">
      © 2026 Kelompok Orang Orang Gantenk!!
    </div>

  </div>
</div>

</body>
</html>