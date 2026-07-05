<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kelola User - SAVIOUR Admin</title>
  <link rel="stylesheet" href="{{ asset('css/ADMIN.css') }}" />
</head>
<body>

<div class="dashboard-wrapper">
  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar">
    <div class="sidebar-brand"><h3>SAVIOUR Admin</h3></div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}"><span class="menu-icon">📊</span> Dashboard</a></li>
        <li class="active"><a href="{{ route('admin.users') }}"><span class="menu-icon">👥</span> Kelola User</a></li>
        <li><a href="{{ route('admin.villas.index') }}"><span class="menu-icon">🏨</span> Kelola Villa</a></li>
    </ul>
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST">@csrf
        <button type="submit" class="btn-logout"><span class="menu-icon">🚪</span> Keluar</button>
      </form>
    </div>
  </aside>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="main-content">
    <!-- HEADER -->
    <div class="content-header">
      <div class="content-header-left">
        <span class="page-icon">👥</span>
        <h2>Kelola Data User</h2>
      </div>
    </div>

    <!-- BODY -->
    <div class="content-body">
      <div class="table-card">
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $index => $u)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>
                  @if($u->role === 'admin')
                    <span class="badge badge-admin">Admin</span>
                  @else
                    <span class="badge badge-user">User</span>
                  @endif
                </td>
                <td class="aksi-col">
                  <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-confirm">Edit</a>
                  
                  <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
      &copy; 2026 SAVIOUR Admin. All rights reserved.
    </div>
  </div>
</div>

</body>
</html>
