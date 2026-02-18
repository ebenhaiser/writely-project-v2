<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Box extends Component
{
    public $receiver;
    public $message = '';
    public $chatMessages = [];

    protected $rules = [
        'message' => 'required|string|max:1000',
    ];

    /**
     * Dipanggil saat component pertama kali dibuka
     */
    public function mount()
    {
        $this->loadMessages();
    }

    /**
     * Ambil semua chat antara user login & receiver
     */
    public function loadMessages()
    {
        $this->chatMessages = Message::where(function ($q) {
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

    /**
     * Kirim pesan
     */
    public function send()
    {
        $this->validate();

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id'   => $this->receiver->id,
            'message'      => $this->message,
        ]);

        $this->message = '';

        // reload data
        $this->loadMessages();

        // trigger auto scroll di JS
        $this->dispatch('scroll-chat-bottom');
    }

    public function render()
    {
        return view('livewire.chat.box');
    }

    /**
     * Helper foto profile
     */
    public function profilePicturePath($profilePicture)
    {
        if ($profilePicture && Storage::disk('public')->exists($profilePicture)) {
            return Storage::url($profilePicture);
        }

        return asset(
            Setting::value('defaultProfilePictureDir') .
                Setting::value('defaultProfilePictureImg')
        );
    }
}
