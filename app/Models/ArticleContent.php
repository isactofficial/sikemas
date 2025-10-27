<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'content_type',
        'content',
        'display_order'
    ];

    /**
     * Relationship: Content belongs to an article
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}