<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email, $password;
    public $returnUrl;


    public function mount()
    {
        if (request()->has('returnUrl')) {
            $this->returnUrl = request()->get('returnUrl');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function submit()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            session()->regenerate();

            if ($this->returnUrl) {
                return redirect()->to($this->returnUrl);
            }

            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'loginFailed' => 'Invalid email or password. Please try again.',
        ]);
    }
}
