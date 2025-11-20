<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
        'likes_count',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->orderBy('created_at');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'comment_likes')->withTimestamps();
    }

    /**
     * Check if given user has liked this comment.
     */
    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        // If relation already loaded use collection to avoid extra query.
        if ($this->relationLoaded('likedByUsers')) {
            return $this->likedByUsers->contains($user->id);
        }
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }
}
