<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\TransactionController;

// ============================================
// HOME ROUTE
// ============================================
use App\Models\Article;
Route::get('/', function () {
    $articles = Article::published()
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->take(12)
        ->get();
    return view('index', compact('articles'));
})->name('home');

Route::get('/edit-design', function () {
    return view('edit-design');
})->name('edit.design');
// ============================================
// GOOGLE OAUTH ROUTES
// ============================================
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::middleware(['auth'])->group(function () {
    // Cart Management
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'updateItem'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

    // Checkout
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Invoice
    Route::get('/invoice/{id}', [CartController::class, 'showInvoice'])->name('invoice.show');
});

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
    $articles = Article::published()
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->take(12)
        ->get();
    return view('index', compact('articles'));
})->name('beranda');

use App\Models\Product;
Route::get('/produk', function () {
    $products = Product::query()
        ->orderByDesc('created_at')
        ->get();
    return view('produk', compact('products'));
})->name('produk');

use App\Http\Controllers\ArticlePublicController;
use App\Http\Controllers\CommentController;

Route::get('/artikel', [ArticlePublicController::class, 'index'])->name('artikel');
Route::get('/artikel/{slug}', [ArticlePublicController::class, 'show'])->name('detail_artikel');

// =====================
// COMMENTS (auth only)
// =====================
Route::middleware(['auth'])->group(function () {
    Route::post('/artikel/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/replies', [CommentController::class, 'reply'])->name('comments.reply');
    Route::post('/comments/{comment}/like', [CommentController::class, 'likeComment'])->name('comments.like');
    Route::post('/replies/{reply}/like', [CommentController::class, 'likeReply'])->name('replies.like');
});

use App\Models\Testimony;

Route::get('/portofolio', function () {
    $testimonies = Testimony::orderByDesc('created_at')->get();
    return view('portofolio', compact('testimonies'));
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

    // Products CRUD
    Route::resource('products', ProductController::class)->names('products');

    // Testimonies CRUD
    Route::resource('testimonials', TestimonyController::class)->names('testimonials');

    // Transactions CRUD (BARU)
    Route::resource('transactions', TransactionController::class)->except([
        'create', 'store' // Biasanya admin tidak 'membuat' order, tapi 'mengelola'
    ]);
});
