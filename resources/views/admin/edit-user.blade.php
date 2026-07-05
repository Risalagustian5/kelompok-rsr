<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit User - SAVIOUR Admin</title>
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
  </aside>

  <div class="main-content">
    <div class="content-header">
      <h2>Edit Data User</h2>
    </div>

    <div class="content-body" style="padding: 20px;">
      <div class="table-card" style="padding: 20px;">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div style="margin-bottom: 15px;">
            <label>Nama Lengkap</label><br>
            <input type="text" name="name" value="{{ $user->name }}" style="width: 100%; padding: 8px;" required>
          </div>

          <div style="margin-bottom: 15px;">
            <label>Email</label><br>
            <input type="email" name="email" value="{{ $user->email }}" style="width: 100%; padding: 8px;" required>
          </div>

          <div style="margin-bottom: 15px;">
            <label>Role</label><br>
            <select name="role" style="width: 100%; padding: 8px;">
              <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
          </div>

          <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
          <a href="{{ route('admin.users') }}" style="margin-left: 10px; color: #666;">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>