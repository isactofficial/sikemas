<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of all transactions.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate(15);

        return view('admin.transactions.index', compact('orders'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        $products = \App\Models\Product::orderBy('name', 'asc')->get();
        return view('admin.transactions.create', compact('users', 'products'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            'shipping_cost' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string|max:50',
            'payment_status' => 'required|in:Unpaid,Paid,Cancelled',
            'shipping_status' => 'required|in:Pending,Shipped,Arrived,Cancelled',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.custom_design_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ai,psd,cdr|max:10240',
        ]);

        DB::beginTransaction();

        try {
            // Ambil detail alamat
            $shippingAddress = UserAddress::findOrFail($validated['shipping_address_id']);

            // Generate invoice number
            $invoiceNumber = $this->generateInvoiceNumber();

            // Hitung total amount dari items
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $totalAmount += $item['quantity'] * $item['unit_price'];
            }

            // Tambah pajak 11%
            $totalAmount = $totalAmount * 1.11;

            // Tambah shipping cost
            $shippingCost = $validated['shipping_cost'] ?? 0;
            $totalAmount += $shippingCost;

            // Tentukan status order utama
            $status = 'Diproses'; // Default
            if ($validated['payment_status'] === 'Cancelled' || $validated['shipping_status'] === 'Cancelled') {
                $status = 'Dibatalkan';
            } elseif ($validated['payment_status'] === 'Paid' && $validated['shipping_status'] === 'Arrived') {
                $status = 'Selesai';
            }

            // Create order
            $order = Order::create([
                'user_id' => $validated['user_id'],
                'invoice_number' => $invoiceNumber,
                'order_date' => Carbon::now(),
                'total_amount' => $totalAmount,
                'shipping_cost' => $shippingCost,
                'status' => $status,
                'payment_status' => $validated['payment_status'],
                'shipping_status' => $validated['shipping_status'],
                'payment_method' => $validated['payment_method'],
                'shipping_address_id' => $validated['shipping_address_id'],
                'notes' => $validated['notes'],

                // Salin detail alamat
                'shipping_name' => $shippingAddress->recipient_name ?? $shippingAddress->user->name,
                'shipping_phone' => $shippingAddress->phone_number ?? $shippingAddress->user->phone,
                'shipping_address' => $shippingAddress->address_line,
                'shipping_city' => $shippingAddress->city,
                'shipping_province' => $shippingAddress->province,
                'shipping_zip_code' => $shippingAddress->postal_code,
            ]);

            // Simpan order items
            foreach ($validated['items'] as $index => $itemData) {
                $designFilePath = null;

                // Cek jika ada file upload
                if ($request->hasFile("items.{$index}.custom_design_file")) {
                    $file = $request->file("items.{$index}.custom_design_file");
                    $path = $file->store("designs/{$order->id}", 'public');
                    $designFilePath = $path;
                }
                
                $itemSubtotal = $itemData['quantity'] * $itemData['unit_price'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $itemData['product_name'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'subtotal' => $itemSubtotal,
                    'custom_design_file' => $designFilePath,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.transactions.index')
                ->with('success', 'Transaksi baru berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction creation failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan transaksi. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified transaction.
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items', 'shippingAddress'])->findOrFail($id);
        
        // Calculate subtotal
        $subtotal = 0;
        foreach ($order->items as $item) {
            $subtotal += $item->subtotal ?? ($item->quantity * $item->unit_price);
        }

        return view('admin.transactions.show', compact('order', 'subtotal'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $order = Order::with(['user', 'items'])->findOrFail($id);
        $users = User::orderBy('name', 'asc')->get();
        return view('admin.transactions.edit', compact('order', 'users'));
    }

    /**
     * Update the specified transaction status in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            'payment_status' => 'required|in:Unpaid,Paid,Cancelled',
            'shipping_status' => 'required|in:Pending,Shipped,Arrived,Cancelled',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Tentukan status order utama
        $status = 'Diproses'; // Default
        if ($validated['payment_status'] === 'Cancelled' || $validated['shipping_status'] === 'Cancelled') {
            $status = 'Dibatalkan';
        } elseif ($validated['payment_status'] === 'Paid' && $validated['shipping_status'] === 'Arrived') {
            $status = 'Selesai';
        }

        $updateData = [
            'user_id' => $validated['user_id'],
            'shipping_address_id' => $validated['shipping_address_id'],
            'payment_status' => $validated['payment_status'],
            'shipping_status' => $validated['shipping_status'],
            'notes' => $validated['notes'] ?? $order->notes,
            'status' => $status,
        ];

        // Cek jika alamat pengiriman diubah
        if ($order->shipping_address_id != $validated['shipping_address_id']) {
            $newAddress = UserAddress::findOrFail($validated['shipping_address_id']);
            
            $updateData['shipping_name'] = $newAddress->recipient_name ?? $newAddress->user->name;
            $updateData['shipping_phone'] = $newAddress->phone_number ?? $newAddress->user->phone;
            $updateData['shipping_address'] = $newAddress->address_line;
            $updateData['shipping_city'] = $newAddress->city;
            $updateData['shipping_province'] = $newAddress->province;
            $updateData['shipping_zip_code'] = $newAddress->postal_code;
        }

        $order->update($updateData);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $order = Order::with('items')->findOrFail($id);

            // Delete custom design files if exist
            foreach ($order->items as $item) {
                if ($item->custom_design_file && Storage::disk('public')->exists($item->custom_design_file)) {
                    Storage::disk('public')->delete($item->custom_design_file);
                }
            }

            $order->items()->delete();
            $order->delete();

            DB::commit();

            return redirect()
                ->route('admin.transactions.index')
                ->with('success', 'Transaksi berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction deletion failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus transaksi.');
        }
    }

    /**
     * Generate unique invoice number.
     */
    private function generateInvoiceNumber()
    {
        $date = Carbon::now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        
        return "INV-{$date}-{$random}";
    }

    /**
     * Get addresses for a specific user (AJAX endpoint).
     * 
     * PENTING: Method ini harus bisa diakses via route!
     */
    public function getUserAddresses($userId)
    {
        try {
            // Log untuk debugging
            Log::info('Fetching addresses for user: ' . $userId);
            
            // Validasi user exists
            $user = User::find($userId);
            if (!$user) {
                Log::warning('User not found: ' . $userId);
                return response()->json(['error' => 'User tidak ditemukan.'], 404);
            }
            
            // Ambil alamat user
            $addresses = UserAddress::where('user_id', $userId)
                ->orderBy('is_primary', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();

            // Log jumlah alamat
            Log::info('Found ' . $addresses->count() . ' addresses for user ' . $userId);
            
            // Jika tidak ada alamat
            if ($addresses->isEmpty()) {
                Log::info('No addresses found for user ' . $userId);
                return response()->json([]);
            }
            
            // Log sample alamat pertama untuk debug
            if ($addresses->count() > 0) {
                $firstAddress = $addresses->first();
                Log::info('Sample address:', [
                    'id' => $firstAddress->id,
                    'has_full_address' => isset($firstAddress->full_address),
                    'full_address' => $firstAddress->full_address ?? 'NOT AVAILABLE'
                ]);
            }

            return response()->json($addresses);
            
        } catch (\Exception $e) {
            Log::error('Error fetching addresses for user ' . $userId . ': ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'error' => 'Gagal mengambil alamat.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}