@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <h2>Edit story</h2>

            <form method="POST" action="{{route('admin.posts.update', $post)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <div class="form-group">
                        <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}">
                        @error('title')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="5">{{ $post->body }}</textarea>
                    @error('body')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="body">Image</label>
                        <input class="form-control" type="file" name="image_path" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="mr-4 text-bold" for="tags">Tags</label>
                        @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" 
                        {{($post->tags->contains($tag->id) ? 'checked' : '')}}>

                        <span class="mr-4">{{$tag->name}}</span>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-outline-dark">Update</button>

                </form>

            </div>
        </div>
    </div>
@endsection