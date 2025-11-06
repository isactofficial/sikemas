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

        // ==========================================================
        // Validasi Nomor Telepon (Rule #1 - BACKEND FAILSAFE)
        // ==========================================================
        if (empty($user->no_telepon)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda harus melengkapi nomor telepon di profil Anda sebelum dapat meminta konsultasi.',
                // Kirim URL redirect agar JS bisa mengarahkan user
                'redirect' => route('profile.edit')
            ], 422); // 422 Unprocessable Entity
        }
        // ==========================================================
        // AKHIR PERUBAHAN
        // ==========================================================


        // Rule #3: Cek apakah user sudah memiliki konsultasi yang sedang berjalan
        if ($user->hasActiveConsultation()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah memiliki permintaan konsultasi aktif. Satu pengguna hanya bisa melakukan 1 kali konsultasi sampai sesi konsultasi berakhir.'
            ], 409); // 409 Conflict
        }

        // Jika tidak ada, buat permintaan konsultasi baru
        $consultation = $user->consultations()->create([
            'status' => 'pending', // Atur status awal
            'konfirmasi' => 'waiting', // Atur status konfirmasi awal
            'user_id' => $user->id // Pastikan user_id diisi
        ]);

        // HASIL SUKSES untuk Rule #2
        return response()->json([
            'status' => 'success',
            'message' => 'Permintaan konsultasi berhasil diajukan. Data user akan diperiksa dan akan dihubungi oleh admin SIKEMAS nantinya.'
        ], 200);
    }
}
