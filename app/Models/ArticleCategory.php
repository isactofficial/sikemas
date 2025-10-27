<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * Relationship: Category has many articles
     */
    public function articles()
    {
        return $this->belongsToMany(
            Article::class,
            'article_category_pivot',
            'category_id',
            'article_id'
        );
    }
}