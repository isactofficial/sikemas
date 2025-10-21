<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Survey Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/survey', [SurveyController::class, 'show'])->name('survey');
    Route::post('/survey/submit', [SurveyController::class, 'submit'])->name('survey.submit');
});

// Public Routes
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

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});