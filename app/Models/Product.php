<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'category', 'price', 'description', 'notes'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get public URL for product image with safe fallback.
     */
    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            // If already an absolute URL or absolute path, return as-is
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '/')) {
                return $this->image;
            }
            // If stored under assets/, use asset()
            if (str_starts_with($this->image, 'assets/')) {
                return asset($this->image);
            }
            // Otherwise assume it's a storage path
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }
        return asset('assets/img/box2.png');
    }
}
