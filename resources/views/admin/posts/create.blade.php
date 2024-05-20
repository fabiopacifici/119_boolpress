@extends('layouts.admin')


@section('content')

<header class="py-3 bg-dark text-white">
    <div class="container">
        <h1>Writing post</h1>
    </div>

</header>


<div class="container py-5">

    @if($errors->any())

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>

    @endif

    <form action="{{route('admin.posts.store')}}" method="post">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="titleHelper" placeholder="Learn php" value="{{old('title')}}" />
            <small id="titleHelper" class="form-text text-muted">Type a title for this post</small>
            @error('title')
            <div class="text-danger py-2">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">cover_image</label>
            <input type="text" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="Learn php" />
            <small id="cover_imageHelper" class="form-text text-muted">Type a cover_image for this post</small>
            @error('cover_image')
            <div class="text-danger py-2">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5">{{old('content')}}</textarea>
            @error('content')
            <div class="text-danger py-2">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Create
        </button>



    </form>
</div>

@endsection