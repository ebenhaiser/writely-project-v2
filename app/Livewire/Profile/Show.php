<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Livewire\WithPagination;
use Livewire\Component;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $profile;
    public $profileNavbar = 'post';
    public $followModalTitle, $followModalData = [];

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
            $profile = $this->profile;
            $posts = Post::whereHas('likes', function ($query) use ($profile) {
                $query->where('user_id', $profile->id);
            })->latest()->paginate(12);
        } elseif ($this->profileNavbar == 'comment') {
            $userId = $this->profile->id;
            $posts = Post::whereHas('comments', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
                ->with(['comments' => function ($query) use ($userId) {
                    $query->where('user_id', $userId)->latest(); // Urutkan komentar terbaru
                }])
                ->orderByDesc(
                    Comment::select('created_at')
                        ->whereColumn('comments.post_id', 'posts.id')
                        ->where('user_id', $userId)
                        ->latest()
                        ->take(1) // Ambil komentar terakhir dari user ini di tiap post
                )
                ->paginate(12);
        } else {
            $posts = Post::where('user_id', $this->profile->id)
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }
        return view('livewire.profile.show', compact('posts'));
    }

    public function setProfileNavbar($navbar)
    {
        $this->profileNavbar = $navbar;
    }

    public function followModal($follow)
    {
        if ($follow == 'following') {
            $this->followModalTitle = '@' . $this->profile->username . ' Following';
            $this->followModalData = $this->profile->following()->get();
        } elseif ($follow == 'follower') {
            $this->followModalTitle = '@' . $this->profile->username . ' Followers';
            $this->followModalData = $this->profile->followers()->get();
        }
    }

    public function clearFollowModal()
    {
        $this->followModalTitle = null;
        $this->followModalData = [];
    }
}
