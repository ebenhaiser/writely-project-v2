<?php

namespace App\Livewire\Page;

use App\Models\Category;
use App\Models\History as ModelsHistory;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class History extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categories;
    public $category_id;
    public $sortBy;
    public $keyword;
    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
    }
    public function render()
    {
        $postsQuery = Post::join('histories', 'posts.id', '=', 'histories.post_id')->join('users', 'users.id', '=', 'posts.user_id')
            ->where('histories.user_id', Auth::id());

        if ($this->keyword && $this->keyword != '') {
            $postsQuery->where('posts.title', 'like', '%' . $this->keyword . '%')->orWhere('posts.content', 'like', '%' . $this->keyword . '%')->orWhere('users.name', 'like', '%' . $this->keyword . '%')->orWhere('users.username', 'like', '%' . $this->keyword . '%');
        }

        if ($this->category_id && $this->category_id != '') {
            $postsQuery->where('category_id', $this->category_id);
        }

        if ($this->sortBy && $this->sortBy != '') {
            if ($this->sortBy === 'latest') {
                $postsQuery->orderBy('histories.updated_at');
            } else {
                $postsQuery->orderByDesc('histories.updated_at');
            }
        } else {
            $postsQuery->orderByDesc('histories.updated_at');
        }

        $posts = $posts = $postsQuery
            ->select('posts.*')
            ->paginate(12);
        return view('livewire.page.history', compact('posts'));
    }

    public function delete($postId)
    {
        $history = ModelsHistory::where('user_id', Auth::id())->where('post_id', $postId)->first();
        if ($history) {
            $history->delete();
        }
    }

    public function updatedCategoryId()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedKeyword()
    {
        $this->resetPage();
    }
}
