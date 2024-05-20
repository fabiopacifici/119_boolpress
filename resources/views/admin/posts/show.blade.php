@extends('layouts.admin')

@section('content')

<header class="py-3 bg-dark text-white">
    <div class="container">
        <h1>{{$post->title}}</h1>
    </div>

</header>

<section class="py-5">
    <div class="container">


        <img src="{{$post->cover_image}}" alt="{{$post->title}}">


        <p>{{$post->content}}</p>


    </div>

</section>

@endsection