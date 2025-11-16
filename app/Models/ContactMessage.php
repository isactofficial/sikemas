<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'subjek',
        'pesan',
    ];

    /**
     * Mendapatkan user yang mengirim pesan (jika ada).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
