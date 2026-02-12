<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $title = 'Messages | Wrietely';
        return view('chat.layout', compact('title'));
    }

    public function with($username)
    {
        $title = 'Messages with ' . $username . ' | Wrietely';
        return view('chat.layout', compact('title', 'username'));
    }
}
