<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilePicture extends Component
{
    public $name, $username, $profile_picture;

    public function mount()
    {
        $profile = Auth::user();
        $this->name = $profile->name;
        $this->username = $profile->username;
        $this->profile_picture = $profile->profile_picture;
    }

    public function render()
    {
        return view('livewire.profile.setting.profile-picture');
    }
}
