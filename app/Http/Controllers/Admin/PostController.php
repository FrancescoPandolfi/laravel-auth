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
use Illuminate\Support\Facades\Storage;

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


        $validatedData = $request->validate($this->data());

        $path = Storage::disk('public')->put('images', $request->image_path);
        
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'slug' => Str::slug($request->title) . '-' . rand(1,10000),
            'image_path' => $path
        ]);

        $tagsArray = $request->tags;
            if(!empty($tagsArray)){
                $post->tags()->attach($tagsArray);
            }
        
        return redirect(route('admin.posts.show', ['post' => $post->slug]));
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('admin.posts.show', ['post' => $post]);
    }


    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all()
        ]);
    }

    protected function data()
    {
        return
        $dataToValidate = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image_path' => 'image'
        ];
    }
 
    public function update(Request $request, Post $post)
    {
        // dd(empty($request->tags));

        if ($post->user->id != Auth::user()->id) {
            abort(404);
        }

        $validatedData = $request->validate($this->data());

        if (!empty($request->image_path)) {
            $path = Storage::disk('public')->put('images', $request->image_path);
            $post->update(['image_path' => $path]);
        }

        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'updated_at' => Carbon::now()
        ]);



        if (!empty($request->tags)) {
            $tagsArray = $request->tags;
            foreach ($tagsArray as $key => $tag) {
                if(empty(Tag::find($tag))) {
                    unset($tagsArray[$key]);
                }
            }
        }
            if(!empty($tagsArray)){
                $post->tags()->sync($tagsArray);
            }

        return redirect(route('admin.posts.show', ['post' => $post->slug]));
    }


 
    public function destroy(Post $post)
    {
        abort_if(empty($post), 404);

        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', " You deleted the post with id: $post->id");
    }
}
