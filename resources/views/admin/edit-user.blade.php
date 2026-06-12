<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - SAVIOUR App</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="sidebar-brand"><h3>SAVIOUR Admin</h3></div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}">📊 Dashboard</a></li>
            <li class="active"><a href="{{ route('admin.users') }}">👥 Kelola User</a></li>
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
            <h2>✏️ Edit User</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
                <span style="background:#ef4444;color:white;padding:2px 8px;border-radius:12px;font-size:11px;margin-left:8px;">ADMIN</span>
            </div>
        </header>

        <section class="content-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form Edit Data User --}}
            <div class="profile-card" style="max-width:600px;margin-bottom:30px;">
                <h4 style="margin-bottom:20px;font-size:16px;font-weight:600;padding-bottom:12px;border-bottom:1px solid #e5e7eb;">
                    Data Akun
                </h4>
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="alert-error">
                            @foreach($errors->all() as $e)
                                <p>{{ $e }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role"
                            style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;font-family:'Poppins',sans-serif;">
                            <option value="user"  {{ $user->role === 'user'  ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="btn-save">Simpan</button>
                        <a href="{{ route('admin.users') }}"
                            style="background:#6b7280;color:white;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            {{-- Form Reset Password --}}
            <div class="profile-card" style="max-width:600px;">
                <h4 style="margin-bottom:20px;font-size:16px;font-weight:600;padding-bottom:12px;border-bottom:1px solid #e5e7eb;">
                    Reset Password
                </h4>
                <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="new_password" placeholder="Minimal 8 karakter">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation">
                    </div>

                    <button type="submit" class="btn-save"
                        style="background:#ef4444;">
                        Reset Password
                    </button>
                </form>
            </div>

        </section>

        <footer class="footer">
            <p>© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>
</div>
</body>
</html>