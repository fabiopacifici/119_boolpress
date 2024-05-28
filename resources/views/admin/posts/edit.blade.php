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

    <form action="{{route('admin.posts.update', $post)}}" method="post" enctype="multipart/form-data">
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
            @if(Str::startsWith($post->cover_image, 'https://'))
            <img width="140" src="{{$post->cover_image}}" alt="{{$post->title}}">
            @else
            <img width="140" src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}}">
            @endif
            <div>
                <label for="cover_image" class="form-label">Update cover image</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="Learn php" value="{{old('cover_image', $post->cover_image)}}" />
                <small id="cover_imageHelper" class="form-text text-muted">Type a cover_image for this post</small>
                @error('cover_image')
                <div class="text-danger py-2">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id">
                <option selected disabled>Select a category</option>
                @foreach ($categories as $category )
                <option value="{{$category->id}}" {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''  }}>{{$category->name}}</option>
                @endforeach

            </select>
        </div>


        <div class="mb-3 d-flex gap-3 flex-wrap">



            @foreach ($tags as $tag)

            <!-- if there are errors -->
            @if($errors->any())

            <div class="form-check">
                <input name="tags[]" class="form-check-input " type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}} </label>

            </div>
            @else
            <div class="form-check">

                <!-- <input name="tags[]" class="form-check-input " type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'checked' : ''}} />
                <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}} </label> -->

                <input name="tags[]" class="form-check-input " type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ $post->tags->contains($tag) ? 'checked' : ''}} />
                <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}} </label>


                <!--    <input name="tags[]" class="form-check-input " type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ $post->tags->find($tag->id) ? 'checked' : ''}} />
                <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}} </label> -->

                <!--  <input name="tags[]" class="form-check-input " type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ in_array($tag->id, $selectedTags) ? 'checked' : ''}} />
                <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}} </label> -->
            </div>

            @endif

            <!-- otherwise -->


            @endforeach




        </div>
        @error('tags')
        <div class="text-danger py-2">
            {{$message}}
        </div>
        @enderror



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
