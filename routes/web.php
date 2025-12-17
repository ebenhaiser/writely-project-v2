<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/category', [PageController::class, 'category'])->name('category');

Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/id/{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::fallback(function () {
    return redirect('/');
});






// Route::get('/', function () {
//     return view('welcome');
// })->name('home');


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
//     Volt::route('settings/password', 'settings.password')->name('user-password.edit');
//     Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

//     Volt::route('settings/two-factor', 'settings.two-factor')
//         ->middleware(
//             when(
//                 Features::canManageTwoFactorAuthentication()
//                     && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
//                 ['password.confirm'],
//                 [],
//             ),
//         )
//         ->name('two-factor.show');
// });
