<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $post;
    public $isEdit = false;
    public $postId,
        $title,
        $category_id,
        $content,
        $oldThumbnail;
    public $newThumbnail;
    public $isDeleteThumbnail = false;

    public $preview_thumbnail;

    public $categories;


    public function mount($post = null)
    {
        if ($post != null) {
            $this->isEdit = true;
            $this->post = $post;
            $this->postId = $post->id;
            $this->title = $post->title;
            $this->category_id = $post->category_id;
            $this->content = $post->content;
            if ($this->post->thumbnail && Storage::disk('public')->exists($this->post->thumbnail)) {
                $this->oldThumbnail = Storage::url($this->post->thumbnail);
            } else {
            }
        } else {
            $this->post = new Post();
        }

        $this->categories = Category::get();
    }
    public function render()
    {
        if ($this->isEdit == false) {
            $this->preview_thumbnail = $this->newThumbnail ? $this->newThumbnail->temporaryUrl() : '';
        } else {
            $this->preview_thumbnail = $this->newThumbnail ? $this->newThumbnail->temporaryUrl() : $this->oldThumbnail;
        }

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

    public function validateInput()
    {

        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
    }

    public function create()
    {
        $this->validateInput();

        $author = Auth::user();

        $slug = Str::slug($this->title);
        $slug = $slug . '-by-' . Str::slug($author->name);

        $originalSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $counter++;
            $slug = $originalSlug . '-' . $counter;
        }

        $this->post->title = $this->title;
        $this->post->user_id = $author->id;
        $this->post->content = $this->content;
        $this->post->category_id = $this->category_id;
        $this->post->slug = $slug;
        $this->saveThumbnail();
        $this->post->save();


        return redirect()->route('post.show', $slug);
    }

    public function edit()
    {
        $this->validateInput();

        $author = Auth::user();

        $slug = Str::slug($this->title);
        $slug = $slug . '-by-' . Str::slug($author->name);

        $originalSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $counter++;
            $slug = $originalSlug . '-' . $counter;
        }

        $this->post->title = $this->title;
        $this->post->user_id = $author->id;
        $this->post->content = $this->content;
        $this->post->category_id = $this->category_id;
        $this->post->slug = $slug;
        if ($this->newThumbnail) {
            $this->saveThumbnail();
        } elseif ($this->isDeleteThumbnail == true) {
            if ($this->post->thumbnail) {
                Storage::disk('public')->delete($this->post->thumbnail);
            }
            $this->post->thumbnail = null;
        }
        $this->post->save();


        return redirect()->route('post.show', $slug);
    }

    public function cancelThumbnail()
    {
        $this->reset(['newThumbnail']);
        $this->isDeleteThumbnail = false;
    }


    public function saveThumbnail()
    {
        if ($this->isEdit == true) {
            if ($this->post->thumbnail) {
                Storage::disk('public')->delete($this->post->thumbnail);
            }
        }

        $filename =  $this->post->slug . '_' . Str::uuid()  . '.' .
            $this->newThumbnail->getClientOriginalExtension();

        $path = $this->newThumbnail->storeAs(
            Setting::value('thumbnailFolder'),
            $filename,
            'public'
        );

        $this->post->thumbnail = $path;
    }

    public function btnDeleteThumbnail()
    {
        $this->reset(['newThumbnail']);
        $this->isDeleteThumbnail = true;
    }
}
