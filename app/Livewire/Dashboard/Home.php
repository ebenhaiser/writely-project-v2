<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post as ModelsPost;

class Home extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $posts = ModelsPost::paginate(10);
        return view('livewire.dashboard.home', compact('posts'));
    }
}
