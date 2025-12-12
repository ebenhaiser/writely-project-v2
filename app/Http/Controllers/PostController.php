<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $title = $post->title . ' by ' . $post->user->name . ' | Writely.';
        return view('post.show', compact('post', 'title'));
    }
}
