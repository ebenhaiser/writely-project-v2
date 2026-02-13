<?php

namespace App\Livewire\Chat;

use App\Models\Setting;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserList extends Component
{
    public function open($username)
    {
        $this->dispatch('openChat', $username);
    }

    public function render()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('livewire.chat.user-list', compact('users'));
    }

    public function profilePicturePath($profilePicture)
    {
        if ($profilePicture && Storage::disk('public')->exists($profilePicture)) {
            return Storage::url($profilePicture);
        } else {
            return asset(Setting::value('defaultProfilePictureDir') . Setting::value('defaultProfilePictureImg'));
        }
    }
}
