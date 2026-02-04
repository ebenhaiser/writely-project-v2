<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Password extends Component
{
    #[Validate('required')]
    public $old_password;
    #[Validate('required')]
    public $new_password;
    #[Validate('required')]
    public $confirm_new_password;

    public function render()
    {
        return view('livewire.profile.setting.password');
    }

    public function submit()
    {
        if($this->new_password !== $this->confirm_new_password){
            $this->addError('confirm_new_password', 'New password does not match.');
            return;
        }

        $this->validate();

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($this->old_password, $user->password)) {
            $this->addError('old_password', 'Old password is incorrect.');
            return;
        }

        // Update password baru
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Reset input fields
        $this->reset(['old_password', 'new_password', 'confirm_new_password']);

        // Bisa kirim flash message atau event
        session()->flash('successAlert', 'Password has been updated successfully!');
    }
}
