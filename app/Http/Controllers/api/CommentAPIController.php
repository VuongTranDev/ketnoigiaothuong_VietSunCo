<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Services\CommentsServices;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentAPIController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $commentServices;
    public function __construct(CommentsServices $commentsS)
    {
        $this->commentServices = $commentsS;
    }
    public function index()
    {
        try {
            \Log::info("message");
            $comment = $this->commentServices->show();
            $formattedData = collect($comment->items())->map(function ($item) {
                return $this->commentServices->formatData($item);
            })->toArray();
            return $this->success($formattedData, "Comment success", 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed("Erorr, Comment not found", 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->commentServices->validateData($request);
        \Log::info('reqeseeee' . json_encode($request->user_id));
        if ($validator->fails())
            return $this->failed($validator->errors(), 400);
        $comment = $this->commentServices->store($request);
        return $this->success($comment, "Comment created", 200);
    }


    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            \Log::info('Message' .json_encode($request->all()));
            $comment = $this->commentServices->showById($id);
            if (!$comment) {
                return $this->failed("Comment not found", 404);
            }

            $validator = Validator::make($request->all(), [
                'edit_content' => 'required|string',
            ]);
            if ($validator->fails())
                return $this->failed($validator->errors()->toArray(), 404);
            $comment = $this->commentServices->update($request, $comment);
            return $this->success($comment, "Comment updated", 200);
    }
    public function destroy(string $id)
    {
        $comment = $this->commentServices->showById($id);
        if (!$comment) {
            return $this->failed("Comment not found", 404);
        }
        $this->commentServices->destroy($comment);
        return $this->success([], "Comment deleted", 200);
    }


}
