<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('home');
        }

        $title = '@' . $user->username;
        if ($user->id == Auth::id()) {
            $title = $title . ' (You)';
        }
        $title = $title . ' | Writely.';
        $userId = $user->id;

        return view('profile.show', compact('userId', 'title'));
    }

    public function setting()
    {
        $title = 'Edit Profile | Writely.';

        return view('profile.setting', compact('title'));
    }

    public function history()
    {
        $title = 'Your History | Writely.';
        return view('profile.history', compact('title'));
    }

    public function bookmark()
    {
        $title = 'Your Bookmarks | Writely.';
        return view('profile.bookmark', compact('title'));
    }
}
