<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FreeConsultationController extends Controller
{
    /**
     * Menampilkan daftar semua konsultasi gratis.
     */
    public function index(Request $request)
    {
        // Ambil data konsultasi, diurutkan dari yang terbaru,
        // dan lakukan eager loading relasi 'user'
        $consultations = Consultation::with('user')
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);

        return view('admin.free_consultations.index', compact('consultations'));
    }

    /**
     * Menampilkan form untuk mengedit konsultasi.
     */
    public function edit(Consultation $freeConsultation)
    {
        // $freeConsultation sudah otomatis di-resolve by Route Model Binding
        return view('admin.free_consultations.edit', [
            'consultation' => $freeConsultation
        ]);
    }

    /**
     * Mengupdate data konsultasi di database.
     */
    public function update(Request $request, Consultation $freeConsultation)
    {
        // Validasi input
        $validatedData = $request->validate([
            'status' => [
                'required',
                // Sesuai ENUM dari file .sql terakhir Anda
                Rule::in(['pending', 'scheduled', 'completed', 'cancelled']),
            ],
            'konfirmasi' => [
                'required',
                Rule::in(['waiting', 'on-going', 'confirmed']),
            ],
            'consultation_date' => 'nullable|date',
            'notes' => 'nullable|string|max:5000',
        ]);

        // Update data konsultasi
        $freeConsultation->update($validatedData);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()
                ->route('admin.free-consultations.index')
                ->with('success', 'Status konsultasi berhasil diperbarui.');
    }

    /**
     * BARU: Menghapus data konsultasi dari database.
     */
    public function destroy(Consultation $freeConsultation)
    {
        try {
            // Hapus data
            $freeConsultation->delete();

            // Redirect kembali dengan pesan sukses
            return redirect()
                    ->route('admin.free-consultations.index')
                    ->with('success', 'Data konsultasi berhasil dihapus.');

        } catch (\Exception $e) {
            // Tangani jika ada error (misal: constraint database)
            return redirect()
                    ->route('admin.free-consultations.index')
                    ->with('error', 'Gagal menghapus data. Pesan: ' . $e->getMessage());
        }
    }
}