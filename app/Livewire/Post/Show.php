<?php

namespace App\Livewire\Post;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $post;
    public $thumbnail;
    public $likers = [];
    public $authorProfilePicture;
    public $authorName;
    public $authorUsername;

    public function mount($postId)
    {
        $this->post = Post::findOrFail($postId);
        $this->likers = User::whereHas('likes', function ($query) use ($postId) {
            $query->where('post_id', $postId);
        })->get();

        if ($this->post->thumbnail && Storage::disk('public')->exists($this->post->thumbnail)) {
            $this->thumbnail = Storage::url($this->post->thumbnail);
        }

        $author = $this->post->user;
        $this->authorName = $author->name;
        $this->authorUsername = $author->username;
        if (
            $author->profile_picture &&
            Storage::disk('public')->exists($author->profile_picture)
        ) {
            $this->authorProfilePicture = Storage::url($author->profile_picture);
        } else {
            $this->authorProfilePicture = asset(Setting::value('defaultProfilePictureDir') . Setting::value('defaultProfilePictureImg'));
        }
    }

    public function render()
    {
        return view('livewire.post.show');
    }

    public function likeToggle($postId)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $likedPost = Like::where('user_id', $userId)
                ->where('post_id', $postId)
                ->first();

            if ($likedPost) {
                $likedPost->delete();
            } else {
                Like::create([
                    'user_id' => $userId,
                    'post_id' => $postId,
                ]);
            }
            $this->mount($this->post->id);
        }
    }

    public function bookmarkToggle($postId)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $bookmarkedPost = Bookmark::where('user_id', $userId)
                ->where('post_id', $postId)
                ->first();

            if ($bookmarkedPost) {
                $bookmarkedPost->delete();
            } else {
                Bookmark::create([
                    'user_id' => $userId,
                    'post_id' => $postId,
                ]);
            }
            $this->mount($this->post->id);
        }
    }

    public function toggleFollow($followingId)
    {
        if (Auth::check()) {
            $followerId = Auth::user()->id;
            $follow = Follow::where('follower_id', $followerId)
                ->where('following_id', $followingId)
                ->first();

            if ($follow) {
                $follow->delete();
            } else {
                Follow::create([
                    'following_id' => $followingId,
                    'follower_id' => $followerId,
                ]);
            }
            $this->mount($this->post->id);
        }
    }
}
