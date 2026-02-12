<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
}
