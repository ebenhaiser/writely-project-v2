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

    public $category_slug = null;

    public function mount()
    {
        if (request()->has('category_slug')) {
            $this->category_slug = request()->query('category_slug');
        }
    }

    public function render()
    {
        $categories = ModelsCategory::select('slug', 'name')->get();
        if ($this->category_slug) {
            $category = ModelsCategory::where('slug', $this->category_slug)->first();
            if ($category) {
                $posts = Post::where('category_id', $category->id)->orderByDesc('created_at')->paginate(12);
            } else {
                $posts = Post::orderByDesc('created_at')->paginate(12);
            }
        } else {
            $posts = Post::orderByDesc('created_at')->paginate(12);
        }
        return view('livewire.page.category', compact('posts', 'categories'));
    }
}
