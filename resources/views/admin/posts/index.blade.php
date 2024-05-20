@extends('layouts.admin')

@section('content')

<header class="py-3 bg-dark text-white">
    <div class="container d-flex align-items-center justify-content-between">
        <h1>Posts</h1>

        <a class="btn btn-primary" href="{{route('admin.posts.create')}}"><i class="fas fa-pencil fa-xs fa-fw"></i> New Post</a>
    </div>

</header>

<section class="py-5">
    <div class="container">
        <h4 class="text-muted">All posts</h4>
        <div class="table-responsive">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cover Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($posts as $post )
                    <tr class="">
                        <td scope="row">{{$post->id}}</td>
                        <td>
                            <img width="140" src="{{$post->cover_image}}" alt="{{$post->title}}">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>

                            <a class="btn btn-dark" href="{{route('admin.posts.show', $post)}}">
                                <i class="fas fa-eye fa-xs fa-fw"></i>
                                <span style="font-size: 0.7rem" class="text-uppercase">View</span>
                            </a>
                            /edit/delete
                        </td>

                    </tr>

                    @empty

                    <tr class="">
                        <td scope="row" colspan="5">No posts yet!😎</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

</section>

@endsection