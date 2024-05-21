@extends('layouts.admin')


@section('content')

<header class="py-3 bg-dark text-white">
    <div class="container">
        <h1>Editing post: {{$post->title}}</h1>
    </div>

</header>


<div class="container py-5">

    @include('partials.validation-messages')
    @include('partials.session-messages')

    <form action="{{route('admin.posts.update', $post)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="titleHelper" placeholder="Learn php" value="{{old('title', $post->title)}}" />
            <small id="titleHelper" class="form-text text-muted">Type a title for this post</small>
            @error('title')
            <div class="text-danger py-2">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="d-flex gap-2 mb-3">
            <img width="200" src="{{$post->cover_image}}" alt="Image description for {{$post->title}}">
            <div>
                <label for="cover_image" class="form-label">Update cover image</label>
                <input type="text" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="Learn php" value="{{old('cover_image', $post->cover_image)}}" />
                <small id="cover_imageHelper" class="form-text text-muted">Type a cover_image for this post</small>
                @error('cover_image')
                <div class="text-danger py-2">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>



        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5">{{old('content', $post->content)}}</textarea>
            @error('content')
            <div class="text-danger py-2">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i>
            Save
        </button>



    </form>
</div>

@endsection