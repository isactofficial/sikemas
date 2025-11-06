<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'free_consultations'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'konfirmasi',
        'consultation_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'consultation_date' => 'datetime',
        ];
    }

    /**
     * Mendapatkan user yang memiliki konsultasi ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
