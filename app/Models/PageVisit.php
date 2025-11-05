<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'page',      // string key: home, article, produk, portofolio, about, contact
        'date',      // date (Y-m-d)
        'count',     // integer count for that day
    ];
}
