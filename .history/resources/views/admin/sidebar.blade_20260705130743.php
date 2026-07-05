<div class="sidebar">
    <div class="sidebar-brand">
        <h3>Admin Panel</h3>
    </div>
    <ul class="sidebar-menu">
        <!-- Dropdown Kelola Villa -->
        <li class="dropdown">
            <input type="checkbox" id="villa-toggle" hidden>
            <label for="villa-toggle" class="dropdown-label">
                <span class="menu-icon">🏠</span>
                <span class="menu-text">Kelola Villa</span>
                <span class="arrow">▼</span> <!-- panah di kanan -->
            </label>
            <ul class="dropdown-menu">
                <li><a href="{{ route('villas.create') }}">Tambah Villa</a></li>
                <li><a href="{{ route('villas.index') }}">Daftar Villa</a></li>
                <li><a href="{{ route('villas.categories') }}">Kategori Villa</a></li>
            </ul>
        </li>

        <!-- Menu lain -->
        <li>
            <a href="{{ route('bookings.index') }}">
                <span class="menu-icon">📋</span>
                <span class="menu-text">Kelola Pesanan</span>
            </a>
        </li>
    </ul>

    <!-- Tombol logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
    </form>
</div>
