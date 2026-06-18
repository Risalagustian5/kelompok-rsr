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
  <aside class="sidebar">
    <div class="sidebar-brand"><h3>SAVIOUR Admin</h3></div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}">📊 Dashboard</a></li>
        <li class="active"><a href="{{ route('admin.users') }}">👥 Kelola User</a></li>
        <li><a href="{{ route('admin.villas.index') }}">🏨 Kelola Villa</a></li>
    </ul>
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST">@csrf
        <button type="submit" class="btn-logout"><span>🚪</span> Keluar</button>
      </form>
    </div>
  </aside>

  <div class="main-content">
    <div class="content-header">
      <h2>Kelola Data User</h2>
    </div>

    <div class="content-body">
      <div class="table-card">
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
              <td>{{ $u->role }}</td>
              <td>
                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-edit">Edit</a>
                
                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-hapus">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>