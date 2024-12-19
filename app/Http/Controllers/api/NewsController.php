<?php

namespace App\Http\Controllers\api;

use App\Services\NewsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class NewsController extends BaseController
{
    public $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->input('limit', 12);
            $page = $request->input('page', 1);

            $news = $this->newsService->show($page, $limit);

            $formattedData = collect($news->items())->map(function ($item) {
                return $this->newsService->formatDataSlug($item);
            })->toArray();

            $formattedPagination = $this->newsService->formatPaginate($news);

            return $this->successWithPagination(
                $formattedPagination,
                $formattedData,
                200,
            );
        } catch (ModelNotFoundException $e) {
            return $this->failed('Companies not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving companies', $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->newsService->validateData($request);
        if ($validator->fails()) {
            return $this->failed($validator->errors(), 400);
        }

        $news = $this->newsService->create($request);
        return $this->success($this->newsService->formatData($news), 'news created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $companycategory = $this->newsService->showById($id);

            if (!$companycategory) {
                return $this->failed('new not found!', 404);
            }

            return $this->success(
                $this->newsService->formatData($companycategory),
                'news retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving the company category', $e->getMessage(), 500);
        }
    }

    public function showBySlug($slug)
    {
        $news = $this->newsService->showBySlug($slug);

        if (!$news) {
            return $this->failed('news not found', 404);
        }

        return $this->success($this->newsService->formatDataSlug($news),  'news retrieved successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $this->newsService->validateData($request);

        if ($validator->fails()) {
            return $this->failed($validator->errors(), 422);
        }

        try {
            $news = $this->newsService->update($request, $id);
            return $this->success($this->newsService->formatData($news), 'news updated successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('news not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->newsService->delete($id);
            return $this->success([], 'news deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('news not found', 404);
        } catch (\Exception $e) {
            return $this->exception('an error occurred', $e->getMessage(), 500);
        }
    }

    public function showAllComments($slug)
    {
        $data = $this->newsService->showAllCommentInnews($slug);
        return $this->success($data, "Danh sách comment được lấy thành công", 200);
    }

    public function show5NewOfUser($user_id)
    {
        $data = $this->newsService->show5NewOfUser($user_id);
        \Log::info("data" . json_encode($data));
        return $this->success($data, "Danh sách bài viết của công ty được lấy thành công", 200);
    }


    public function countNewsOfUser($user_id)
    {
        $data = $this->newsService->countNewsOfUser($user_id);
        \Log::info("data" . json_encode($data));
        return $this->success($data, "Số lượng bài viết của công ty", 200);
    }

    public function showNewsByUserId($user_id)
    {
        $data = $this->newsService->showNewsByUserId($user_id);
        return $this->success($data, "Danh sách bài viết của công ty được lấy thành công", 200);
    }

    public function searchNews(Request $request)
    {
        $data = $this->newsService->searchNews($request);

        return $this->success($data,  'news retrieved successfully', 200);
    }
}
