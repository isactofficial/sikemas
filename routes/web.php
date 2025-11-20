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
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Admin\FreeConsultationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MessageController;
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
})->middleware('track.page:home')->name('home');


Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/edit-design', function () {
    return view('edit-design');
})->name('edit.design');
// ============================================
// GOOGLE OAUTH ROUTES
// ============================================
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Cart (public index for guest, actions protected)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

Route::middleware(['auth'])->group(function () {
    // Cart Management (mutations require auth)
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'updateItem'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    // Merge guest cart (localStorage) after login
    Route::post('/cart/merge', [CartController::class, 'mergeGuestCart'])->name('cart.merge');

    Route::post('/consultation/request', [ConsultationController::class, 'store'])->name('consultation.request');

    // Checkout
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Invoice
    Route::get('/invoice/{id}', [CartController::class, 'showInvoice'])->name('invoice.show');
});

// ============================================
// ADMIN ROUTES (Protected)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('/', function () {
        $metrics = [
            'articles'     => \App\Models\Article::count(),
            'products'     => \App\Models\Product::count(),
            'testimonies'  => \App\Models\Testimony::count(),
            'transactions' => \App\Models\Order::count(),
        ];

        $totalViewsArticles = (int) \App\Models\Article::sum('views');

        // Page visits aggregation
        $pages = ['home','article','produk','portofolio','about','contact'];
        try {
            $visitTotals = \App\Models\PageVisit::selectRaw('page, SUM(count) as total')
                ->groupBy('page')
                ->pluck('total', 'page');
        } catch (\Throwable $e) {
            $visitTotals = collect();
        }
        $pageVisits = [];
        foreach ($pages as $p) {
            $pageVisits[$p] = (int) ($visitTotals[$p] ?? 0);
        }

        // Homepage breakdown: today, week, month, year
        $today = \Carbon\Carbon::today();
        $startOfWeek = (clone $today)->startOfWeek();
        $startOfMonth = (clone $today)->startOfMonth();
        $startOfYear = (clone $today)->startOfYear();

        $homeToday = $homeWeek = $homeMonth = $homeYear = $totalHomeAllTime = 0;
        try {
            $homeToday = (int) \App\Models\PageVisit::where('page','home')->where('date', $today)->sum('count');
            $homeWeek = (int) \App\Models\PageVisit::where('page','home')->whereBetween('date', [$startOfWeek, $today])->sum('count');
            $homeMonth = (int) \App\Models\PageVisit::where('page','home')->whereBetween('date', [$startOfMonth, $today])->sum('count');
            $homeYear = (int) \App\Models\PageVisit::where('page','home')->whereBetween('date', [$startOfYear, $today])->sum('count');
            $totalHomeAllTime = (int) \App\Models\PageVisit::where('page','home')->sum('count');
        } catch (\Throwable $e) {
            // leave as zeros if table not ready
        }

        $totalVisitsBreakdown = compact('homeToday','homeWeek','homeMonth','homeYear','totalHomeAllTime');

        // Latest content
        $latestArticles = \App\Models\Article::orderByDesc('created_at')->take(3)->get();
        $latestProducts = \App\Models\Product::orderByDesc('created_at')->take(3)->get();

        return view('admin.index', compact(
            'metrics',
            'totalViewsArticles',
            'pageVisits',
            'totalVisitsBreakdown',
            'latestArticles',
            'latestProducts'
        ));
    })->name('index');

    // Article Management - CRUD (RESOURCE ROUTE)
    Route::patch('/articles/{article}/status', [ArticleController::class, 'updateStatus'])
             ->name('articles.updateStatus');
    Route::resource('articles', ArticleController::class)->names('articles');

    // Products CRUD
    Route::resource('products', ProductController::class)->names('products');

    // Testimonies CRUD
    Route::resource('testimonials', TestimonyController::class)->names('testimonials');

    // Transactions CRUD
    Route::resource('transactions', TransactionController::class)->except([
        'create', 'store' // Biasanya admin tidak 'membuat' order, tapi 'mengelola'
    ]);
    // Free Consultations CRUD (Admin)
    Route::resource('free-consultations', FreeConsultationController::class)
        ->only(['index', 'edit', 'update','destroy'])
        ->names('free-consultations');

    // Route Manajemen Pesan
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
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

// Testing error pages (hapus setelah testing)
Route::get('/test-error-419', function () {
    abort(419);
});

Route::get('/test-error-429', function () {
    abort(429);
});

Route::get('/test-error-500', function () {
    abort(500);
});

Route::get('/test-error-502', function () {
    abort(502);
});

Route::get('/test-error-503', function () {
    abort(503);
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
})->middleware('track.page:home')->name('beranda');

use App\Models\Product;
Route::get('/produk', function () {
    $products = Product::query()
        ->orderByDesc('created_at')
        ->get();
    return view('produk', compact('products'));
})->middleware('track.page:produk')->name('produk');

use App\Http\Controllers\ArticlePublicController;
use App\Http\Controllers\CommentController;

Route::get('/artikel', [ArticlePublicController::class, 'index'])->middleware('track.page:article')->name('artikel');
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
})->middleware('track.page:portofolio')->name('portofolio');

Route::get('/about', function () {
    return view('about');
})->middleware('track.page:about')->name('about');

// Route untuk submit rating
Route::post('/submit-rating', [RatingController::class, 'store'])
     ->middleware('auth:web') // Pastikan menggunakan guard 'web' atau 'auth' saja
     ->name('submit.rating');

// Transactions CRUD
Route::resource('transactions', TransactionController::class);

// AJAX endpoint for getting user addresses
Route::get('users/{userId}/addresses', [TransactionController::class, 'getUserAddresses'])
    ->name('users.addresses');
