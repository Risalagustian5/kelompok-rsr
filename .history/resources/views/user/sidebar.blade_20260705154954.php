<div class="sidebar">
    <div class="sidebar-brand">
        <h3>RSR App</h3>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <span class="menu-icon">🏠</span>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('bookings.index') }}">
                <span class="menu-icon">📋</span>
                <span class="menu-text">Pesanan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile') }}">
                <span class="menu-icon">👤</span>
                <span class="menu-text">Profil</span>
            </a>
        </li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
    </form>
</div>
