<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function show()
    {
        // Cek jika user sudah pernah isi survey
        if (Auth::user()->survey_completed) {
            return redirect('/')->with('info', 'Anda sudah mengisi survey');
        }
        
        return view('survey.index');
    }

    public function submit(Request $request)
    {
        // Handle file upload
        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('survey_photos', 'public');
        }

        Survey::create([
            'user_id' => Auth::id(),
            'jenis_produk' => $request->jenis_produk,
            'wujud_produk' => $request->wujud_produk,
            'kondisi_produk' => json_encode($request->kondisi_produk ?? []),
            'material_produk' => $request->material_produk,
            'jarak_distribusi' => $request->jarak_distribusi,
            'cara_pengiriman' => json_encode($request->cara_pengiriman ?? []),
            'catatan' => $request->catatan,
            'foto_produk' => $fotoPath,
        ]);

        // Update user survey status
        Auth::user()->update(['survey_completed' => true]);

        return redirect('/')->with('success', 'Terima kasih telah mengisi survey!');
    }
}