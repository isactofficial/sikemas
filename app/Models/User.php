<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

// Impor model Consultation
use App\Models\Consultation;

class User extends Authenticatable
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
        'google_id',
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
     * Relationship: User has many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relationship: User has many consultations
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * Helper function untuk mengecek konsultasi aktif (pending atau scheduled)
     */
    public function hasActiveConsultation(): bool
    {
        try {
            if (!Schema::hasTable('consultations')) {
                return false;
            }

            return $this->consultations()
                        ->whereIn('status', ['pending', 'scheduled'])
                        ->exists();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Get user profile photo URL
     */
    public function getProfilePhotoUrlAttribute()
    {
        // If no profile photo, return default avatar
        if (!$this->profile_photo) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=074159&background=E6EEF0&size=200';
        }

        // Check if it's a URL (from Google)
        if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
            return $this->profile_photo;
        }

        // Check if local file exists
        if (Storage::exists('public/profiles/' . $this->profile_photo)) {
            return asset('storage/profiles/' . $this->profile_photo);
        }

        // Return default if file doesn't exist
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=074159&background=E6EEF0&size=200';
    }

    /**
     * Get user profile photo path (for internal use)
     */
    public function getProfilePhotoPathAttribute()
    {
        if (!$this->profile_photo) {
            return null;
        }

        if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
            return $this->profile_photo;
        }

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

        if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
            return true;
        }

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
     * Get formatted birth date
     */
    public function getFormattedBirthDateAttribute()
    {
        if (!$this->birth_date) {
            return '-';
        }

        try {
            // Ensure birth_date is a Carbon instance
            if ($this->birth_date instanceof Carbon) {
                return $this->birth_date->translatedFormat('d F Y');
            }

            // Parse if it's a string
            $date = Carbon::parse($this->birth_date);
            return $date->translatedFormat('d F Y');
        } catch (\Exception $e) {
            // If parsing fails, return the raw value or dash
            return $this->birth_date ?? '-';
        }
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
        return !empty($this->google_id) && empty($this->password);
    }
}