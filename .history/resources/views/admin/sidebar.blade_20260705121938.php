<aside class="sidebar">
  <div>
    <div class="sidebar-brand"><h3>SAVIOUR Admin</h3></div>
    <ul class="sidebar-menu">
      <li><a href="{{ route('admin.dashboard') }}"><span class="menu-icon">📊</span> Dashboard</a></li>
      <li><a href="{{ route('admin.users') }}"><span class="menu-icon">👥</span> Kelola User</a></li>
      
      <li>
        <a href="{{ route('admin.villas.index') }}" class="menu-link-flex">
          <span><span class="menu-icon">🏨</span> Kelola Villa</span>
          <span class="arrow-icon">▼</span> </a>
      </li>
      
      <li><a href="{{ route('admin.bookings.index') }}"><span class="menu-icon">📋</span> Kelola Pesanan</a></li>
    </ul>
  </div>
  <div class="sidebar-footer">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout"><span>🚪</span> Keluar</button>
    </form>
  </div>
</aside>