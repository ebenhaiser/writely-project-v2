<?php

namespace App\Livewire\Page;

use App\Models\Category as ModelsCategory;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id = null;

    public function render()
    {
        $categories = ModelsCategory::select('id', 'name')->get();
        if ($this->category_id) {
            $posts = Post::where('category_id', $this->category_id)->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }
        return view('livewire.page.category', compact('posts', 'categories'));
    }
}
