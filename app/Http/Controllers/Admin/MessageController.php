<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Menampilkan daftar pesan masuk.
     */
    public function index()
    {
        // Mengambil data pesan terbaru dengan pagination (10 per halaman)
        $messages = ContactMessage::latest()->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    public function toggleRead($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $message->is_read = !$message->is_read;
        $message->save();
        $status = $message->is_read ? 'sudah dibaca' : 'belum dibaca';
        return back()->with('success', "Status pesan berhasil diubah menjadi {$status}.");
    }

    /**
     * Menghapus pesan.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
