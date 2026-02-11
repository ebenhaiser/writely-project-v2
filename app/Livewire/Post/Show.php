<?php

namespace App\Livewire\Post;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Bookmark;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $post;
    public $thumbnail;
    public $likers = [];
    public $author;
    public $authorProfilePicture;

    public function mount($postId)
    {
        $this->post = Post::findOrFail($postId);

        $this->createHistory();

        $this->likers = User::whereHas('likes', function ($query) use ($postId) {
            $query->where('post_id', $postId);
        })->get();

        if ($this->post->thumbnail && Storage::disk('public')->exists($this->post->thumbnail)) {
            $this->thumbnail = Storage::url($this->post->thumbnail);
        }

        $this->author = $this->post->user;
        if (
            $this->author->profile_picture &&
            Storage::disk('public')->exists($this->author->profile_picture)
        ) {
            $this->authorProfilePicture = Storage::url($this->author->profile_picture);
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

    public function createHistory()
    {
        if (Auth::check()) {
            if (!History::where('user_id', Auth::user()->id)->where('post_id', $this->post->id)->exists()) {
                $history = new History();
                $history->user_id = Auth::user()->id;
                $history->post_id = $this->post->id;
                $history->save();
            } else {
                $existingHistory = History::where('user_id', Auth::user()->id)->where('post_id', $this->post->id)->first();
                $existingHistory->touch();
            }
        }
    }
}
