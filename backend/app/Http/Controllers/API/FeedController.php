<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Article::latest()->take(20)->get();
        return response()->json($posts);
    }
}

