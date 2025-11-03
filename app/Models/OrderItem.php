<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_name',
        'custom_design_file', // <-- INI PERBAIKANNYA
        'quantity',
        'unit_price',
        'subtotal'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // Menonaktifkan created_at & updated_at untuk tabel ini

    /**
     * Get the order that owns the item
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Get formatted subtotal
     *
     * @return string
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}