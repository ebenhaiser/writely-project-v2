<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $profile;
    public $profileNavbar = 'post';

    public function mount($username)
    {
        $this->profile = User::where('username', $username)->firstOrFail();
    }

    public function render()
    {
        if ($this->profileNavbar == 'post') {
            $posts = Post::where('user_id', $this->profile->id)
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } elseif ($this->profileNavbar == 'like') {
            //
        } elseif ($this->profileNavbar == 'comment') {
            //
        } else {
            $posts = Post::where('user_id', $this->profile->id)
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }
        return view('livewire.profile.show', compact('posts'));
    }
}
