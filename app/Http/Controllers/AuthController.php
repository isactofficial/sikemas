<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // <-- TAMBAHKAN BARIS INI

class AuthController extends Controller
{
    public function showLogin()
    {
        // Path ini sudah benar berdasarkan error Anda sebelumnya
        return view('auth.login'); 
    }

    public function showRegister()
    {
        // Path ini sudah benar
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        // --- MULAI PERUBAHAN VALIDASI ---
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            
            // Menggunakan aturan validasi password yang baru
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()],

        ], [
            // Pesan error kustom agar sesuai permintaan Anda
            'password.min' => 'Password minimal 8 karakter.',
            'password.letters' => 'Password harus mengandung huruf.',
            'password.numbers' => 'Password harus mengandung angka.',
        ]);
        // --- AKHIR PERUBAHAN VALIDASI ---

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'survey_completed' => false,
        ]);

        Auth::login($user);

        // Redirect ke survey setelah register
        return redirect()->route('survey');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek apakah survey sudah selesai
            if (!Auth::user()->survey_completed) {
                return redirect()->route('survey');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}