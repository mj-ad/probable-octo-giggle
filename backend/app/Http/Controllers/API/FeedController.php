<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(20)->get();
        return response()->json($posts);
    }
}

