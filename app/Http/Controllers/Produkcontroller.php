<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        // Ambil semua produk dari database
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('produk', compact('products'));
    }
}