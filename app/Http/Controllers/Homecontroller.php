<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index()
    {
        // Ambil 3 produk terbaru
        $products = Product::latest()
            ->take(3)
            ->get();

        // Ambil 3 artikel terbaru yang sudah published
        $articles = Article::published()
            ->latest('published_at')
            ->latest('created_at')
            ->take(3)
            ->get();

        return view('index', compact('products', 'articles'));
    }
}