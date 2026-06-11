<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Projek Laravel Kelompok</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="register-container">
        <h2>Daftar Akun</h2>
        <p>Lengkapi data kelompok kalian di bawah ini</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="input-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Masukkan nama lengkap...">
            </div>

            <div class="input-group">
                <label>Alamat Email</label>
                <input type="email" name="email" required placeholder="Contoh: kelompok@email.com">
            </div>

            <div class="input-group">
                <label>Password Baru</label>
                <input type="password" name="password" required placeholder="Buat password minimal 8 karakter">
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
        </div>

        <div class="footer-text">© 2026 Kelompok Orang Orang Gantenk!!</div>
    </div>

</body>
</html>