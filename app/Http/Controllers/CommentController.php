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

        $comment->increment('likes_count');

        // Redirect back to the article page
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
}
