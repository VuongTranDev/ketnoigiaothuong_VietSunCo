<?php

namespace App\Http\Controllers\api;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
                return $this->newsService->formatData($item);
            })->toArray();

            $formattedPagination = $this->newsService->formatPaginate($news);
            return $this->successWithPagination($formattedPagination, $formattedData, 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('News not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving news', $e->getMessage(), 500);
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
        return $this->success($this->newsService->formatData($news), 201, 'news created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = $this->newsService->showById($id);

        if (!$news) {
            return $this->failed('news not found', 404);
        }

        return $this->success($this->newsService->formatData($news), 200, 'news retrieved successfully');
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
            return $this->success($this->newsService->formatData($news), 200, 'news updated successfully');
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
            return $this->success([], 200, 'news deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->failed('news not found', 404);
        } catch (\Exception $e) {
            return $this->exception('an error occurred', $e->getMessage(), 500);
        }
    }
}
