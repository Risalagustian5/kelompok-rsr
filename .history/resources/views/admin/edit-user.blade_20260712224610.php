<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit User - SAVIOUR Admin</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Custom override agar tampilan tetap identik seperti versi asli --}}
  <link rel="stylesheet" href="{{ asset('css/ADMIN-bootstrap.css') }}" />
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

          <div class="edit-form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
          </div>

          <div class="edit-form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
          </div>

          <div class="edit-form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-select">
              <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
          </div>

          <button type="submit" class="btn-simpan">Simpan Perubahan</button>
          <a href="{{ route('admin.users') }}" class="link-batal">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>