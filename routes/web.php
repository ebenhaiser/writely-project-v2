<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/id/username', function () {
    return view('profile.index');
})->name('profile');
Route::get('/id/username/likes', function () {
    return view('profile.index');
})->name('profile.likes');
Route::get('/id/username/comments', function () {
    return view('profile.index');
})->name('profile.comments');
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');







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
