<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Follow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $profile;
    public $name;
    public $follow; // 'follower' or 'following'
    public $title;
    public $keyword;

    public function mount($username, $follow)
    {
        $this->profile = User::where('username', $username)->firstOrFail();
        $this->name = $this->profile->name;
        $this->follow = $follow;
    }

    public function render()
    {
        if ($this->follow === 'following') {
            $this->title = $this->profile->name . ' (@' . $this->profile->username . ') Following';

            $usersQuery = $this->profile->following();
        } elseif ($this->follow === 'follower') {
            $this->title = $this->profile->name . ' (@' . $this->profile->username . ') Followers';

            $usersQuery = $this->profile->followers();
        }

        if ($this->keyword) {
            $usersQuery->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->keyword . '%')
                    ->orWhere('users.username', 'like', '%' . $this->keyword . '%');
            });
        }

        $users = $usersQuery->paginate(12);

        return view('livewire.page.follow', compact('users'));
    }

    public function updatedKeyword()
    {
        $this->resetPage();
    }
}
