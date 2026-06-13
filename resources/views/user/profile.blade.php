<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/Profile.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="sidebar-brand">
            <h3>RSR App</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">📊 Dashboard</a>
            </li>
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

    <main class="main-content">
        <header class="content-header">
            <h2>👤 Profil Saya</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <section class="content-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="profile-card">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" value="{{ $profile->nim ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" value="{{ $profile->jurusan ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="phone" value="{{ $profile->phone ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Bio</label>
                        <textarea name="bio" rows="3">{{ $profile->bio ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan</button>
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