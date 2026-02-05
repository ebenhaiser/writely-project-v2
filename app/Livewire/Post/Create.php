<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $isEdit = false;
    public $postId,
        $title,
        $category_id,
        $content,
        $thumbnail;

    public $preview_thumbnail;

    public $categories;


    public function mount($post = null)
    {
        if ($post != null) {
            $this->postId = $post->id;
            $this->isEdit = true;
        }

        $this->categories = Category::get();
    }
    public function render()
    {
        $this->preview_thumbnail = $this->thumbnail ? $this->thumbnail->temporaryUrl() : '';

        return view('livewire.post.create');
    }

    public function submit()
    {
        if ($this->isEdit == false) {
            $this->create();
        } else {
            $this->edit();
        }
    }

    public function create()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $author = Auth::user();

        $slug = Str::slug($this->title);
        $slug = $slug . '-by-' . Str::slug($author->name);

        $originalSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $counter++;
            $slug = $originalSlug . '-' . $counter;
        }

        Post::create([
            'title' => $this->title,
            'user_id' => $author->id,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'slug' => $slug
        ]);

        return redirect()->route('post.show', $slug);
    }

    public function edit()
    {
        // 
    }

    public function cancelThumbnail()
    {
        $this->reset(['thumbnail']);
        return;
    }

    public function saveThumbnail()
    {
        $post = new Post();
        // if ($post->thumbnail) {
        //     Storage::delete('public/' . $post->thumbnail);
        // }

        $validated['profile_picture'] = $this->thumbnail->store('profile_pictures', 'public');

        $post->thumbnail = $validated['profile_picture'];
        $post->save();

        $this->mount();
    }
}
