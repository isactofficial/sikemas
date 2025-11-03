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
     *
     * CATATAN: Pastikan Anda telah mendefinisikan relasi 'user' di Model Order Anda:
     * public function user() {
     * return $this->belongsTo(User::class);
     * }
     */
    public function index()
    {
        // Ambil data order dengan relasi user, urutkan terbaru, dan paginasi 8 per halaman
        $orders = Order::with('user')
                       ->orderBy('created_at', 'desc')
                       ->paginate(8);

        return view('admin.transactions.transactions', compact('orders'));
    }

    /**
     * Menampilkan detail satu transaksi.
     *
     * CATATAN: Pastikan Anda telah mendefinisikan relasi 'orderItems' di Model Order Anda:
     * public function orderItems() {
     * return $this->hasMany(OrderItem::class); // Pastikan Model OrderItem ada
     * }
     */
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems'])->findOrFail($id);
        return view('admin.transactions.show', compact('order'));
    }

    /**
     * Menampilkan form untuk mengedit transaksi (misal: status).
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        // Status yang diperbolehkan dari schema SQL Anda
        $statuses = ['Diproses', 'Selesai', 'Dibatalkan'];

        return view('admin.transactions.edit', compact('order', 'statuses'));
    }

    /**
     * Memperbarui data transaksi di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Selesai,Dibatalkan',
            // Anda bisa tambahkan validasi untuk 'payment_status' dan 'shipping_status'
            // jika Anda memodifikasi database di kemudian hari.
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');

        // Logika mapping status tunggal ke dua status (Payment & Shipping)
        // Ini adalah asumsi untuk mengisi data.
        // Jika status 'Selesai', anggap 'payment_status' = 'Paid' dan 'shipping_status' = 'Arrived'
        // Jika Anda menambah kolom ini di DB, update di sini.

        $order->save();

        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi dari database.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        // Anda mungkin juga ingin menghapus order_items terkait jika tidak di-set ON DELETE CASCADE
        // OrderItem::where('order_id', $id)->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
