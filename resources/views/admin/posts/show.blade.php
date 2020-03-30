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

                                {{-- SHOW BUTTON --}}
                                <a href="{{route('admin.posts.destroy', $post->slug)}}" class="btn btn-danger float-right mr-3">Delete</a>
                                <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-success float-right mr-3">Edit</a>
                                
                            </div>
                        </div>
                    </div>
        </div>
    </div>  
@endsection