<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ── LOGIN & REGISTER ──
    public function showLogin() 
    { 
        return view('auth.login'); 
    }

    public function showRegister() 
    { 
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // default role
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ── USER ROUTES ──
    public function dashboard() 
    { 
        return view('user.dashboard', ['user' => Auth::user()]); 
    }
    
    public function showProfile() 
    { 
        return view('user.profile', ['user' => Auth::user()]); 
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        // UBAH Auth::user()->update(...) MENJADI:
        $request->user()->update(['name' => $request->name]);
        
        return back()->with('success', 'Profil berhasil diupdate!');
    }

    public function tentangKelompok() 
    { 
        $anggota = ['Risal', 'Satria', 'Rifal']; 
        return view('user.tentang', compact('anggota')); 
    }
    
    public function showPengaturan() 
    { 
        return view('user.pengaturan', ['user' => Auth::user()]); 
    }

   public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        
        // PERBAIKAN: Ubah Auth::user()->update(...) menjadi $request->user()->update(...)
        $request->user()->update(['password' => Hash::make($request->password)]);
        
        return back()->with('success', 'Password berhasil diubah!');
    }
    // ── ADMIN ROUTES ──
    public function adminDashboard()
    {
        $totalUsers  = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        return view('admin.dashboard', compact('totalUsers', 'totalAdmins'));
    }

    public function adminUsers()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function adminEditUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
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

        return redirect()->route('admin.users')->with('success', 'Data user berhasil diperbarui!');
    }

    public function adminDeleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'Tidak bisa menghapus akun sendiri.']);
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }
}
