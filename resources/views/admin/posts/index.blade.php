@extends('layouts.app')

@section('content')

@if (session('delete'))
<div class="alert alert-success">
    {{ session('delete') }}
</div>
@endif 

    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1>My stories</h1>
            </div>
            <div class="col-4">
                <a href="{{route('admin.posts.create')}}" class="btn btn-outline-dark float-right mb-4">New story</a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Published</li>
                    <li class="list-group-item">Draft</li>
                  </ul>
            </div>
        </div>
        <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 col-xs-12"> 
                        <div class="card mb-3">
                            <div class="card-body">
                                @if (!empty($post->image_path))
                                <img class="image mb-3" src="{{asset('storage/' . $post->image_path)}}" alt=""> @endif
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->body }}</p>
                                <p class="card-text">Slug : {{ $post->slug }}</p>
                                <p class="card-text">Updated : {{ $post->updated_at }}</p>
                                <p class="card-text">Created : {{ $post->created_at }}</p>

                                {{-- BUTTONS --}}
                                <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-outline-dark float-right">Edit</a>
                                <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-outline-dark float-right mr-3">Read</a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>  
@endsection