<?php

namespace App\Livewire\Page;

use App\Models\Bookmark as ModelsBookmark;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Bookmark extends Component
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
        $postsQuery = Post::join('bookmarks', 'posts.id', '=', 'bookmarks.post_id')->join('users', 'users.id', '=', 'posts.user_id')
            ->where('bookmarks.user_id', Auth::id());

        if ($this->keyword && $this->keyword != '') {
            $postsQuery->where('posts.title', 'like', '%' . $this->keyword . '%')->orWhere('posts.content', 'like', '%' . $this->keyword . '%')->orWhere('users.name', 'like', '%' . $this->keyword . '%')->orWhere('users.username', 'like', '%' . $this->keyword . '%');
        }

        if ($this->category_id && $this->category_id != '') {
            $postsQuery->where('category_id', $this->category_id);
        }

        if ($this->sortBy && $this->sortBy != '') {
            if ($this->sortBy === 'latest') {
                $postsQuery->orderBy('bookmarks.updated_at');
            } else {
                $postsQuery->orderByDesc('bookmarks.updated_at');
            }
        } else {
            $postsQuery->orderByDesc('bookmarks.updated_at');
        }

        $posts = $posts = $postsQuery
            ->select('posts.*')
            ->paginate(12);
        return view('livewire.page.bookmark', compact('posts'));
    }

    public function delete($postId)
    {
        $history = ModelsBookmark::where('user_id', Auth::id())->where('post_id', $postId)->first();
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
