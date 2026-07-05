<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - RSR App</title>
    <link rel="stylesheet" href="{{ asset('css/Pengaturan.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    @include('user.sidebar')

    <main class="main-content">
        <header class="content-header">
            <h2>⚙️ Pengaturan</h2>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <section class="content-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="settings-card">
                <h4>Ganti Password</h4>
                <form action="{{ route('pengaturan.password') }}" method="POST">
                    @csrf

                    @if($errors->any())
                        <div class="alert-error">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" name="current_password">
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="new_password">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation">
                    </div>

                    <button type="submit" class="btn-save">Ubah Password</button>
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