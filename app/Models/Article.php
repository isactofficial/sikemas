<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'deskripsi',
        'editor_id',
        'status',
        'views',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Relationship: Article has many contents (subheadings & paragraphs)
     */
    public function contents()
    {
        return $this->hasMany(ArticleContent::class)->orderBy('display_order');
    }

    /**
     * Relationship: Article belongs to an editor (user)
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    /**
     * Relationship: Article belongs to many categories
     */
    public function categories()
    {
        return $this->belongsToMany(
            ArticleCategory::class,
            'article_category_pivot', // pivot table name
            'article_id',             // foreign key for this model on pivot
            'category_id'             // foreign key for related model on pivot
        );
    }

    /**
     * Scope: Published articles only
     */
    public function scopePublished($query)
    {
        // Be lenient with status casing (e.g., 'Published' or 'published')
        return $query->whereRaw('LOWER(status) = ?', ['published']);
    }

    /**
     * Scope: Draft articles only
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope: Search by title
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        }
        return $query;
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at 
            ? $this->published_at->format('d - m - Y') 
            : $this->created_at->format('d - m - Y');
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('assets/img/Article-image.png');
    }

    /**
     * Get deskripsi with limit
     */
    public function getShortdeskripsiAttribute()
    {
        return Str::limit($this->deskripsi, 150);
    }

    /**
     * Check if article is published
     */
    public function isPublished()
    {
        return strtolower((string) $this->status) === 'published';
    }

    /**
     * Check if article is draft
     */
    public function isDraft()
    {
        return strtolower((string) $this->status) === 'draft';
    }

    /**
     * Relationship: Article has many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }
}