<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Logika proses login akan ditambahkan nanti
    return redirect('/');
});

Route::get('/beranda', function () {
    return view('index');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/portofolio', function () {
    return view('portofolio');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/profile', function () {
    return redirect('/login');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');