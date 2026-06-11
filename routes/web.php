<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/',         [AuthController::class, 'showLogin']);
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',          [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile',            [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile',           [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/Tentang',            [AuthController::class, 'tentangKelompok'])->name('tentang');
    Route::get('/pengaturan',         [AuthController::class, 'showPengaturan'])->name('pengaturan');
    Route::post('/pengaturan/password',[AuthController::class, 'updatePassword'])->name('pengaturan.password');
});