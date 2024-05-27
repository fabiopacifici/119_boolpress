@extends('layouts.admin')


@section('content')

<header class="py-3 bg-dark text-white">
    <div class="container">
        <h1>Writing post</h1>
    </div>

</header>


<div class="container py-5">

    @include('partials.validation-messages')


    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
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
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="Learn php" value="{{old('cover_image')}}" />
            <small id="cover_imageHelper" class="form-text text-muted">Type a cover_image for this post</small>
            @error('cover_image')
            <div class="text-danger py-2">
                {{$message}}
            </div>
            @enderror
        </div>



        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id">
                <option selected disabled>Select a category</option>
                @foreach ($categories as $category )
                <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''  }}>{{$category->name}}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3 d-flex gap-3 flex-wrap">



            @foreach ($tags as $tag)
            <div class="form-check">

                <input name="tags[]" class="form-check-input " type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}} </label>

            </div>

            @endforeach



        </div>
        @error('tags')
        <div class="text-danger py-2">
            {{$message}}
        </div>
        @enderror



        <!--
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <select multiple class="form-select form-select-lg" name="tags[]" id="tags">
                <option selected disabled>Select one</option>
                @foreach ($tags as $tag )
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div> -->




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
