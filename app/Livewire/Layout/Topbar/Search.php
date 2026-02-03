<?php

namespace App\Livewire\Layout\Topbar;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public string $keyword = '';
    public $users = [];

    public function updatedKeyword()
    {
        if (strlen($this->keyword) < 1) {
            $this->users = [];
            return;
        }

        $this->users = User::where('name', 'like', "%{$this->keyword}%")
            ->orWhere('username', 'like', "%{$this->keyword}%")
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.layout.topbar.search');
    }
}
