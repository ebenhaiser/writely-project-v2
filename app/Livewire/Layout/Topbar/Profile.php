<?php

namespace App\Livewire\Layout\Topbar;

use App\Models\Setting;
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
        if (
            $user->profile_picture &&
            Storage::disk('public')->exists($user->profile_picture)
        ) {
            $this->profilePictureUrl = Storage::url($user->profile_picture);
        } else {
            $this->profilePictureUrl = asset(Setting::defaultProfilePicture());
        }
        $this->name = $user->name;
        $this->username = $user->username;
    }

    public function render()
    {
        return view('livewire.layout.topbar.profile');
    }
}
