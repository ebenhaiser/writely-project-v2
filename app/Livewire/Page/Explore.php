<?php

namespace App\Livewire\Page;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Explore extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $category = null;
    public $category_slug = null;
    public $sortBy = null;
    public $keyword = null;

    protected $queryString = [
        'category' => ['except' => null],
    ];

    public function mount()
    {
        if ($this->category) {
            $this->category_slug = $this->category;
        }
    }

    public function render()
    {
        // Ambil semua kategori
        $categories = Category::select('slug', 'name')->get();

        // Ambil posts sesuai kategori jika ada slug
        $postsQuery = Post::query()->withCount('likes')->withCount('comments')->withCount('histories');

        if ($this->category_slug) {
            $category = Category::where('slug', $this->category_slug)->first();

            if ($category) {
                $postsQuery->where('category_id', $category->id);
            }
        }

        if ($this->keyword && $this->keyword !== '') {
            $postsQuery->where(function ($q) {
                $q->where('title', 'like', '%' . $this->keyword . '%')
                    ->orWhere('content', 'like', '%' . $this->keyword . '%')
                    ->orWhereHas('user', function ($uq) {
                        $uq->where('name', 'like', '%' . $this->keyword . '%')
                            ->orWhere('username', 'like', '%' . $this->keyword . '%');
                    });
            });
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

        return view('livewire.page.explore', compact('posts', 'categories'));
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }
    public function updatedCategorySlug()
    {
        $this->resetPage();
    }

    public function updatedKeyword()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->category_slug = null;
        $this->sortBy = null;
        $this->keyword = null;
        $this->resetPage();
    }
}
