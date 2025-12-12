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

        return view('profile.show', compact('username', 'title'));
    }
}
