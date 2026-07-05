<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Panggil file CSS -->
      <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h3>Admin Panel</h3>
        </div>
        <ul class="sidebar-menu">
            <!-- Dropdown Kelola Villa -->
            <li class="dropdown">
                <!-- Checkbox toggle -->
                <input type="checkbox" id="villa-toggle" hidden>
                <label for="villa-toggle" class="dropdown-label">
                    <span class="menu-icon">🏠</span>
                    <span class="menu-text">Kelola Villa</span>
                    <span class="arrow">▼</span>
                </label>
                <ul class="dropdown-menu">
                    <li><a href="#">Tambah Villa</a></li>
                    <li><a href="#">Daftar Villa</a></li>
                    <li><a href="#">Kategori Villa</a></li>
                </ul>
            </li>

            <!-- Menu lain -->
            <li>
                <a href="#">
                    <span class="menu-icon">📋</span>
                    <span class="menu-text">Kelola Pesanan</span>
                </a>
            </li>
        </ul>

        <!-- Tombol logout -->
        <button class="btn-logout">Logout</button>
    </div>
</body>
</html>
