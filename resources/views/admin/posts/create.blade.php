@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <h2>Add new post</h2>

            <form method="POST" action="{{route('admin.posts.store')}}">
                    @csrf
            
                    <div class="form-group">
                        <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                        @error('title')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="5">{{old('body')}}</textarea>
                    @error('body')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                    </div>

                    
                    <div class="form-group">
                        <label class="mr-4 text-bold" for="tags">Tags</label>
                        @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                        <span class="mr-4">{{$tag->name}}</span>
                            
                        @endforeach
                    </div>


                    <button type="submit" class="btn btn-primary">Save</button>

                </form>

            </div>
        </div>
    </div>
@endsection