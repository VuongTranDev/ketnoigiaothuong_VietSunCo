<?php

namespace App\Services;

use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class  CommentsServices
{

    /**
     * Undocumented function
     *
     * @return
     */
    public function show()
    {
        $com = Comments::with('news', 'users')->get();
        return $com;
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return Comments|null
     */
    public function showById($id)
    {
        return Comments::findOrFail($id) ;
    }

    /**
     * Undocumented function
     * @param mixed $com
     * @return array
     */
    public function formatDaTa($com)
    {
            return[
                'id' => $com->id,
                'content' => $com->content,
                'new' =>$com->news,
                'users' => $com->users
            ];

    }
    public function validateData($request)
    {
        $validator = Validator::make($request->all(),[
            'content'=>'required|string',
            'new_id' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);
        return $validator ;
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        $comment = Comments::create([
            'content' => $request->input('content'),
            'new_id' => $request->input('new_id'),
            'user_id' => $request->input('user_id'),
            'created_at' =>Carbon::parse(now()->format('d-m-Y')),
            'updated_at'  =>Carbon::parse(now()->format('d-m-Y'))
        ]) ;
        return $comment;
    }


    public function update(Request $request,Comments $comment)
    {

        $comment->update([
            'content' => $request->edit_content,
            'updated_at'=>Carbon::parse(now()->format('d-m-Y'))
        ]);
        return $comment ;
    }

    /**
     * Undocumented function
     *
     * @param Comment $comment
     * @return void
     */
    public function destroy($comment)
    {
            $comment->delete();
            return true ;

    }









}
