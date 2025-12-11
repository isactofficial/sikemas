<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
        'content',
        'likes_count',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'reply_likes')->withTimestamps();
    }

    /**
     * Check if given user has liked this reply.
     */
    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        if ($this->relationLoaded('likedByUsers')) {
            return $this->likedByUsers->contains($user->id);
        }
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }
}
