@extends('layouts.admin')

@section('content')

<header class="py-3 bg-dark text-white">
    <div class="container">
        <h1>{{$post->title}}</h1>
    </div>

</header>

<section class="py-5">
    <div class="container">

        <div class="row">
            <div class="col">

                @if(Str::startsWith($post->cover_image, 'https://'))
                <img class="img-fluid" loading="lazy" src="{{$post->cover_image}}" alt="{{$post->title}}">
                @else
                <img class="img-fluid" loading="lazy" src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}}">

                @endif
            </div>

            <div class="col">
                <h5 class="text-muted">{{$post->slug}}</h5>
                <h3 class="text-muted">{{$post->title}}</h3>
                <div class="metadata">
                    <strong>Category</strong> {{$post->category ? $post->category->name : 'Uncategorized' }}
                    <br>
                    <strong>Tags</strong>
                    @forelse ($post->tags as $tag )

                    <span class="badge bg-dark">{{$tag->name}}</span>

                    @empty
                    <span class="badge bg-dark"> n/a </span>
                    @endforelse
                    <strong>Author</strong> {{$post->user ? $post->user->name : 'N/A'}}
                </div>
                <p>{{$post->content}}</p>
            </div>
        </div>





    </div>

</section>

@endsection
