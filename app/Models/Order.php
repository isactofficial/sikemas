<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'order_date',
        'total_amount',
        'status',
        'payment_status',    // <-- TAMBAHKAN INI
        'shipping_status',
        'payment_method',
        'shipping_address_id',
        'notes'
    ];

    protected $casts = [
        'order_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shipping address for the order
     */
    public function shippingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'shipping_address_id');
    }

    /**
     * Get the order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Selesai' => '<span class="order-status status-selesai">✓ Selesai</span>',
            'Diproses' => '<span class="order-status status-diproses">⏳ Diproses</span>',
            'Dibatalkan' => '<span class="order-status status-dibatalkan">✕ Dibatalkan</span>',
        ];

        return $badges[$this->status] ?? $this->status;
    }

    /**
     * Get formatted total amount
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }


}
