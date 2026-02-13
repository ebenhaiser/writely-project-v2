<?php

namespace App\Livewire\Chat;

use App\Models\Setting;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserList extends Component
{
    public function open($username)
    {
        $this->dispatch('openChat', $username);
    }

    public function render()
    {
        $authId = Auth::id();

        $users = User::where('users.id', '!=', Auth::id())
            ->whereExists(function ($q) {
                $q->selectRaw(1)
                    ->from('messages')
                    ->where(function ($q2) {
                        $q2->whereColumn('messages.from_user_id', 'users.id')
                            ->where('messages.to_user_id', Auth::id());
                    })
                    ->orWhere(function ($q2) {
                        $q2->whereColumn('messages.to_user_id', 'users.id')
                            ->where('messages.from_user_id', Auth::id());
                    });
            })
            ->select('users.*')
            ->selectSub(function ($q) {
                $q->from('messages')
                    ->selectRaw('MAX(created_at)')
                    ->where(function ($q2) {
                        $q2->whereColumn('from_user_id', 'users.id')
                            ->where('to_user_id', Auth::id());
                    })
                    ->orWhere(function ($q2) {
                        $q2->whereColumn('to_user_id', 'users.id')
                            ->where('from_user_id', Auth::id());
                    });
            }, 'last_message_at')
            ->orderByDesc('last_message_at')
            ->get();

        return view('livewire.chat.user-list', compact('users'));
    }


    public function profilePicturePath($profilePicture)
    {
        if ($profilePicture && Storage::disk('public')->exists($profilePicture)) {
            return Storage::url($profilePicture);
        } else {
            return asset(Setting::value('defaultProfilePictureDir') . Setting::value('defaultProfilePictureImg'));
        }
    }
}
