<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes - SI-Poliklinik
|--------------------------------------------------------------------------
*/

// Route Halaman Utama -> arahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ===== Route Auth =====
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    // TODO: ganti dengan logic autentikasi asli (Auth::attempt, dsb.)
    return redirect()->route('dashboard');
});

Route::get('/lupa-password', function () {
    return view('auth.lupa-password');
})->name('password.request');

Route::post('/lupa-password', function (Request $request) {
    // TODO: ganti dengan logic update password asli
    return redirect()->route('login')->with('status', 'Kata sandi berhasil diperbarui.');
})->name('password.update');

Route::post('/logout', function (Request $request) {
    // TODO: ganti dengan logic logout asli (Auth::logout(), session invalidate, dsb.)
    return redirect()->route('login');
})->name('logout');

// ===== Route Dashboard & Profile =====
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/laporan-kesehatan', function () {
    // Sesuaikan dengan view laporan kesehatan yang sudah kamu buat
    return view('laporan-kesehatan.index');
})->name('laporan-kesehatan.index');
