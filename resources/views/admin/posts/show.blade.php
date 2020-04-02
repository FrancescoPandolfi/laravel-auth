@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
                    <div class="col"> 
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="img-show"><img src="{{asset('storage/' . $post->image_path)}}" alt=""></div>
                                
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->body }}</p>
                                <p class="card-text">Slug : {{ $post->slug }}</p>
                                <p class="card-text">Updated : {{ $post->updated_at }}</p>
                                <p class="card-text">Created : {{ $post->created_at }}</p>
                                <p class="card-text">ID : {{ $post->id }}</p>

                                <form action="{{route('admin.posts.destroy', $post)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-dark float-right ">Delete</button>
                                </form>

                                <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-outline-dark float-right mr-3">Edit</a>
                                
                            </div>
                        </div>
                    </div>
        </div>
        <div class="row">
            <div class="col">
                <h4 class="mt-3">Tags</h4>
                @foreach ($post->tags as $tag)
                <button type="button" class="btn btn-secondary btn-lg" disabled>{{$tag->name}}</button>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col">       
                <h3 class="mt-5">Comments</h3>
                <ul class="list-group">
                    @forelse ($post->comments()->latest()->get() as $comment)
                        <li class="list-group-item">
                            <h5 class="font-weight-bolder">{{$comment->body}}</h5>
                            <p class="text-secondary">--{{$comment->name}}</p>
                            @auth
                            <form action="{{route('admin.comments.destroy', $comment->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                            </form>
                            @endauth
                        </li>  
                        @empty
                        <li class="list-group-item">No comments</li>
                    @endforelse
                </ul>
            </div>
                      </div>
            </div>
        </div>
    </div>  
@endsection