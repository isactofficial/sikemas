<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // <-- PERBAIKAN: Ditambahkan
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf; // <-- DITAMBAHKAN: Import PDF Facade

class CartController extends Controller
{
    /**
     * Show cart page
     */
    public function index()
    {
        // If guest, render the same cart view; items will be populated from localStorage via JS
        if (!Auth::check()) {
            $cart = null;
            $primaryAddress = null;
            return view('cart.index', compact('cart', 'primaryAddress'));
        }

        $user = Auth::user();

        // Get or create cart for user
        $cart = Cart::with('items')->firstOrCreate([
            'user_id' => $user->id
        ]);

        // Get user's primary address
        $primaryAddress = UserAddress::where('user_id', $user->id)
            ->where('is_primary', true)
            ->first();

        // If no primary address, get first address
        if (!$primaryAddress) {
            $primaryAddress = UserAddress::where('user_id', $user->id)->first();
        }

        return view('cart.index', compact('cart', 'primaryAddress'));
    }

    /**
     * Add item to cart
     * (Logika Anda di sini sudah benar, hanya merapikan 'use' statement)
     */
    public function addItem(Request $request)
    {
        // Validasi dari JavaScript Anda sudah benar
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'material' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:100',
            'design' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'product_image' => 'nullable|string|max:255',
            'has_custom_design' => 'required|boolean', // Diperlukan dari JS
            'custom_design_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ai,psd,cdr|max:10240' // max 10MB
        ]);

        $user = Auth::user();
        
        // Get or create cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        
        // Handle custom design file upload
        $customDesignPath = null;
        if ($request->hasFile('custom_design_file')) {
            $file = $request->file('custom_design_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            // Simpan di storage/app/public/custom_designs
            $customDesignPath = $file->storeAs('custom_designs', $filename, 'public');
        }
        
        // Check if item with same specifications already exists
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_name', $validated['product_name'])
            ->where('material', $validated['material'] ?? null)
            ->where('size', $validated['size'] ?? null)
            ->where('design', $validated['design'] ?? null)
            ->where('has_custom_design', $validated['has_custom_design'])
            // Jika tidak ada file custom, kita anggap sama
            ->where(function($query) use ($customDesignPath) {
                if (!$customDesignPath) {
                    $query->whereNull('custom_design_file');
                }
            })
            ->first();
        
        if ($existingItem && !$customDesignPath) { // Hanya update qty jika item ada DAN tidak ada file baru diupload
            // Update quantity if item exists
            $existingItem->quantity += $validated['quantity'];
            $existingItem->save();
            
            return response()->json([
                'success' => true, // Diubah dari 'success' ke 'message' agar konsisten
                'message' => 'Jumlah produk di keranjang berhasil diperbarui!',
                'cart_count' => $cart->total_quantity
            ]);
        }
        
        // Jika itemnya ada TAPI ada file baru, atau itemnya belum ada,
        // buat item baru.
        CartItem::create([
            'cart_id' => $cart->id,
            'product_name' => $validated['product_name'],
            'material' => $validated['material'] ?? null,
            'size' => $validated['size'] ?? null,
            'design' => $validated['design'] ?? null,
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'product_image' => $validated['product_image'] ?? null,
            'has_custom_design' => $validated['has_custom_design'],
            'custom_design_file' => $customDesignPath
        ]);
        
        return response()->json([
            'success' => true, // Diubah dari 'success' ke 'message'
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cart->total_quantity
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function updateItem(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);
        
        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();
        
        $cart = $cartItem->cart;
        
        return response()->json([
            'success' => true,
            'message' => 'Jumlah produk berhasil diperbarui!',
            'subtotal' => $cartItem->formatted_subtotal,
            'cart_total' => $cart->formatted_total,
            'grand_total' => $cart->formatted_grand_total
        ]);
    }

    /**
     * Remove item from cart
     */
    public function removeItem($id)
    {
        $cartItem = CartItem::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);
        
        $cart = $cartItem->cart;

        // Hapus file custom design jika ada
        if ($cartItem->custom_design_file && Storage::disk('public')->exists($cartItem->custom_design_file)) {
            Storage::disk('public')->delete($cartItem->custom_design_file);
        }

        $cartItem->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang!',
            'cart_total' => $cart->formatted_total,
            'grand_total' => $cart->formatted_grand_total,
            'items_count' => $cart->items_count
        ]);
    }

    /**
     * Get cart count (for navbar badge)
     */
    public function getCartCount()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        return response()->json([
            'count' => $cart ? $cart->total_quantity : 0
        ]);
    }

    /**
     * Checkout - create order from cart
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        
        // Get user's cart
        $cart = Cart::with('items')->where('user_id', $user->id)->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong!');
        }
        
        // Get user's primary address
        $address = UserAddress::where('user_id', $user->id)
            ->where('is_primary', true)
            ->first();
        
        if (!$address) {
            $address = UserAddress::where('user_id', $user->id)->first();
        }
        
        if (!$address) {
            return redirect()->route('cart.index')
                ->with('error', 'Silakan tambahkan alamat pengiriman terlebih dahulu!');
        }
        
        DB::beginTransaction();
        
        try {
            // Generate invoice number
            $invoiceNumber = 'INV-' . date('ymd') . '-' . strtoupper(Str::random(6));
            
            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                // 'cart_id' => $cart->id, // Lihat Catatan di bawah
                'invoice_number' => $invoiceNumber,
                'order_date' => now(),
                'total_amount' => $cart->grand_total, // Asumsi grand_total termasuk ongkir
                'status' => 'Diproses', // Status awal
                'payment_method' => 'Transfer Bank', // Bisa dibuat dinamis
                'shipping_address_id' => $address->id,
                'notes' => $request->input('notes')
            ]);
            
            // Create order items from cart items
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $cartItem->product_name . 
                        ($cartItem->specification ? ' (' . $cartItem->specification . ')' : ''),
                    
                    // ===============================================
                    //  INI ADALAH PERBAIKAN UTAMA YANG ANDA MINTA
                    //  Menyalin path file dari keranjang ke pesanan
                    // ===============================================
                    'custom_design_file' => $cartItem->custom_design_file,
                    
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->unit_price,
                    'subtotal' => $cartItem->subtotal
                ]);
            }
            
            // PERBAIKAN: Menggunakan metode Eloquent standar untuk menghapus
            // item keranjang, BUKAN file-nya di storage.
            // File di storage JANGAN dihapus, karena sudah jadi milik Order.
            $cart->items()->delete(); 
            
            DB::commit();
            
            // Redirect to invoice page using order ID
            return redirect()->route('invoice.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Tampilkan error untuk debugging
            return redirect()->route('cart.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show invoice page
     */
    public function showInvoice($id)
    {
        $order = Order::with(['items', 'shippingAddress', 'user'])
            ->where('id', $id)
            // Pastikan hanya pemilik order yang bisa lihat
            ->where('user_id', Auth::id()) 
            ->firstOrFail();
        
        return view('cart.invoice', compact('order'));
    }

    /**
     * Download invoice as PDF
     */
    public function downloadInvoice($id)
    {
        // Load order dengan relasi yang dibutuhkan
        $order = Order::with(['items', 'shippingAddress', 'user'])
            ->where('id', $id)
            // Security: Pastikan hanya pemilik order yang bisa download
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Generate PDF dari view invoice
        $pdf = Pdf::loadView('cart.invoice', compact('order'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        // Download dengan nama file yang sesuai
        $filename = 'Invoice_' . $order->invoice_number . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Merge guest cart (from localStorage) into authenticated user's cart
     */
    public function mergeGuestCart(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.material' => 'nullable|string|max:100',
            'items.*.size' => 'nullable|string|max:100',
            'items.*.design' => 'nullable|string|max:100',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.product_image' => 'nullable|string|max:255',
            'items.*.has_custom_design' => 'required|boolean',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $imported = 0;
        foreach ($validated['items'] as $item) {
            // Try merge with existing
            $existingItem = CartItem::where('cart_id', $cart->id)
                ->where('product_name', $item['product_name'])
                ->where('material', $item['material'] ?? null)
                ->where('size', $item['size'] ?? null)
                ->where('design', $item['design'] ?? null)
                ->where('has_custom_design', (bool) $item['has_custom_design'])
                ->whereNull('custom_design_file') // guest cart won't have files
                ->first();

            if ($existingItem) {
                $existingItem->quantity += (int) $item['quantity'];
                $existingItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_name' => $item['product_name'],
                    'material' => $item['material'] ?? null,
                    'size' => $item['size'] ?? null,
                    'design' => $item['design'] ?? null,
                    'quantity' => (int) $item['quantity'],
                    'unit_price' => (float) $item['unit_price'],
                    'product_image' => $item['product_image'] ?? null,
                    'has_custom_design' => (bool) $item['has_custom_design'],
                    'custom_design_file' => null,
                ]);
            }
            $imported++;
        }

        return response()->json([
            'success' => true,
            'message' => "Berhasil mengimpor {$imported} item dari keranjang tamu.",
            'cart_count' => $cart->total_quantity,
        ]);
    }

    
}