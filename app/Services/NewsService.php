<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Http\Request;
use App\Repositories\TagRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Validator;

class NewsService
{
    public function showData(Request $request)
    {
        $news = News::with('categories', 'users')->get();

        return $news;
    }

    public function formatData($news) {
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
    }

    public function validateData($request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'tag_name' => 'required|string',
            'content' => 'required|string',
            'cate_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        return $validator;
    }

    public function create($request) {
        $news = News::create([
            'title' => $request->title,
            'tag_name' => $request->tag_name,
            'content' => $request->content,
            'cate_id' => $request->cate_id,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return  $news;
    }
}

