<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username)
    {
        return view('profile.show', compact('username'));
    }
}
