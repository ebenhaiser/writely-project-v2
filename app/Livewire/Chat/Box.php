<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class Box extends Component
{
    public $receiver;
    public $message = '';
    public $messages = [];

    protected $rules = [
        'message' => 'required|string|max:1000'
    ];

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function ($q) {
            $q->where('from_user_id', Auth::id())
                ->where('to_user_id', $this->receiver->id);
        })
            ->orWhere(function ($q) {
                $q->where('from_user_id', $this->receiver->id)
                    ->where('to_user_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();
    }

    public function send()
    {
        $this->validate();

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id'   => $this->receiver->id,
            'message'      => $this->message
        ]);

        $this->message = '';
        $this->loadMessages();

        $this->dispatch('scroll-bottom');
    }

    public function render()
    {
        return view('livewire.chat.box');
    }
}
