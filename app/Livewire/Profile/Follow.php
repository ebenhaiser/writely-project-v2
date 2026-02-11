<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Follow extends Component
{
    public $profile;
    public $name;
    public $follow; // 'follower' or 'following'

    public function mount($username, $follow)
    {
        $this->profile = User::where('username', $username)->firstOrFail();
        $this->name = $this->profile->name;
        $this->follow = $follow;
    }
    public function render()
    {
        return view('livewire.page.follow');
    }
}
