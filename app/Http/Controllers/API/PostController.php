<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('category', 'tags')->orderByDesc('id')->paginate(12);
        return response()->json([
            'success' => true,
            'posts' => $posts
        ]);
    }
}
