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

        $users = User::join('messages as m', function ($join) use ($authId) {
            $join->on('users.id', '=', 'm.from_user_id')
                ->orOn('users.id', '=', 'm.to_user_id');
        })
            ->where(function ($q) use ($authId) {
                $q->where('m.from_user_id', $authId)
                    ->orWhere('m.to_user_id', $authId);
            })
            ->where('users.id', '!=', $authId)
            ->select(
                'users.id',
                'users.name',
                'users.username',
                'users.profile_picture',
                DB::raw('MAX(m.created_at) as last_message_at')
            )
            ->groupBy(
                'users.id',
                'users.name',
                'users.username',
                'users.profile_picture'
            )
            ->orderByDesc('last_message_at')
            ->limit(30) // ⬅️ WAJIB
            ->get();

        return view('livewire.chat.user-list', compact('users'));
    }

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
