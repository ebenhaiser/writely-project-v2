<?php

namespace App\Livewire\Card;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class PostSmall extends Component
{
    public $postSlug,
        $title,
        $categorySlug,
        $categoryName,
        $content,
        $created_at,
        $likes,
        $comments,
        $authorName,
        $authorUsername,
        $authorProfilePictureUrl,
        $thumbnailUrl;

    public function mount($post)
    {
        $this->postSlug = $post->slug;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->created_at = $post->created_at;

        $category = $post->category;
        $this->categorySlug = $category->slug;
        $this->categoryName = $category->name;
        $this->likes = $post->likes;
        $this->comments = $post->comments;

        $author = $post->user;
        $this->authorName = $author->name;
        $this->authorUsername = $author->username;

        if ($author->profile_picture && Storage::disk('public')->exists($author->profile_picture)) {
            $this->authorProfilePictureUrl = Storage::url($author->profile_picture);
        } else {
            $this->authorProfilePictureUrl = asset(Setting::value('defaultProfilePictureDir') . Setting::value('defaultProfilePictureImg'));
        }

        if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            $this->thumbnailUrl = Storage::url($post->thumbnail);
        } else {
            $this->thumbnailUrl = asset('img/default/Thumbnail/' . $post->category->slug . '.jpg');
        }
    }

    public function render()
    {
        return view('livewire.card.post-small');
    }
}
