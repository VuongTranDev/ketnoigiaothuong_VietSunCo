<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Http\Request;
use App\Repositories\TagRepository;
use App\Repositories\PostRepository;

class NewsService
{
    public function showData(Request $request)
    {
        $news = News::with('categories', 'users')->get();
        $format = $news->map(function ($news) {
            return [
                'id' => $news->id,
                'title' => $news->title,
                'tag_name' => $news->tag_name,
                'content' => $news->content,
                'categorie' => $news->categories,
                'user' => $news->users,
                'created_at' => $news->created_at,
                'updated_at' => $news->updated_at
            ];
        });

        return $format;
    }
}

