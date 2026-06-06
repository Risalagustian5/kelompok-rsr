<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Projek Laravel Kelompok</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 { color: #1e293b; margin-bottom: 0.5rem; font-weight: 700; }
        p { color: #64748b; font-size: 0.875rem; margin-bottom: 2rem; }
        .input-group { text-align: left; margin-bottom: 1.25rem; }
        label { display: block; margin-bottom: 0.5rem; color: #475569; font-size: 0.875rem; font-weight: 600; }
        input {
            width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1;
            border-radius: 0.75rem; box-sizing: border-box; font-size: 0.875rem;
        }
        .btn-login {
            width: 100%; background-color: #2563eb; color: white; border: none;
            padding: 0.75rem; border-radius: 0.75rem; font-size: 1rem;
            font-weight: 600; cursor: pointer; margin-top: 1rem;
        }
        .register-link { margin-top: 1.5rem; font-size: 0.875rem; color: #64748b; }
        .register-link a { color: #2563eb; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    

    <div class="login-card">
        <h2>Selamat Datang</h2>
        <p>Silakan masuk ke akun kelompok kamu</p>
        
        <form action="/dashboard" method="GET">
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
    </div>

</body>
</html>