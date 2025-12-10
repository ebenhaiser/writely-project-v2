<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $profile;

    public function mount($username)
    {
        $this->profile = User::where('username', $username)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.profile.show');
    }
}
