<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string'
            ]);
        
        $comment = Comment::create([
            'post_id' => $post->id,
            'name' => $validatedData['name'],
            'body' => $validatedData['body'],
        ]);

        return redirect(route('admin.posts.show', ['post' => $post->slug]));
    }
}