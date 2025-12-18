<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Setting extends Component
{
    public $name, $username, $email, $bio, $profile_picture;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->profile_picture = $user->profile_picture;
    }

    public function render()
    {
        return view('livewire.profile.setting');
    }
}
