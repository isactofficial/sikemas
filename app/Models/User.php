<?php

namespace App\Models;

// TAMBAHKAN INI UNTUK VERIFIKASI EMAIL
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

// BARU: Impor model Consultation
use App\Models\Consultation;

// TAMBAHKAN 'implements MustVerifyEmail'
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'birth_date',
        'profile_photo',
        'survey_completed',
        'google_id', // Tambahan untuk Google OAuth
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',
            'survey_completed' => 'boolean',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship: User has many addresses
     */
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * Relationship: User has one cart
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Relationship: User has many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relationship: User has many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relationship: User has many replies
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Relationship: User has many surveys
     */
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    // ============================================\n
    // <-- FUNGSI KONSULTASI BARU DITAMBAHKAN DI SINI -->
    // ============================================\n

    /**
     * Mendapatkan semua konsultasi gratis milik user.
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * Cek apakah user memiliki konsultasi yang sedang aktif (belum selesai).
     * Ini digunakan untuk Rule #3 di halaman depan.
     */
    public function hasActiveConsultation(): bool
    {
        // Cek apakah ada konsultasi yang statusnya BUKAN 'completed'
        // dan juga BUKAN 'cancelled'.
        // Jika ada (pending/active), maka return true.
        return $this->consultations()
                    ->whereNotIn('status', ['completed', 'cancelled'])
                    ->exists();
    }

    /**
     * Get user's profile photo URL
     */
    public function getProfilePhotoUrlAttribute()
    {
        // Check if profile_photo is a URL (from Google)
        if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
            return $this->profile_photo;
        }

        // Check if local file exists and return local path if file exists
        if (Storage::exists('public/profiles/' . $this->profile_photo)) {
            return asset('storage/profiles/' . $this->profile_photo);
        }

        return null;
    }

    /**
     * Check if user has custom profile photo
     */
    public function hasProfilePhoto()
    {
        if (!$this->profile_photo) {
            return false;
        }

        // Check if it's a URL (from Google)
        if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
            return true;
        }

        // Check if local file exists
        return Storage::exists('public/profiles/' . $this->profile_photo);
    }

    /**
     * Get user's gender display name
     */
    public function getGenderDisplayAttribute()
    {
        if (!$this->gender) {
            return '-';
        }

        return $this->gender === 'Male' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Get formatted phone number
     */
    public function getFormattedPhoneAttribute()
    {
        return $this->phone ?? '-';
    }

    /**
     * Check if user has completed profile
     */
    public function hasCompletedProfile()
    {
        return !empty($this->phone) &&
               !empty($this->gender) &&
               !empty($this->birth_date);
    }

    /**
     * Check if user registered via Google
     */
    public function isGoogleUser()
    {
        return !empty($this->google_id);
    }
}
