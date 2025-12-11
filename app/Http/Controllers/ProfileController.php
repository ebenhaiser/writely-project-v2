<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('home');
        }
        return view('profile.show', compact('username'));
    }
}
