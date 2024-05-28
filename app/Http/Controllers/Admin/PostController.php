<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Post::all());
        return view('admin.posts.index', ['posts' => Post::where('user_id', Auth::id())->orderByDesc('id')->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //dd($request->all());
        //dd(Auth::user());
        // validate
        $validated = $request->validated();

        //dd($validated);
        $slug = Str::slug($request->title, '-');

        $validated['slug'] = $slug;
        // create

        if ($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $validated['cover_image']);
            //dd($validated, $image_path);
            $validated['cover_image'] = $image_path;
        }

        //dd($validated);
        $validated['user_id'] = Auth::id();

        //dd($validated);

        $post = Post::create($validated);
        if ($request->has('tags')) {
            $post->tags()->attach($validated['tags']);
        }
        // redirect
        return to_route('admin.posts.index')->with('message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //dd($request->all());
        if (Auth::id() === $post->user_id || auth()->user()->is_super_admin()) {
            $categories = Category::all();
            $tags = Tag::all();
            $selectedTags = $post->tags->pluck('id')->toArray();
            return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
        }
        abort(403, "Don't try to mess up with other users posts");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        //dd($request->all());
        // validate
        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        //dd($validated);

        if ($request->has('cover_image')) {


            if ($post->cover_image) {
                // delete the old image
                Storage::delete($post->cover_image);
            }

            $image_path = Storage::put('uploads', $validated['cover_image']);
            //dd($validated, $image_path);
            $validated['cover_image'] = $image_path;
        }


        // update
        $post->update($validated);


        if ($request->has('tags')) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->sync([]);
        }



        //redirect
        return to_route('admin.posts.edit', $post)->with('message', "Post $post->title update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        //$post->tags()->detach();

        if ($post->cover_image) {
            // delete the old image
            Storage::delete($post->cover_image);
        }
        $post->delete();
        return to_route('admin.posts.index')->with('message', "Post $post->title deleted successfully");
    }
}
