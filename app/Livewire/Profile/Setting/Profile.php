<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $username;
    public $bio;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->bio = $user->bio;
    }

    public function render()
    {
        return view('livewire.profile.setting.profile');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
        ]);

        $user = Auth::user();
        if ($this->username === $user->username && $this->name === $user->name && $this->bio) {
            session()->flash('errorAlert', 'You have not made any changes.');
            return;
        }

        $user->name = $this->name;
        $user->username = $this->username;
        $user->bio = $this->bio;
        $user->save();

        $this->dispatch('profile-updated');

        session()->flash('successAlert', 'Profile updated successfully.');
    }
}
