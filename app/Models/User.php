<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'phone',              // Kolom baru untuk nomor telepon
        'gender',             // Kolom baru untuk jenis kelamin
        'birth_date',         // Kolom baru untuk tanggal lahir
        'profile_photo',      // Kolom baru untuk foto profil
        'survey_completed',   // Kolom existing untuk status survey
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
            'birth_date' => 'date',           // Cast birth_date sebagai date
            'survey_completed' => 'boolean',  // Cast survey_completed sebagai boolean
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
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            // Check if file exists in storage
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
        if ($this->profile_photo && Storage::exists('public/profiles/' . $this->profile_photo)) {
            return asset('storage/profiles/' . $this->profile_photo);
        }
        
        return null;
    }

    /**
     * Check if user has custom profile photo
     */
    public function hasProfilePhoto()
    {
        return !empty($this->profile_photo) && Storage::exists('public/profiles/' . $this->profile_photo);
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
}