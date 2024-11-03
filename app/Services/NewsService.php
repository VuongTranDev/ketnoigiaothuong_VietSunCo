<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsService
{
    /**
     * Retrieve all news items with related categories and user data.
     *
     * @param int $page
     * @param int $limit
     * @return
     */
    public function show($page, $limit)
    {
        return News::with('categories', 'users')->paginate($limit, ['*'], 'page', $page);
    }

    /**
     * Retrieve a specific news item by its ID, including related categories and user data.
     *
     * @param int $id
     * @return News|null
     */
    public function showById($id)
    {
        return News::with('categories', 'users')->find($id);
    }

    /**
     * Format news data for a structured API response.
     *
     * @param mixed $news
     * @return array
     */
    public function formatData($news)
    {
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

    /**
     * Format pagination data for a structured API response.
     *
     * @param mixed $news
     * @return array
     */
    public function formatPaginate($news)
    {
        return [
            'current_page' => $news->currentPage(),
            'total_page' => $news->lastPage(),
            'total_items' => $news->total(),
            'items_per_page' => $news->perPage()
        ];
    }

    /**
     * Validate the data for creating or updating a news item.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($request)
    {
        return Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'tag_name' => 'required|string|max:255',
            'content' => 'required|string',
            'cate_id' => 'required|exists:categories,id',
            'user_id' => 'exists:users,id',
        ]);
    }

    /**
     * Create a new news record in the database.
     *
     * @param Request $request
     * @return News
     */
    public function create($request)
    {
        return News::create(
            $request->only('title', 'tag_name', 'content', 'cate_id', 'user_id')
        );
    }

    /**
     * Update an existing news record in the database by its ID.
     *
     * @param Request $request
     * @param int $id
     * @return News
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($request, $id)
    {
        $news = News::findOrFail($id);
        $news->update($request->only('title', 'tag_name', 'content', 'cate_id', 'user_id'));
        return $news;
    }

    /**
     * Delete a news record from the database by its ID.
     *
     * @param int $id
     * @return News
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return $news;
    }
}
