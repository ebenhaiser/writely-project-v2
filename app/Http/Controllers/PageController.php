<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function category($category_slug = null)
    {
        $title = 'Posts Category | Writely.';
        return view('category', compact('title', 'category_slug'));
    }
}
