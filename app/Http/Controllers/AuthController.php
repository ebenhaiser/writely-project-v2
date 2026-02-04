<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1️⃣ Kalau sudah login, jangan ke login lagi
        if (Auth::check()) {
            return redirect()->back();
        }

        // 2️⃣ Kalau returnUrl sudah dikirim, langsung tampilkan halaman login
        if ($request->filled('returnUrl')) {
            return view('auth.login', [
                'returnUrl' => $request->returnUrl
            ]);
        }

        // 3️⃣ Ambil previous URL
        $previousUrl = url()->previous();
        $currentUrl  = url()->current();

        // 4️⃣ Daftar URL yang tidak boleh dijadikan returnUrl
        $blockedPaths = [
            '%2Flogin',
            '%2Fregister',
            '%2Flogout',
            '%2Fpassword',
            '%2Fmessage',
            '%2Fhistory',
            '%2Fedit',
            '%2Fsetting',
        ];

        // 5️⃣ Validasi previous URL
        foreach ($blockedPaths as $path) {
            if (str_contains($previousUrl, $path)) {
                return redirect()->route('login');
            }
        }

        if ($previousUrl !== $currentUrl) {
            return redirect()->route('login', [
                'returnUrl' => $previousUrl
            ]);
        }

        // 6️⃣ Fallback
        return redirect()->route('login');
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
