<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post as ModelsPost;

class Home extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected function getPageName()
    {
        return 'postsPage';
    }

    public function render()
    {
        $posts = ModelsPost::orderByDesc('created_at')
            ->paginate(10, ['*'], $this->getPageName());

        return view('livewire.page.home', compact('posts'));
    }
}
