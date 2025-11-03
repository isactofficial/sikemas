<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_name',
        'material',
        'size',
        'design',
        'quantity',
        'unit_price',
        'subtotal',
        'product_image',
        'custom_design_file',
        'has_custom_design'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'has_custom_design' => 'boolean',
    ];

    /**
     * Get the cart that owns the item
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get formatted unit price
     */
    public function getFormattedUnitPriceAttribute()
    {
        return 'Rp ' . number_format($this->unit_price, 0, ',', '.');
    }

    /**
     * Get formatted subtotal
     */
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Calculate subtotal based on quantity and unit price
     */
    public function calculateSubtotal()
    {
        $this->subtotal = $this->quantity * $this->unit_price;
        return $this->subtotal;
    }

    /**
     * Boot method to auto-calculate subtotal
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cartItem) {
            $cartItem->subtotal = $cartItem->quantity * $cartItem->unit_price;
        });

        static::updating(function ($cartItem) {
            $cartItem->subtotal = $cartItem->quantity * $cartItem->unit_price;
        });
    }

    /**
     * Get product specification summary
     */
    public function getSpecificationAttribute()
    {
        $specs = [];
        
        if ($this->material) {
            $specs[] = "Bahan: {$this->material}";
        }
        
        if ($this->size) {
            $specs[] = "Ukuran: {$this->size}";
        }
        
        if ($this->design) {
            $specs[] = "Desain: {$this->design}";
        }
        
        return implode(' | ', $specs);
    }
}