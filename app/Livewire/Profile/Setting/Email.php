<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Email extends Component
{
    public $email;
    public $masked_email;

    #[Validate('required|email|max:255')]
    public $new_email;

    #[Validate('required|same:new_email')]
    public $confirm_New_email;

    #[Validate('required')]
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

        // Split domain & TLD
        $domainParts = explode('.', $domain);
        $domainName  = $domainParts[0];
        $tld         = implode('.', array_slice($domainParts, 1));

        $visibleDomain = min(2, strlen($domainName));
        $maskedDomain  = strlen($domainName) - $visibleDomain;

        return substr($name, 0, $visibleName)
            . str_repeat('*', $maskedName)
            . '@'
            . substr($domainName, 0, $visibleDomain)
            . str_repeat('*', $maskedDomain)
            . '.'
            . $tld;
    }
}
