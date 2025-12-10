<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('auth.login');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
