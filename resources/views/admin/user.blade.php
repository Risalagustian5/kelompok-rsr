<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - SAVIOUR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="sidebar-brand"><h3>SAVIOUR Admin</h3></div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
            </li>
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a href="{{ route('admin.users') }}">👥 Kelola User</a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="content-header">
            <h2>👥 Kelola User</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
                <span style="background:#ef4444;color:white;padding:2px 8px;border-radius:12px;font-size:11px;margin-left:8px;">ADMIN</span>
            </div>
        </header>

        <section class="content-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $e)
                        <p>{{ $e }}</p>
                    @endforeach
                </div>
            @endif

            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span style="background:{{ $u->role === 'admin' ? '#fee2e2' : '#e0e7ff' }};
                                    color:{{ $u->role === 'admin' ? '#991b1b' : '#3730a3' }};
                                    padding:2px 10px;border-radius:12px;font-size:12px;font-weight:600;">
                                    {{ strtoupper($u->role) }}
                                </span>
                            </td>
                            <td>{{ $u->profile->nim ?? '-' }}</td>
                            <td>{{ $u->profile->jurusan ?? '-' }}</td>
                            <td style="text-align:center;">
                                <a href="{{ route('admin.users.edit', $u->id) }}"
                                    style="background:#f59e0b;color:white;padding:5px 12px;border-radius:6px;text-decoration:none;font-size:12px;margin-right:4px;">
                                    Edit
                                </a>
                                @if($u->id !== Auth::id())
                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:#ef4444;color:white;padding:5px 12px;border-radius:6px;border:none;cursor:pointer;font-size:12px;">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div style="margin-top:20px;">
                    {{ $users->links() }}
                </div>
            </div>

        </section>

        <footer class="footer">
            <p>© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>
</div>
</body>
</html>