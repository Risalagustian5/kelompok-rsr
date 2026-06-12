<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ── LOGIN ────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    // ── REGISTER ─────────────────────────────────────
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // default role
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // ── LOGOUT ───────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ════════════════════════════════════════════════
    // USER ROUTES
    // ════════════════════════════════════════════════

    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    // ── PROFIL ───────────────────────────────────────
    public function showProfile()
    {
        $user    = Auth::user();
        $profile = $user->profile;
        return view('user.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'nim'     => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:100',
            'bio'     => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $user->update(['name' => $request->name]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone'   => $request->phone,
                'nim'     => $request->nim,
                'jurusan' => $request->jurusan,
                'bio'     => $request->bio,
            ]
        );

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // ── TENTANG KELOMPOK ─────────────────────────────
    public function tentangKelompok()
    {
        $anggota = User::with('profile')->where('role', 'user')->get();
        return view('user.tentang', compact('anggota'));
    }

    // ── PENGATURAN ───────────────────────────────────
    public function showPengaturan()
    {
        return view('user.pengaturan');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        return back()->with('success', 'Password berhasil diubah!');
    }

    // ════════════════════════════════════════════════
    // ADMIN ROUTES
    // ════════════════════════════════════════════════

    public function adminDashboard()
    {
        $totalUsers  = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $allUsers    = User::with('profile')->latest()->get();

        return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'allUsers'));
    }

    public function adminUsers()
    {
        $users = User::with('profile')->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function adminEditUser(User $user)
    {
        $profile = $user->profile;
        return view('admin.edit-user', compact('user', 'profile'));
    }

    public function adminUpdateUser(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,user',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Data user berhasil diperbarui!');
    }

    public function adminDeleteUser(User $user)
    {
        // Cegah admin hapus akun dirinya sendiri
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'Tidak bisa menghapus akun sendiri.']);
        }

        $user->delete();
        return redirect()->route('admin.users')
            ->with('success', 'User berhasil dihapus!');
    }

    public function adminResetPassword(Request $request, User $user)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password user berhasil direset!');
    }
}