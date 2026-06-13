<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kelola User - SAVIOUR Admin</title>
  <link rel="stylesheet" href="{{ asset('css/ADMIN.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        <li>
          <a href="{{ route('admin.dashboard') }}">
            <span class="menu-icon">📊</span> Dashboard
          </a>
        </li>
        <li class="active">
          <a href="{{ route('admin.users') }}">
            <span class="menu-icon">👥</span> Kelola User
          </a>
        </li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">
          <span>🚪</span> Keluar
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="main-content">

    <!-- HEADER -->
    <div class="content-header">
      <div class="content-header-left">
        <span class="page-icon">👥</span>
        <h2>Kelola User</h2>
      </div>
      <div class="user-profile">
        <span>{{ Auth::user()->name }}</span>
        <span class="badge-admin-header">ADMIN</span>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="content-body">

      @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif

      <div class="table-card">
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th style="width:40px">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th style="width:90px">Role</th>
                <th style="width:110px">NIM</th>
                <th>Jurusan</th>
                <th style="width:150px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                    {{ strtoupper($user->role) }}
                  </span>
                </td>
                <td>{{ $user->nim ?? '-' }}</td>
                <td>{{ $user->jurusan ?? '-' }}</td>
                <td>
                  <div class="aksi-col">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">Edit</a>
                    @if(Auth::id() !== $user->id)
                      <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-hapus">Hapus</button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="footer">
          © 2026 Kelompok Orang Orang Gantenk!!
        </div>
      </div>
    </div>

  </div><!-- end .main-content -->
</div><!-- end .dashboard-wrapper -->

</body>
</html>