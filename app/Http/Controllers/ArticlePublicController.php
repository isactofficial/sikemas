<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ArticlePublicController extends Controller
{
    // List articles for public page
    public function index(Request $request)
    {
        // Load categories only if the tables exist to avoid SQL errors on setups
        $hasCategoryTables = Schema::hasTable('article_categories') && Schema::hasTable('article_category_pivot');

        $query = Article::published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->select(['id','title','slug','thumbnail','deskripsi','views','published_at','created_at']);

        if ($hasCategoryTables) {
            $query->with('categories');
        }

        $articles = $query->get();

        // Shape lightweight array for the existing front-end JS
    $articlesJS = $articles->map(function ($a) use ($hasCategoryTables) {
            return [
                'id'    => $a->id,
                'title' => $a->title,
                'slug'  => $a->slug,
                'date'  => $a->formatted_date,
                // Use created_at from DB for display/sorting on the list page
                'ts'    => optional($a->created_at)->getTimestampMs(),
                'pop'   => (int) $a->views,
                'img'   => $a->thumbnail_url,
                'deskripsi'=> $a->short_deskripsi,
                // Front-end filter expects an array of category names under key 'cat'
                'cat'   => $hasCategoryTables && isset($a->categories)
                    ? $a->categories->pluck('name')->values()->all()
                    : [],
            ];
        });

        return view('artikel', [
            'articles' => $articles,
            'articlesJS' => $articlesJS,
        ]);
    }

    // Show one article by slug
    public function show($slug)
    {
        // Guard categories loading in case category tables are not present
        $hasCategoryTables = Schema::hasTable('article_categories') && Schema::hasTable('article_category_pivot');

        $query = Article::where('slug', $slug)->with([
            'contents',
            'editor',
            'comments.user',
            'comments.replies.user',
        ]);
        if ($hasCategoryTables) {
            $query->with('categories');
        }

        $article = $query->firstOrFail();
        if ($article->isPublished()) {
            $article->incrementViews();
        }
        return view('detail_artikel', [
            'article' => $article,
            'hasCategoryTables' => $hasCategoryTables,
        ]);
    }
}