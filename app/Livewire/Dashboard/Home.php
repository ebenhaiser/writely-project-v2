<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Post as ModelsPost;

class Home extends Component
{
    public function render()
    {
        $posts = ModelsPost::get();
        return view('livewire.dashboard.home', compact('posts'));
    }
}
