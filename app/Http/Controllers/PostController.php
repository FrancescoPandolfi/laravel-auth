<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Guest e admin

    public function index()
    {
        
        return view('guest.posts.index', ['posts' => Post::All()]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        abort_if(empty($post), 404);


        return view('guest.posts.show', ['post' => $post]);
    }
}
