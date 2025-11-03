<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Pastikan Model Order Anda ada di app/Models/Order
use App\Models\User; // Asumsi Model User ada di app/Models/User
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi (pesanan).
     */
    public function index(Request $request)
    {
        // Ambil data order dengan relasi user
        $query = Order::with('user');

        // Logika sorting dari request
        $sort = $request->get('sort');
        if ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            // Default atau 'newest'
            $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate(8);

        // Tambahkan query string ke link paginasi
        $orders->appends($request->only('sort'));

        return view('admin.transactions.transactions', compact('orders')); // Asumsi nama view: admin.transactions.transactions
    }

    /**
     * Menampilkan form untuk mengedit transaksi (misal: status).
     *
     * === INI BAGIAN YANG DIPERBARUI ===
     */
    public function edit($id)
    {
        // 1. Ambil order DENGAN relasi 'user' DAN 'shippingAddress'
        //    Kita butuh 'shippingAddress' untuk kartu profil pengguna
        $order = Order::with('user', 'shippingAddress', 'items')->findOrFail($id);

        // 2. Sesuaikan daftar status
        $statuses = ['Pending', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];

        // 3. Kirim ke view 'admin.transactions.edit'
        return view('admin.transactions.edit', compact('order', 'statuses'));
    }

    /**
     * Memperbarui data transaksi di database.
     */
    // DI TransactionController.php
    public function update(Request $request, $id)
    {
    // Validasi untuk 2 status dari dropdown
        $validated = $request->validate([
            'payment_status' => 'required|in:Paid,Unpaid,Cancelled',
            'shipping_status' => 'required|in:Pending,Shipped,Arrived,Cancelled',
    ]);

        $order = Order::findOrFail($id);

    // Simpan kedua status
        $order->payment_status = $validated['payment_status'];
        $order->shipping_status = $validated['shipping_status'];
        $order->save();

    // Redirect kembali ke index
        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi dari database.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
