<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Menyimpan rating dan komentar dari user.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            // Dapatkan user yang sedang login
            $user = Auth::user();

            // Simpan rating dan komentar
            $user->rating = $request->input('rating');
            $user->rating_comment = $request->input('comment');
            $user->save();

            return response()->json(['success' => true, 'message' => 'Rating berhasil dikirim!']);

        } catch (\Exception $e) {
            // Tangani jika ada error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }
}
