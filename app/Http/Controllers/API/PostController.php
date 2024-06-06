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

    public function show($id)
    {
        $post = Post::with('user', 'category', 'tags')->where('id', $id)->first();

        if ($post) {
            // return the object
            return response()->json([
                'success' => true,
                'response' => $post,
            ]);

        } else {
            // return an error response for a future 404
            return response()->json([
                'success' => false,
                'response' => '404 Sorry nothing found!',
            ]);
        }

    }
}
