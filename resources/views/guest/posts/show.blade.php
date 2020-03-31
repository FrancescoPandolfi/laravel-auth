@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
                    <div class="col"> 
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->body }}</p>
                                <p class="card-text">Slug : {{ $post->slug }}</p>
                                <p class="card-text">Updated : {{ $post->updated_at }}</p>
                                <p class="card-text">Created : {{ $post->created_at }}</p>
                                <p class="card-text">ID : {{ $post->id }}</p>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="mt-3">Leave a comment</h3>
                    <form action="{{route('comments.store', $post)}}" method="POST">
                        @csrf
                        <div class="form-row mt-4">
                            <div class="col">
                            <input type="text" name="name" class="form-control mb-2" placeholder="Name">
                            <textarea name="body" class="form-control" placeholder="Comment"></textarea>
                            <button type="submit" class="btn btn-success mt-2">Send</button>
                    </form>
                           
                            <h3 class="mt-5">Comments</h3>
                            <ul class="list-group">
                                @forelse ($post->comments()->latest()->get() as $comment)
                                    <li class="list-group-item">
                                        <h5 class="font-weight-bolder">{{$comment->body}}</h5>
                                        <p class="text-secondary">--{{$comment->name}}</p>
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