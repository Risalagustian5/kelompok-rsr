li class="dropdown">
        <a href="#">
            <span class="menu-icon">👤</span>
            <span>Kelola User</span>
            <span class="arrow">▼</span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('admin.users.create') }}">Tambah User</a></li>
            <li><a href="{{ route('admin.users.index') }}">Daftar User</a></li>
        </ul>
    </li>
<ul class="sidebar-menu">
    <li class="dropdown">
        <a href="#">
            <span class="menu-icon">🏠</span>
            <span>Kelola Villa</span>
            <span class="arrow">▼</span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#">Tambah Villa</a></li>
            <li><a href="#">Daftar Villa</a></li>
            <li><a href="#">Kategori Villa</a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="menu-icon">📋</span>
            <span>Kelola Pesanan</span>
        </a>
    </li>
</ul>
