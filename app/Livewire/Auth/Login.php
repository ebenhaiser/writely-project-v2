<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;

class Login extends Component
{
    #[Validate('required|email')]
    public $email;

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
