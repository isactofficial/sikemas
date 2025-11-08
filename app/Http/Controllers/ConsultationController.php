<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Rule #3: Cek apakah user sudah memiliki konsultasi yang sedang berjalan (pending/active)
        // Model User memiliki relasi consultations()
        // dan tabel 'consultations' memiliki kolom 'user_id' dan 'status'.
        if ($user->hasActiveConsultation()) {
             // HASIL ERROR untuk Rule #3
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah memiliki permintaan konsultasi aktif. Satu pengguna hanya bisa melakukan 1 kali konsultasi sampai sesi konsultasi berakhir.'
            ], 409); // 409 Conflict
        }

        // Jika tidak ada, buat permintaan konsultasi baru
        $consultation = $user->consultations()->create([
            'status' => 'pending', // Atur status awal
            // Tambahkan field lain yang mungkin dibutuhkan
        ]);

        // HASIL SUKSES untuk Rule #2
        return response()->json([
            'status' => 'success',
            'message' => 'Permintaan konsultasi berhasil diajukan. Data user akan diperiksa dan akan dihubungi oleh admin SIKEMAS nantinya.'
        ], 200);
    }
}
