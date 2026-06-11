<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Projek Laravel Kelompok</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

    <div class="login-card">
        <h2>Selamat Datang</h2>
        <p>Silakan masuk ke akun kelompok kamu</p>

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

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>Alamat Email</label>
                <input type="email" name="email" required placeholder="nama@email.com">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="/register">Daftar sekarang</a>
        </div>

        <div class="footer-text">© 2026 Kelompok Orang Orang Gantenk!!</div>
    </div>

</body>
</html>