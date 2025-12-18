<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        if ($request->has('returnUrl')) {
            return view('auth.login', ['returnUrl' => $request->returnUrl]);
        }

        $previousUrl = url()->previous();
        $currentUrl = url()->current();

        if (
            $previousUrl !== $currentUrl &&
            !str_contains($previousUrl, '/login') &&
            !str_contains($previousUrl, '/register') &&
            !str_contains($previousUrl, '/logout') &&
            !str_contains($previousUrl, '/password') &&
            !str_contains($previousUrl, '/message') &&
            !str_contains($previousUrl, '/history') &&
            !str_contains($previousUrl, '/edit') &&
            !str_contains($previousUrl, '/setting')
        ) {
            return redirect()->route('auth.login', ['returnUrl' => $previousUrl]);
        }
        // return view('auth.login');
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
