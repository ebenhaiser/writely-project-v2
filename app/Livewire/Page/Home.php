<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (Auth::guest()) {
            $posts = ModelsPost::whereIn(
                'user_id',
                Auth::user()->following()->pluck('users.id')
            )
                ->latest()
                ->paginate(10);
        } else {
            $posts = ModelsPost::latest()->paginate(10);
        }


        return view('livewire.page.home', compact('posts'));
    }
}
