<?php

namespace App\Livewire\Page;

use App\Models\Category;
use Livewire\Component;

class History extends Component
{
    public $categories;
    public function mount()
    {
        $this->categories = Category::get();
    }
    public function render()
    {
        return view('livewire.page.history');
    }
}
