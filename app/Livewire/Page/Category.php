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
    public $sortBy = null;

    public function mount()
    {
        if (request()->has('category_slug')) {
            $this->category_slug = request()->query('category_slug');
        }
    }

    public function render()
    {
        // Ambil semua kategori
        $categories = ModelsCategory::select('slug', 'name')->get();

        // Ambil posts sesuai kategori jika ada slug
        $postsQuery = Post::query()->withCount('likes')->withCount('comments')->withCount('histories');

        if ($this->category_slug) {
            $category = ModelsCategory::where('slug', $this->category_slug)->first();

            if ($category) {
                $postsQuery->where('category_id', $category->id);
            }
        }
        if ($this->sortBy) {
            if ($this->sortBy == 'latest') {
                $posts = $postsQuery->orderBy('created_at')->paginate(12);
            } elseif ($this->sortBy == 'newest') {
                $posts = $postsQuery->orderByDesc('created_at')->paginate(12);
            } elseif ($this->sortBy == 'most_liked') {
                $posts = $postsQuery->orderByDesc('likes_count')->paginate(12);
            } elseif ($this->sortBy == 'most_commented') {
                $posts = $postsQuery->orderByDesc('comments_count')->paginate(12);
            } elseif ($this->sortBy == 'most_viewed') {
                $posts = $postsQuery->orderByDesc('histories_count')->paginate(12);
            }
        } else {
            $posts = $postsQuery->orderByDesc('created_at')->paginate(12);
        }

        return view('livewire.page.category', compact('posts', 'categories'));
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }
    public function updatedCategorySlug()
    {
        $this->resetPage();
    }
}
