<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth page
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            // Get user info from Google
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if ($user) {
                // User exists, just login
                Auth::login($user);
                
                return redirect('/')->with('success', 'Berhasil masuk dengan Google!');
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                    'profile_photo' => $googleUser->getAvatar(),
                ]);
                
                // Login the new user
                Auth::login($user);
                
                return redirect('/')->with('success', 'Selamat datang! Akun Anda berhasil dibuat dengan Google!');
            }
            
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Gagal masuk dengan Google. Silakan coba lagi.');
        }
    }
}