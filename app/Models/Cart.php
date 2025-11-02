<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    /**
     * Get the user that owns the cart
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cart items
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Calculate total amount
     */
    public function getTotalAmountAttribute()
    {
        return $this->items->sum('subtotal');
    }

    /**
     * Get formatted total
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Get cart items count
     */
    public function getItemsCountAttribute()
    {
        return $this->items->count();
    }

    /**
     * Get total quantity
     */
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Calculate shipping cost (flat rate for now)
     */
    public function getShippingCostAttribute()
    {
        return 20000; // Rp 20.000
    }

    /**
     * Get formatted shipping cost
     */
    public function getFormattedShippingCostAttribute()
    {
        return 'Rp ' . number_format($this->shipping_cost, 0, ',', '.');
    }

    /**
     * Calculate grand total (subtotal + shipping)
     */
    public function getGrandTotalAttribute()
    {
        return $this->total_amount + $this->shipping_cost;
    }

    /**
     * Get formatted grand total
     */
    public function getFormattedGrandTotalAttribute()
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    /**
     * Clear all items from cart
     */
    public function clearItems()
    {
        $this->items()->delete();
    }
}