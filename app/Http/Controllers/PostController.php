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
}
