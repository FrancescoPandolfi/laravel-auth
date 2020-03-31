<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\User;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    // Just for admin

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function create()
    {
        return view('admin.posts.create', ['tags' => Tag::all()]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
            ]);
        
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'slug' => Str::slug($request->title) . '-' . rand(1,10000)
        ]);

        return redirect(route('admin.posts.show', ['post' => $post->slug]));
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        abort_if(empty($post), 404);
        return view('admin.posts.show', ['post' => $post]);
    }


    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.edit', ['post' => $post]);
    }


    public function update(Request $request, Post $post)
    {

        if ($post->user->id != Auth::user()->id) {
            abort(404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'updated_at' => Carbon::now()
        ]);

        return redirect(route('admin.posts.show', ['post' => $post->slug]));
    }


 
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', " You deleted the post with id: $post->id");
    }
}
