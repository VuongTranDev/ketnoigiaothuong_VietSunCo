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
        $data = $this->newsService->showData($request);
        return $this->success($data, 200, 'News retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->newsService->validateData($request);

        if ($validator->fails()) {
            $this->failedValidation( $validator->errors(), 400);
        }

        $news = $this->newsService->create($request);

        $format = $this->formatData($news);
        return $this->success($format, 201, 'News created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::with('users', 'categories')->find($id);

        if ($news == null) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Id news not found!'
            ], 500);
        }

        $format =  [
            'id' => $news->id,
            'title' => $news->title,
            'tag_name' => $news->tag_name,
            'content' => $news->content,
            'categorie' => $news->categories,
            'user' => $news->users,
            'created_at' => $news->created_at,
            'updated_at' => $news->updated_at
        ];

        if ($news == null) {
            return response()->json([
                'status' => 'Error',
                'message' => 'News not found!'
            ], 404);
            $this->failed('News not found', 404);
        } else {
            return response()->json([
                'status' => 'Succes',
                'data' => $format
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'tag_name' => 'required|string|max:255',
                'content' => 'required|string',
                'cate_id' => 'required|exists:categories,id',
                'user_id' => 'required|exists:users,id',
            ]);

            $news = News::findOrFail($id);
            $news->update($validatedData);

            $format =  [
                'id' => $news->id,
                'title' => $news->title,
                'tag_name' => $news->tag_name,
                'content' => $news->content,
                'categorie' => $news->categories,
                'user' => $news->users,
                'created_at' => $news->created_at,
                'updated_at' => $news->updated_at
            ];

            return response()->json([
                'status' => "Success",
                'message' => "Update news success",
                'data' => $format
            ]);
        } catch (ValidationException $e) {
            // Handling authentication errors
            return response()->json([
                'status' => 'Error',
                'message' => $e->validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (ModelNotFoundException $e) {
            // Handling cases where the company is not found
            return response()->json([
                'status' => 'Error',
                'message' => 'News not found',
                'error' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Handle other errors (e.g. database errors)
            return response()->json([
                'status' => 'Error',
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $news = News::findOrFail($id);

            $news->delete();

            return response()->json([
                'status' => "Success",
                'message' => 'News deleted successfully'
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            // Handling cases where the company is not found
            return response()->json([
                'status' => 'Error',
                'message' => 'News not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Handle other errors
            return response()->json([
                'status' => 'Error',
                'message' => 'An error occurred', 'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}