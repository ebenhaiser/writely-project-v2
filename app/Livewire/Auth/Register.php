<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $step = 1;
    public $stepPassed = 1;

    public $firstName;
    public $lastName;

    public $email;
    public $username;

    public $password;
    public $confirm_password;

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function previousBtn()
    {
        $this->step -= 1;
    }

    public function submitStep1()
    {
        $this->validate([
            'firstName' => 'required',
        ]);
        $this->stepPassed = 2;
        $this->step = 2;
    }

    public function submitStep2()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
        ]);

        $this->stepPassed = 3;
        $this->step = 3;
    }

    public function submitStep3()
    {
        $this->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $this->register();
    }

    private function register()
    {
        $this->resetErrorBag();

        $user = User::create([
            'name' => trim($this->firstName . ' ' . $this->lastName),
            'email' => trim($this->email),
            'username' => trim($this->username),
            'password' => Hash::make($this->username)
        ]);

        Auth::login($user);
        $this->reset();

        return redirect()->route('profile.setting', ['username' => Auth::user()->username]);
    }
}
