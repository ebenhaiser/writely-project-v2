<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;

class Layout extends Component
{
    public $username;
    public $receiver;

    protected $listeners = ['openChat'];

    public function mount()
    {
        if ($this->username) {
            $this->receiver = User::where('username', $this->username)->first();
        }
    }

    public function openChat($username)
    {
        $this->receiver = User::where('username', $username)->first();
    }

    public function render()
    {
        return view('livewire.chat.layout');
    }
}
