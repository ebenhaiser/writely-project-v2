<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Email extends Component
{
    public $email;
    public $masked_email;

    // #[Validate('required|email|max:255|unique:users,email')]
    public $new_email;

    // #[Validate('required|same:new_email')]
    public $confirm_new_email;

    // #[Validate('required')]
    public $password;

    public function mount()
    {
        $user = Auth::user();
        $this->masked_email = $this->emailMask($user->email);
    }

    public function render()
    {
        return view('livewire.profile.setting.email');
    }

    public function emailMask($email)
    {
        [$name, $domain] = explode('@', $email);

        // Mask username
        $visibleName = max(1, floor(strlen($name) / 2));
        $maskedName  = strlen($name) - $visibleName;

        // Split domain 
        $visibleDomain = min(2, strlen($domain));
        $maskedDomain  = strlen($domain) - $visibleDomain;

        return substr($name, 0, $visibleName)
            . str_repeat('*', $maskedName)
            . '@'
            . substr($domain, 0, $visibleDomain)
            . str_repeat('*', $maskedDomain);
    }

    public function submit()
    {
        $this->validate([
            'new_email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'confirm_new_email' => 'required|same:new_email',
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'The password you entered is incorrect.');
            $this->reset(['password']);
            return;
        }

        $user->email = $this->new_email;
        $user->save();

        session()->flash('success', 'Email address updated successfully.');

        // Reset form fields
        $this->reset(['new_email', 'confirm_new_email', 'password']);
        $this->masked_email = $this->emailMask($user->email);

        session()->flash('successAlert', "Email address updated successfully.");
    }
}
