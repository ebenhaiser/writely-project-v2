<?php

namespace App\Livewire\Layout\Topbar;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Profile extends Component
{
    protected $listeners = [
        'profile-updated' => 'refreshProfile',
    ];

    public function refreshProfile()
    {
        $this->mount();
    }

    public $name;
    public $username;
    public $profilePictureUrl;

    public function mount()
    {
        $user = Auth::user();
        $this->profilePictureUrl = $user->profile_picture ? Storage::url($user->profile_picture) : 'https://placehold.co/400';
        $this->name = $user->name;
        $this->username = $user->username;
    }

    public function render()
    {
        return view('livewire.layout.topbar.profile');
    }
}
