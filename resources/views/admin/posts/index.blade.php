@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 col-xs-12"> 
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->body }}</p>
                                <p class="card-text">Slug : {{ $post->slug }}</p>
                                <p class="card-text">Updated : {{ $post->updated_at }}</p>
                                <p class="card-text">Created : {{ $post->created_at }}</p>

                                {{-- SHOW BUTTON --}}
                                <a href="{{route('posts.show', $post)}}" class="btn btn-dark float-right mr-3">Read</a>
                                <a href="{{route('posts.edit', $post)}}" class="btn btn-dark float-right mr-3">Edit</a>
                                <a href="{{route('posts.destroy', $post)}}" class="btn btn-dark float-right mr-3">Delete</a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>  
@endsection