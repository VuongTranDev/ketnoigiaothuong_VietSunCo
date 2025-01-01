<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($id)
    {
        return view('frontend.partner.news.comments.index', compact('id')) ;
    }
}
