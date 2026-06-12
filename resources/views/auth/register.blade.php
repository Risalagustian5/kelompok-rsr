<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Akun — LaravelKelompok</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/Register.css') }}" />
</head>
<body>

  <div class="auth-wrapper">

    {{-- ===== LEFT PANEL ===== --}}
    <div class="left-panel">
      <div class="left-inner">

        <div class="brand">
          <div class="brand-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
          </div>
          <span>LaravelKelompok</span>
        </div>

        <div class="left-hero">
          <h1>Bergabung<br>bersama kami! <span class="wave">🚀</span></h1>
          <p>Daftar sekarang dan mulai kelola proyek kelompok kamu dengan lebih mudah dan terorganisir.</p>
        </div>

        <ul class="feature-list">
          <li>
            <div class="check-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
            <span>Gratis tanpa biaya apapun</span>
          </li>
          <li>
            <div class="check-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
            <span>Buat & kelola tim kelompok</span>
          </li>
          <li>
            <div class="check-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
            <span>Akses dari mana saja</span>
          </li>
        </ul>

        <div class="blob-circle bc1"></div>
        <div class="blob-circle bc2"></div>
      </div>
    </div>

    {{-- ===== RIGHT PANEL ===== --}}
    <div class="right-panel">
      <div class="right-inner">

        <div class="team-badge">
          <div class="avatars">
            <div class="av av-a">A</div>
            <div class="av av-b">B</div>
            <div class="av av-c">C</div>
          </div>
          <span>Kelompok Orang Orang Gantenk</span>
        </div>

        <div class="form-header">
          <h2>Buat Akun Baru</h2>
          <p>Lengkapi data di bawah untuk mendaftar</p>
        </div>

        @if ($errors->any())
          <div class="alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>{{ $errors->first() }}</span>
          </div>
        @endif

        @if (session('success'))
          <div class="alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        <form action="{{ route('register') }}" method="POST" novalidate>
          @csrf

          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="input-wrap {{ $errors->has('name') ? 'is-error' : '' }}">
              <span class="inp-icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" autocomplete="name" required />
            </div>
            @error('name')<p class="field-err">{{ $message }}</p>@enderror
          </div>

          <div class="form-group">
            <label for="email">Alamat Email</label>
            <div class="input-wrap {{ $errors->has('email') ? 'is-error' : '' }}">
              <span class="inp-icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              </span>
              <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required />
            </div>
            @error('email')<p class="field-err">{{ $message }}</p>@enderror
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap has-toggle {{ $errors->has('password') ? 'is-error' : '' }}">
              <span class="inp-icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              </span>
              <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required />
              <button type="button" class="toggle-pw" id="togglePw" aria-label="Tampilkan password">
                <svg id="eyeIco" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            <div class="strength-bar"><div class="strength-fill" id="sFill"></div></div>
            <p class="strength-label" id="sLabel"></p>
            @error('password')<p class="field-err">{{ $message }}</p>@enderror
          </div>

          <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrap has-toggle">
              <span class="inp-icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              </span>
              <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password kamu" autocomplete="new-password" required />
              <button type="button" class="toggle-pw" id="toggleCf" aria-label="Tampilkan konfirmasi password">
                <svg id="eyeIcoCf" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            <p class="match-label" id="matchLbl"></p>
          </div>

          <div class="form-group" style="margin-bottom:1.25rem;">
            <label class="cb-label">
              <input type="checkbox" name="terms" id="terms" required {{ old('terms') ? 'checked' : '' }} />
              <span>Saya setuju dengan <a href="#" class="inline-link">Syarat &amp; Ketentuan</a></span>
            </label>
          </div>

          <button type="submit" class="btn-primary">
            Daftar Sekarang
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>
        </form>

        <div class="divider"><span>ATAU</span></div>

        <p class="switch-auth">
          Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>

        <p class="copy">&copy; 2026 Kelompok Orang Orang Gantenk!!</p>

      </div>
    </div>

  </div>

  <script>
    function makeToggle(btnId, inputId, iconId) {
      const btn = document.getElementById(btnId);
      const inp = document.getElementById(inputId);
      const ico = document.getElementById(iconId);
      const open = `<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>`;
      const off  = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
      btn.addEventListener('click', () => {
        const show = inp.type === 'password';
        inp.type = show ? 'text' : 'password';
        ico.innerHTML = show ? off : open;
        btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
      });
    }
    makeToggle('togglePw', 'password', 'eyeIco');
    makeToggle('toggleCf', 'password_confirmation', 'eyeIcoCf');

    const pwInp = document.getElementById('password');
    const cfInp = document.getElementById('password_confirmation');
    const fill  = document.getElementById('sFill');
    const slbl  = document.getElementById('sLabel');
    const mlbl  = document.getElementById('matchLbl');

    pwInp.addEventListener('input', () => {
      const v = pwInp.value;
      if (!v) { fill.style.width = '0'; fill.className = 'strength-fill'; slbl.textContent = ''; return; }
      let s = 0;
      if (v.length >= 8) s++;
      if (/[A-Z]/.test(v)) s++;
      if (/[0-9]/.test(v)) s++;
      if (/[^A-Za-z0-9]/.test(v)) s++;
      const map = [
        { w:'25%', cls:'weak',   t:'Lemah' },
        { w:'50%', cls:'fair',   t:'Cukup' },
        { w:'75%', cls:'good',   t:'Bagus' },
        { w:'100%',cls:'strong', t:'Kuat'  },
      ];
      const m = map[Math.max(0, s - 1)];
      fill.style.width = m.w;
      fill.className = 'strength-fill ' + m.cls;
      slbl.textContent = 'Kekuatan: ' + m.t;
      slbl.className = 'strength-label ' + m.cls;
      checkMatch();
    });

    cfInp.addEventListener('input', checkMatch);
    function checkMatch() {
      if (!cfInp.value) { mlbl.textContent = ''; return; }
      if (pwInp.value === cfInp.value) {
        mlbl.textContent = '✓ Password cocok'; mlbl.className = 'match-label match-ok';
      } else {
        mlbl.textContent = '✗ Tidak cocok'; mlbl.className = 'match-label match-err';
      }
    }
  </script>

</body>
</html>