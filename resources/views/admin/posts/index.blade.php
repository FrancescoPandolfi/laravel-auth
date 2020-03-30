@extends('layouts.app')

@section('content')

@if (session('delete'))
<div class="alert alert-success">
    {{ session('delete') }}
</div>
@endif 

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

                                {{-- BUTTONS --}}
                                <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-success float-right mr-3">Edit</a>
                                <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-success float-right mr-3">Read</a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>  
@endsection