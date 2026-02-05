<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show($slug)
    {
        if ($slug === 'create') {
            return redirect()->route('post.create');
        }
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('home');
        }
        $postId = $post->id;
        $title = $post->title . ' by ' . $post->user->name . ' | Writely.';
        return view('post.show', compact('postId', 'title'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $title = 'Create Post | Writely.';
        return view('post.create', compact('title'));
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (Auth::user()->id !== $post->user->id) {
            return redirect()->route('post.show', ['slug' => $slug]);
        }

        $title = '(Edit)' . $post->title . ' by ' . $post->user->name . ' | Writely.';
        return view('post.create', compact('post', 'title'));
    }
}
