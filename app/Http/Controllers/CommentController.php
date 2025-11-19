<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment for an article
     */
    public function store(Request $request, Article $article)
    {
        $this->authorizeWhenLoggedIn();

        $data = $request->validate([
            'content' => ['required','string','max:3000'],
        ]);

        $article->comments()->create([
            'user_id' => Auth::id(),
            'content' => trim($data['content']),
        ]);

        return back()->with('status', 'Komentar berhasil dikirim.');
    }

    /**
     * Store a reply for a comment
     */
    public function reply(Request $request, Comment $comment)
    {
        $this->authorizeWhenLoggedIn();

        $data = $request->validate([
            'content' => ['required','string','max:3000'],
        ]);

        $comment->replies()->create([
            'user_id' => Auth::id(),
            'content' => trim($data['content']),
        ]);

        return back()->with('status', 'Balasan berhasil dikirim.');
    }

    /**
     * Minimal guard to ensure user is authenticated.
     */
    protected function authorizeWhenLoggedIn(): void
    {
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu.');
        }
    }

    /**
     * Increment like count for a comment
     */
    public function likeComment(Comment $comment)
    {
        $this->authorizeWhenLoggedIn();
        $user = Auth::user();

        // Toggle like: if already liked -> unlike, else like
        $alreadyLiked = $comment->likedByUsers()
            ->where('users.id', $user->id)
            ->exists();

        if ($alreadyLiked) {
            // Unlike
            $comment->likedByUsers()->detach($user->id);
            if ((int) $comment->likes_count > 0) {
                $comment->decrement('likes_count');
            }
        } else {
            // Like (guard against duplicate inserts via unique index)
            try {
                $comment->likedByUsers()->attach($user->id);
            } catch (\Throwable $e) {
                // If a race condition occurs and record exists, ignore
            }
            $comment->increment('likes_count');
        }

        return back();
    }

    /**
     * Increment like count for a reply
     */
    public function likeReply(Reply $reply)
    {
        $this->authorizeWhenLoggedIn();

        $reply->increment('likes_count');

        return back();
    }

    /**
     * Delete a comment (owner only)
     */
    public function destroy(Comment $comment)
    {
        $this->authorizeWhenLoggedIn();

        if ((int) $comment->user_id !== (int) Auth::id()) {
            abort(403, 'Anda tidak dapat menghapus komentar ini.');
        }

        // Remove replies first (in case no cascading is set), then delete comment
        $comment->replies()->delete();
        $comment->delete();

        return back()->with('status', 'Komentar berhasil dihapus.');
    }
}
