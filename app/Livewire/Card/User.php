<?php

namespace App\Livewire\Card;

use App\Models\Follow;
use App\Models\Setting;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class User extends Component
{
    public $user;
    public $userId;
    public $name;
    public $username;
    public $AvatarUrl;
    public $following;
    public $followers;
    public bool $isFollowing = false;

    public function mount($user)
    {
        $this->user = $user;
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->following = $user->followers;
        $this->followers = $user->followers;

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            $this->AvatarUrl = Storage::url($user->profile_picture);
        } else {
            $this->AvatarUrl = asset(Setting::value('defaultProfilePictureDir') . Setting::value('defaultProfilePictureImg'));
        }

        if (Auth::check()) {
            $this->isFollowing = Auth::user()
                ->following
                ->contains($this->userId);
        }
    }
    public function render()
    {
        return view('livewire.card.user');
    }

    public function toggleFollow()
    {
        if (!Auth::check()) return;

        $followerId = Auth::id();

        $follow = Follow::where('follower_id', $followerId)
            ->where('following_id', $this->userId)
            ->first();

        if ($follow) {
            $follow->delete();
            $this->isFollowing = false;
        } else {
            Follow::create([
                'following_id' => $this->userId,
                'follower_id' => $followerId,
            ]);
            $this->isFollowing = true;
        }

        $this->followers = $this->user->followers()->get();
    }
}
