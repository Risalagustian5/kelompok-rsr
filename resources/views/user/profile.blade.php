<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - RSR App</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS Anda -->
    <link rel="stylesheet" href="{{ asset('css/Profile.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-wrapper">

    @include('user.sidebar')

    <!-- d-flex flex-column menjamin susunan vertikal konten & footer tetap konsisten -->
    <main class="main-content d-flex flex-column justify-content-between">
        
        <div>
            <!-- Header: Navigasi Flexbox Responsif -->
            <header class="content-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-3 mb-4 border-bottom bg-white">
                <h2 class="h4 fw-semibold text-dark m-0">👤 Profil Saya</h2>
                <div class="user-profile bg-white px-3 py-2 rounded-pill shadow-sm fw-medium mt-2 mt-sm-0">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </header>

            <section class="content-body px-4">

                <!-- ALERTS SYSTEM BOOTSTRAP 5 -->
                @if(session('success'))
                    <div class="alert alert-success alert-custom border-success shadow-sm" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-custom border-danger shadow-sm" role="alert">
                        @foreach($errors->all() as $error)
                            <p class="mb-1 last-mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- PROFILE CARD -->
                <div class="card profile-card border-0 shadow-sm p-4 mx-auto ms-md-0" style="max-width: 600px;">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <!-- Form Field: Kolom Input Menggunakan Bootstrap Form-Control -->
                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control custom-input" value="{{ $user->name }}">
                        </div>

                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Email</label>
                            <input type="email" class="form-control custom-input text-muted" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">NIM</label>
                            <input type="text" name="nim" class="form-control custom-input" value="{{ $profile->nim ?? '' }}">
                        </div>

                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control custom-input" value="{{ $profile->jurusan ?? '' }}">
                        </div>

                        <div class="mb-3 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">No. HP</label>
                            <input type="text" name="phone" class="form-control custom-input" value="{{ $profile->phone ?? '' }}">
                        </div>

                        <div class="mb-4 d-flex flex-column gap-1">
                            <label class="form-label text-secondary small fw-medium m-0">Bio</label>
                            <textarea name="bio" class="form-control custom-input" rows="3">{{ $profile->bio ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn-save mt-2">Simpan Perubahan</button>
                    </form>
                </div>

            </section>
        </div>

        <!-- Footer -->
        <footer class="footer mt-5">
            <p class="m-0">© 2026 Kelompok Orang Orang Gantenk!!</p>
        </footer>
    </main>

</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>