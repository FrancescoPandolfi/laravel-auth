@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

            </div>

            <div class="flex-center position-ref">
    
                <div class="content mt-5">
                    <div class="sm-title mb-5">
                    Dear {{Auth::user()->name}}, <br> welcome to The Useless Blog
                    </div>
    
                    <div class="links">
                    <a href="{{route('posts.index')}}">All Posts</a>
                    <a href="{{route('admin.posts.index')}}">Your Posts</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
