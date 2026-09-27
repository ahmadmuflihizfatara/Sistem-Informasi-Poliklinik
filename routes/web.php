<?php

use Illuminate\Support\Facades\Route;

// Route Halaman Utama
Route::get('/', function () {
    return view('login');
});

// Route Auth & Profile
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/lupa-password', function () {
    return view('lupa-password');
})->name('password.request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route Logout (Mengarahkan kembali ke Login)
Route::any('/logout', function () {
    return redirect('/login');
})->name('logout');

// Route Fitur & Navigasi Dashboard
Route::get('/laporan-kesehatan', function () {
    return view('dashboard');
})->name('laporan-kesehatan.index');

Route::get('/password-update', function () {
    return redirect('/login');
})->name('password.update');