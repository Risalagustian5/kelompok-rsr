<aside class="sidebar">
    <div class="sidebar-brand">
        <h3>RSR APP</h3>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">📊 Dashboard</a>
        </li>
        <li class="{{ request()->is('villas*') ? 'active' : '' }}">
            <a href="{{ route('villas.index') }}">🏡 Jelajah Villa</a>
        </li>
        <li class="{{ request()->is('history') ? 'active' : '' }}">
            <a href="{{ route('history') }}">📋 Riwayat Pesanan</a>
        </li>
        <hr style="border: 0; border-top: 1px solid #334155; margin: 10px 0;">
        <li class="{{ request()->is('profile') ? 'active' : '' }}">
            <a href="{{ route('profile') }}">👤 Profil Saya</a>
        </li>
        <li class="{{ request()->is('tentang') ? 'active' : '' }}">
            <a href="{{ route('tentang') }}">📁 Tentang Kelompok</a>
        </li>
        <li class="{{ request()->is('pengaturan') ? 'active' : '' }}">
            <a href="{{ route('pengaturan') }}">⚙️ Pengaturan</a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">🚪 Keluar</button>
        </form>
    </div>
</aside>