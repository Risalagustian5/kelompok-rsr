<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Kelola Pesanan - SAVIOUR Admin</title>
  <link rel="stylesheet" href="{{ asset('css/ADMIN.css') }}" />
</head>
<body>
<div class="dashboard-wrapper">
  <aside class="sidebar">
    <div>
      <div class="sidebar-brand"><h3>SAVIOUR Admin</h3></div>
      <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}"><span class="menu-icon">📊</span> Dashboard</a></li>
        <li><a href="{{ route('admin.users') }}"><span class="menu-icon">👥</span> Kelola User</a></li>
        <li><a href="{{ route('admin.villas.index') }}"><span class="menu-icon">🏨</span> Kelola Villa</a></li>
        <li class="active"><a href="{{ route('admin.bookings.index') }}"><span class="menu-icon">📋</span> Kelola Pesanan</a></li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout"><span>🚪</span> Keluar</button>
      </form>
    </div>
  </aside>

  <div class="main-content">
    <div class="content-header"><h2>Manajemen Pesanan</h2></div>
    <div class="content-body">
      @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
      @endif

      <div class="table-card">
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>User</th>
                <th>Email</th>
                <th>Villa</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($bookings as $b)
              <tr>
                <td>{{ $b['user']['name'] ?? 'Unknown User' }}</td>
                <td>{{ $b['user']['email'] ?? '-' }}</td>
                <td>{{ $b['villa']['nama_villa'] ?? '-' }}</td>
                <td>{{ $b['check_in'] ?? '-' }}</td>
                <td>{{ $b['check_out'] ?? '-' }}</td>
                <td>{{ ucfirst($b['status'] ?? '-') }}</td>
                <td class="aksi-buttons">
                  {{-- Tombol Konfirmasi hanya untuk status pending --}}
                  @if(($b['status'] ?? '') === 'pending')
                    <form action="{{ route('admin.bookings.confirm', $b['id']) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-confirm">Konfirmasi</button>
                    </form>
                  @endif

                  {{-- Tombol Cancel hanya untuk status confirmed --}}
                  @if(($b['status'] ?? '') === 'confirmed')
                    <form action="{{ route('admin.bookings.cancel', $b['id']) }}" method="POST">
                      @csrf @method('PATCH')
                      <button type="submit" class="btn btn-cancel">Cancel</button>
                    </form>
                  @endif

                  {{-- Tombol Hapus selalu ada --}}
                  <form action="{{ route('admin.bookings.destroy', $b['id']) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr><td colspan="7" style="text-align:center;">Belum ada pesanan.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
