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
                <p>{{$post->content}}</p>
            </div>
        </div>





    </div>

</section>

@endsection