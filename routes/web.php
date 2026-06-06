<?php

use Illuminate\Support\Facades\Route;

// Menampilkan halaman login (welcome.blade.php) saat pertama dibuka
Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/login', function () {
    return view('welcome');
});

// Menampilkan halaman register di dalam folder auth
Route::get('/register', function () {
    return view('auth.register'); 
});

// Menampilkan halaman dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});