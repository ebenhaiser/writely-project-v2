<?php

namespace App\Livewire\Page;

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
        return view('livewire.page.home', compact('posts'));
    }
}
