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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
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
            return view('cart.index', ['cart' => null, 'userAddresses' => collect()]);
        }

        $user = Auth::user();
        $cart = Cart::with('items')->firstOrCreate(['user_id' => $user->id]);

        // Ambil semua alamat user
        $userAddresses = UserAddress::where('user_id', $user->id)
            ->orderBy('is_primary', 'desc')
            ->get();

        return view('cart.index', compact('cart', 'userAddresses'));
    }

    public function addItem(Request $request) {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'material' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:100',
            'design' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'has_custom_design' => 'required|boolean',
        ]);

        $user = Auth::user();

        // Get or create cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Handle custom design file upload
        $customDesignPath = null;
        if ($request->hasFile('custom_design_file')) {
            $file = $request->file('custom_design_file');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $customDesignPath = $file->storeAs('custom_designs', $filename, 'public');
        }

        // Check if item with same specifications already exists
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_name', $request->product_name)
            ->where('has_custom_design', $request->has_custom_design)
            ->where(function($query) use ($customDesignPath) {
                if (!$customDesignPath) $query->whereNull('custom_design_file');
            })->first();

        if ($existingItem && !$customDesignPath) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_name' => $request->product_name,
                'material' => $request->material ?? null,
                'size' => $request->size ?? null,
                'design' => $request->design ?? null,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'product_image' => $request->product_image ?? null,
                'has_custom_design' => $request->has_custom_design,
                'custom_design_file' => $customDesignPath
            ]);
        }
        return response()->json(['success' => true, 'cart_count' => $cart->total_quantity]);
    }

    public function updateItem(Request $request, $id) {
        $item = CartItem::findOrFail($id);
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json(['success' => true, 'subtotal' => $item->formatted_subtotal, 'cart_total' => $item->cart->formatted_total]);
    }

    public function removeItem($id) {
        $item = CartItem::findOrFail($id);
        $cart = $item->cart;
        if($item->custom_design_file) Storage::disk('public')->delete($item->custom_design_file);
        $item->delete();
        return response()->json(['success' => true, 'cart_total' => $cart->formatted_total, 'items_count' => $cart->items_count]);
    }

    public function getCartCount() {
        $cart = Cart::where('user_id', Auth::id())->first();
        return response()->json(['count' => $cart ? $cart->total_quantity : 0]);
    }

    /**
     * GET ADDRESS DETAIL BY ID (AJAX)
     */
    public function getAddressDetail($id)
    {
        try {
            $address = UserAddress::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'address' => [
                    'id' => $address->id,
                    'city_id' => $address->city_id,
                    'city' => $address->city,
                    'province' => $address->province,
                    'postal_code' => $address->postal_code,
                    'address_line' => $address->address_line,
                    'full_address' => $address->full_address
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
        }
    }

    /**
     * CHECK ONGKIR BASED ON ADDRESS
     */
    public function checkOngkir(Request $request)
{
    // 1. Validasi menerima STRING nama kota
    $request->validate([
        'destination_city' => 'required|string',
        'weight' => 'required|integer',
        'courier' => 'required'
    ]);

    // ID Kota Asal (Jakarta Pusat)
    $originId = 152;
    $apiKey = env('KOMERCE_API_KEY');

    try {
        // --- LANGKAH 1: CARI ID KOTA BERDASARKAN NAMA ---
        // Kita cari ke API Komerce untuk mendapatkan ID dari string nama kota
        $searchResponse = Http::withHeaders(['key' => $apiKey])
            ->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
                'search' => $request->destination_city
            ]);

        $destinationId = null;
        $destinationType = 'city';

        if ($searchResponse->successful()) {
            $locations = $searchResponse->json()['data'] ?? [];

            $foundLocation = collect($locations)->first(function ($loc) use ($request) {
                return Str::contains(strtolower($loc['label']), strtolower($request->destination_city));
            });

            if ($foundLocation) {
                $destinationId = $foundLocation['id'];
                $destinationType = 'subdistrict';
            }
        }

        if (!$destinationId) {
            return response()->json(['error' => 'Kota tidak ditemukan di sistem kurir. Coba perbaiki penulisan alamat.'], 404);
        }

        // --- LANGKAH 2: HITUNG ONGKIR MENGGUNAKAN ID YANG DITEMUKAN ---
        $response = Http::asForm()
            ->withHeaders(['key' => $apiKey])
            ->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin'          => $originId,
                'originType'      => 'city',
                'destination'     => $destinationId,
                'destinationType' => $destinationType,
                'weight'          => $request->weight,
                'courier'         => $request->courier
            ]);

        if ($response->successful()) {
            $result = $response->json();
            $costsData = $result['data'];

            // Logic Ongkir Gratis (>500rb)
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart && $cart->total >= 500000) {
                foreach ($costsData as &$courierGroup) {
                    if (isset($courierGroup['costs'])) {
                        foreach ($courierGroup['costs'] as &$service) {
                            if (isset($service['cost'][0])) {
                                $service['cost'][0]['value'] = 0;
                                $service['description'] .= ' (GRATIS)';
                            }
                        }
                    }
                }
            }

            return response()->json($costsData);
        }

        return response()->json(['error' => 'Gagal cek ongkir', 'detail' => $response->body()], 500);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function checkout(Request $request) {
        $user = Auth::user();

        // Get user's cart
        $cart = Cart::with('items')->where('user_id', $user->id)->first();
        if (!$cart || $cart->items->isEmpty()) return redirect()->route('cart.index');

        // Validasi alamat pengiriman
        $request->validate([
            'shipping_address_id' => 'required|exists:user_addresses,id'
        ]);

        $address = UserAddress::findOrFail($request->shipping_address_id);

        // Pastikan alamat milik user yang sedang login
        if ($address->user_id !== $user->id) {
            return redirect()->route('cart.index')->with('error', 'Alamat tidak valid!');
        }

        DB::beginTransaction();

        try {
            // Generate invoice number
            $invoiceNumber = 'INV-' . date('ymd') . '-' . strtoupper(Str::random(6));

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'invoice_number' => 'INV-'.strtoupper(Str::random(8)),
                'order_date' => now(),
                'total_amount' => $cart->total + $request->shipping_cost,
                'shipping_cost' => $request->shipping_cost,
                'shipping_service' => $request->shipping_service,
                'status' => 'Diproses',
                'payment_method' => 'Transfer Bank',
                'shipping_address_id' => $address->id,
                'notes' => $request->notes
            ]);

            foreach($cart->items as $item) {
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_name'=>$item->product_name,
                    'quantity'=>$item->quantity,
                    'unit_price'=>$item->unit_price,
                    'subtotal'=>$item->subtotal,
                    'custom_design_file'=>$item->custom_design_file
                ]);
            }

            $cart->items()->delete();

            DB::commit();

            return redirect()->route('invoice.show', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showInvoice($id) {
        $order = Order::with(['items', 'shippingAddress'])->where('id', $id)->firstOrFail();
        return view('cart.invoice', compact('order'));
    }

    public function downloadInvoice($id) {
        $order = Order::with(['items', 'shippingAddress'])->where('id', $id)->firstOrFail();
        $pdf = Pdf::loadView('cart.invoice', compact('order'));
        return $pdf->download('Invoice.pdf');
    }

    public function mergeGuestCart(Request $request) {
        return response()->json(['success'=>true]);
    }


}
