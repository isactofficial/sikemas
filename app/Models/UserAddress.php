<?php

// ========================================\
// File: app/Models/UserAddress.php
// ========================================\

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_type',
        'address_line',
        'city',
        'province',
        'postal_code',
        'country',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // ==========================================================
    // PERBAIKAN: Tambahkan baris ini
    // Ini "memaksa" accessor 'full_address' untuk selalu
    // ikut serta saat model ini diubah ke JSON (misal: di response()->json())
    // ==========================================================
    protected $appends = ['full_address'];


    /**
     * Get the user that owns the address
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get full formatted address
     * (Accessor ini sudah ada sebelumnya dan sudah benar)
     */
    public function getFullAddressAttribute()
    {
        $parts = [$this->address_line, $this->city];
        
        if ($this->province) {
            $parts[] = $this->province;
        }
        
        if ($this->postal_code) {
            $parts[] = $this->postal_code;
        }
        
        $parts[] = $this->country;
        
        // implode akan menggabungkan string dengan ", "
        return implode(', ', array_filter($parts)); // array_filter untuk jaga-jaga jika ada yg null
    }
}