<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Menyimpan pesan kontak baru dari formulir.
     *
     * @param
     * @return
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        // 2. Cek apakah user sedang login
        if (Auth::check()) {
            // Jika login, tambahkan user_id ke data yang akan disimpan
            $validatedData['user_id'] = Auth::id();
        }

        // 3. Simpan data ke database
        ContactMessage::create($validatedData);

        // 4. Redirect kembali, kirim pesan sukses, dan tambahkan anchor
        //    agar halaman otomatis scroll ke 'contact-section'
        return back()->with('success', 'Pesan Anda telah berhasil terkirim! Terima kasih.')
                     ->withFragment('contact-section');
    }
}
