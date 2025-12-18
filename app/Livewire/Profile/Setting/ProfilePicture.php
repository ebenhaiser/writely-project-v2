<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePicture extends Component
{
    use WithFileUploads;

    public $name;
    public $username;
    public $old_profile_picture;

    #[Validate('image|max:5000|mimes:jpg,jpeg,png,webp')]
    public $profile_picture;

    public function mount()
    {
        $profile = Auth::user();
        $this->name = $profile->name;
        $this->username = $profile->username;
    }

    public function render()
    {
        return view('livewire.profile.setting.profile-picture');
    }

    public function submit()
    {
        $this->validate();

        $profile = Auth::user();

        if ($profile->profile_picture) {
            Storage::delete('public/' . $profile->profile_picture);
        }

        $validated['profile_picture'] = $this->profile_picture->store('profile_pictures', 'public');

        $profile->profile_picture = $validated['profile_picture'];
        $profile->save();

        $this->mount();
    }

    public function delete()
    {
        $profile = Auth::user();
        $delete = Storage::delete('public/' . $profile->profile_picture);
        $profile->profile_picture = null;
        $profile->save();
    }

    public function clear()
    {
        // $this->profile_picture->delete();
    }
}
