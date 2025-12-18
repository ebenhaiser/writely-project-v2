<?php

namespace App\Livewire\Post;

use App\Models\Bookmark;
use App\Models\Like;
use Livewire\Component;
use App\Models\Post;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $post;

    public function mount($postId)
    {
        $this->post = Post::findOrFail($postId);
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
            $this->mount($this->post->slug);
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
            $this->mount($this->post->slug);
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
            $this->mount($this->post->slug);
        }
    }
}
