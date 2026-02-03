<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;

class Login extends Component
{
    #[Validate('required')]
    public $login;

    #[Validate('required')]
    public $password;

    public $returnUrl = null;



    public function mount($returnUrl)
    {
        if ($returnUrl) {
            $this->returnUrl = $returnUrl;
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function submit()
    {
        $this->validate();

        $field = filter_var($this->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::attempt([
            $field => $this->login,
            'password' => $this->password
        ])) {
            session()->regenerate();

            return $this->returnUrl
                ? redirect()->to($this->returnUrl)
                : redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'loginFailed' => 'Email/Username atau password salah.',
        ]);
    }
}
