<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
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
        $this->old_profile_picture = $profile->profile_picture;
    }

    public function render()
    {
        return view('livewire.profile.setting.profile-picture');
    }

    public function submit()
    {
        $this->validate();
        $profile = Auth::user();
        $fileName = $profile->id . '_' . $profile->name . '_' . $profile->username;
        $validate['profile_picture'] = $this->photo->storeAs('photos', $fileName, 's3');
        $profile->profile_picture = $fileName;
        $profile->save();

        $this->mount();
    }

    public function clear()
    {
        $this->profile_picture->delete();
    }
}
