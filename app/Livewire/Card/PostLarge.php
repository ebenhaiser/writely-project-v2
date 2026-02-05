<?php

namespace App\Livewire\Card;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class PostLarge extends Component
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
            $this->authorProfilePictureUrl = asset('img/default_profile_picture.jpg');
        }

        if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            $this->thumbnailUrl = Storage::url($post->thumbnail);
        } else {
            $this->thumbnailUrl = asset('https://placehold.co/600x400');
        }
    }
    public function render()
    {
        return view('livewire.card.post-large');
    }
}
