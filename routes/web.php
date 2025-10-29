<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;

// ============================================
// HOME ROUTE
// ============================================
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/edit-design', function () {
    return view('edit-design');
})->name('edit.design');
// ============================================
// GOOGLE OAUTH ROUTES
// ============================================
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// ============================================
// AUTH ROUTES (Public)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// PROTECTED ROUTES (Require Authentication)
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // ======== SURVEY ROUTES ========
    Route::get('/survey', [SurveyController::class, 'show'])->name('survey');
    Route::post('/survey/submit', [SurveyController::class, 'submit'])->name('survey.submit');
    
    // ======== PROFILE ROUTES ========
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        
        // Address Management
        Route::get('/address/create', [ProfileController::class, 'createAddress'])->name('address.create');
        Route::post('/address', [ProfileController::class, 'storeAddress'])->name('address.store');
        Route::get('/address/{id}/edit', [ProfileController::class, 'editAddress'])->name('address.edit');
        Route::put('/address/{id}', [ProfileController::class, 'updateAddress'])->name('address.update');
        Route::delete('/address/{id}', [ProfileController::class, 'deleteAddress'])->name('address.delete');
        
        // Orders
        Route::get('/orders', [ProfileController::class, 'getOrders'])->name('orders');
    });
});

// ============================================
// PUBLIC PAGES
// ============================================
Route::get('/beranda', function () {
    return view('index');
})->name('beranda');

Route::get('/produk', function () {
    return view('produk');
})->name('produk');

Route::get('/artikel', function () {
    return view('artikel');
})->name('artikel');

Route::get('/artikel/{id}', function ($id) {
    return view('detail_artikel', ['id' => $id]);
})->name('detail_artikel');

Route::get('/portofolio', function () {
    return view('portofolio');
})->name('portofolio');

Route::get('/about', function () {
    return view('about');
})->name('about');

// ============================================
// ADMIN ROUTES (Protected)
// ============================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    // Article Management - CRUD (RESOURCE ROUTE)
    Route::resource('articles', ArticleController::class);
    
    // Other Admin Static Pages
    Route::get('/products', function () {
        return view('admin.products');
    })->name('products');

    Route::get('/testimonials', function () {
        return view('admin.testimonials');
    })->name('testimonials');

    Route::get('/transactions', function () {
        return view('admin.transactions');
    })->name('admin.transactions');
});