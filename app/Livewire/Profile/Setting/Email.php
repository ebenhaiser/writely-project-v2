<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Email extends Component
{
    public $email;

    #[Validate('required|email|max:255')]
    public $new_email;

    #[Validate('required|same:new_email')]
    public $confirm_New_email;

    public function mount()
    {
        $user = Auth::user();
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.profile.setting.email');
    }
}
