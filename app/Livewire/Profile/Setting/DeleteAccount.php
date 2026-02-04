<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;

class DeleteAccount extends Component
{
    #[Validate('required')]
    public $email;

    #[Validate('required|email')]
    public $password;

    #[Validate('required')]
    public $deleteWord;

    public function render()
    {
        return view('livewire.profile.setting.delete-account');
    }

    public function submit()
    {
        $user = Auth::user();
        if($this->email !== $user->email){
            $this->addError('email', 'E-mail does not match.');
        }
        if (!Hash::check($this->old_password, $user->password)) {
            $this->addError('old_password', 'Password is incorrect.');
            return;
        }
    }

            // $this->reset(['old_email', 'new_email', 'confirm_new_email', 'password']);

}
