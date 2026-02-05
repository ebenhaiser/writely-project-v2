<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public ?Post $post = null;

    public $isEdit = false;
    public $title,
        $category_id,
        $content;

    public $categories;


    public function mount($post = null)
    {
        if ($post != null) {
            $this->isEdit = true;
        }

        $this->categories = Category::get();
    }
    public function render()
    {
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
}
