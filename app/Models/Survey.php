<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'jenis_produk',
        'wujud_produk',
        'kondisi_produk',
        'material_produk',
        'jarak_distribusi',
        'cara_pengiriman',
        'catatan',
        'foto_produk',
    ];
}