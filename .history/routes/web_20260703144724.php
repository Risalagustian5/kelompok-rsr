<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\VillaController;
use App\Http\Controllers\Api\BookingController;

// ── GUEST ONLY ──────────
Route::middleware('guest')->group(function () {
    Route::get('/',         [AuthController::class, 'showLogin']);
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

// ── LOGOUT ──────────────
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ════════════════════════════════════════════════════
// USER ROUTES (role: user)
// ════════════════════════════════════════════════════
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile',   [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile',  [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/tentang',   [AuthController::class, 'tentangKelompok'])->name('tentang');
    Route::get('/pengaturan',[AuthController::class, 'showPengaturan'])->name('pengaturan');
    Route::post('/pengaturan/password',[AuthController::class, 'updatePassword'])->name('pengaturan.password');

    // Villa (Blade)
    Route::get('/villas',       [VillaController::class, 'index'])->name('villas.index');
    Route::get('/villas/{id}',  [VillaController::class, 'show'])->name('villas.show');

    // Booking (Blade)
    Route::post('/villas/{id}/book',      [VillaController::class, 'storeBooking'])->name('villas.book');
    Route::get('/history',                [VillaController::class, 'historyBooking'])->name('history');
    Route::patch('/bookings/{id}/cancel', [VillaController::class, 'userCancelBooking'])->name('bookings.user.cancel');
});

// ════════════════════════════════════════════════════
// ADMIN ROUTES (role: admin)
// ════════════════════════════════════════════════════
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');

    // Manajemen Users
    Route::get('/users',                        [AuthController::class, 'adminUsers'])->name('users');
    Route::get('/users/{user}/edit',            [AuthController::class, 'adminEditUser'])->name('users.edit');
    Route::put('/users/{user}',                 [AuthController::class, 'adminUpdateUser'])->name('users.update');
    Route::delete('/users/{user}',              [AuthController::class, 'adminDeleteUser'])->name('users.destroy');
    Route::post('/users/{user}/reset-password', [AuthController::class, 'adminResetPassword'])->name('users.reset-password');

    // Manajemen Villa (Blade)
    Route::get('/villas',           [VillaController::class, 'adminIndex'])->name('villas.index');
    Route::get('/villas/create',    [VillaController::class, 'create'])->name('villas.create');
    Route::post('/villas',          [VillaController::class, 'store'])->name('villas.store');
    Route::get('/villas/{id}/edit', [VillaController::class, 'edit'])->name('villas.edit');
    Route::put('/villas/{id}',      [VillaController::class, 'update'])->name('villas.update');
    Route::delete('/villas/{id}',   [VillaController::class, 'destroy'])->name('villas.destroy');

    // Manajemen Pesanan (Booking) menggunakan VillaController
    Route::get('/bookings',               [VillaController::class, 'adminBookings'])->name('bookings.index');
    Route::post('/bookings/{id}/confirm', [VillaController::class, 'confirmBooking'])->name('bookings.confirm');
    Route::patch('/bookings/{id}/cancel', [VillaController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::delete('/bookings/{id}',       [VillaController::class, 'destroyBooking'])->name('bookings.destroy');

    Route::middleware(['auth', 'role:user'])->group(function () {
    // ... (rute dashboard, profile, dll tetap sama)

    // Booking (Arahkan ke BookingController)
    Route::post('/villas/{id}/book',      [VillaController::class, 'storeBooking'])->name('villas.book');
    Route::get('/history',                [BookingController::class, 'historyBooking'])->name('history');
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'userCancelBooking'])->name('bookings.user.cancel');


// ════ ADMIN ROUTES ════
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () 
    // ... (rute dashboard, users, villa tetap sama)

    // Manajemen Pesanan (Booking) - Arahkan ke BookingController
    Route::get('/bookings',               [BookingController::class, 'adminBookings'])->name('bookings.index');
    Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirmBooking'])->name('bookings.confirm');
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::delete('/bookings/{id}',       [BookingController::class, 'destroyBooking'])->name('bookings.destroy');

});