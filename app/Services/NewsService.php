<?php

namespace App\Services;

use App\Models\Comments;
use App\Models\News;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
     * @param string $slug
     * @return News|null
     */
    public function showBySlug($slug)
    {
        return News::with('categories', 'users')->where('slug', $slug)->first();
    }

    public function showById($id)
    {
        return News::with('categories', 'users')->where('id', $id)->first();
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
            'slug' => $news->slug,
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
            'content' => 'required',
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
        $slug = Str::slug($request->title);

        return News::create([
            'title' => $request->title,
            'slug' => $slug,
            'tag_name' => $request->tag_name,
            'content' => $request->content,
            'cate_id' => $request->cate_id,
            'user_id' => $request->user_id,
        ]);
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

        $slug = Str::slug($request->title);

        $news->update([
            'title' => $request->title,
            'slug' => $slug,
            'tag_name' => $request->tag_name,
            'content' => $request->content,
            'cate_id' => $request->cate_id,
            'user_id' => $request->user_id,
        ]);

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

    public function showAllCommentInnews($slug)
    {
       /// $data = DB::select('CALL proc_selectCommentInNews(?)', [$slug]);
        $data = News::with('comments.user')->where('slug', $slug)->first();
        return $data;
    }

    public function show5NewOfUser($user_id)
    {
        // Thống kê ra 5 bài viết của công ty có nhiều lượt bình luận nhất
        return News::withCount('comments')
        ->where('user_id', $user_id)
        ->orderBy('comments_count', 'desc')
        ->limit(5)
        ->get();
    }

    public function countNewsOfUser($user_id)
    {
        return News::where('user_id', $user_id)
        ->count();
    }

    public function changeStatus(Request $request,$id)
    {
        $company = News::findOrFail($id);
        $company->status = $request->status;
        $company->save() ;
        return $company;
    }

}
