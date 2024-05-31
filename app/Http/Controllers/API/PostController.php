<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->orderByDesc('id')->paginate(12);

        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }

    public function latest()
    {
        $posts = Post::with('category', 'tags')->orderByDesc('id')->take(4)->get();

        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }
}
