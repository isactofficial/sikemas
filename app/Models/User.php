<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

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
     * Relationship: User has many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get user's primary address
     */
    public function primaryAddress()
    {
        return $this->hasOne(UserAddress::class)->where('is_primary', true);
    }

    /**
     * Get formatted birth date
     */
    public function getFormattedBirthDateAttribute()
    {
        if (!$this->birth_date) {
            return '-';
        }
        return $this->birth_date->format('d F Y');
    }

    /**
     * Get profile photo URL with cache busting
     * Updated to handle both local files and Google URLs
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            // Check if it's a URL (from Google)
            if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
                return $this->profile_photo;
            }
            
            // Check if file exists in storage (local upload)
            $path = 'public/profiles/' . $this->profile_photo;
            
            if (Storage::exists($path)) {
                // Add timestamp to prevent caching issues
                $timestamp = Storage::lastModified($path);
                return asset('storage/profiles/' . $this->profile_photo . '?v=' . $timestamp);
            }
        }
        
        // Return default avatar with user initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=200&background=074159&color=fff&bold=true';
    }

    /**
     * Get profile photo path (for display without cache busting)
     */
    public function getProfilePhotoPathAttribute()
    {
        if ($this->profile_photo) {
            // Return URL as-is if it's from Google
            if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
                return $this->profile_photo;
            }
            
            // Return local path if file exists
            if (Storage::exists('public/profiles/' . $this->profile_photo)) {
                return asset('storage/profiles/' . $this->profile_photo);
            }
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