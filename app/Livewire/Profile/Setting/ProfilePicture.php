<?php

namespace App\Livewire\Profile\Setting;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePicture extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'profile-updated' => 'refreshProfile',
    ];

    public function refreshProfile()
    {
        $this->mount();
    }

    public $name;
    public $username;
    public $bio;
    public $profilePictureUrl;
    public $preview_profile_picture;

    #[Validate('image|max:5000|mimes:jpg,jpeg,png,webp')]
    public $profile_picture = null;

    public function mount()
    {
        $profile = Auth::user();
        $this->name = $profile->name;
        $this->username = $profile->username;
        $this->bio = $profile->bio;

        if (
            $profile->profile_picture &&
            Storage::disk('public')->exists($profile->profile_picture)
        ) {
            $this->profilePictureUrl = Storage::url($profile->profile_picture);
        } else {
            $this->profilePictureUrl = asset(Setting::value('defaultProfilePictureDir') . Setting::value('defaultProfilePictureImg'));
        }

        $this->preview_profile_picture = $this->profilePictureUrl;
    }

    public function render()
    {
        $this->preview_profile_picture = $this->profile_picture ? $this->profile_picture->temporaryUrl() : $this->profilePictureUrl;

        return view('livewire.profile.setting.profile-picture');
    }

    public function submit()
    {
        try {
            $this->validate();

            $profile = Auth::user();

            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            $filename = $profile->username . '_' . Str::uuid() . '.' .
                $this->profile_picture->getClientOriginalExtension();

            $path = $this->profile_picture->storeAs(
                Setting::value('profilePictureFolder'),
                $filename,
                'public'
            );

            $profile->profile_picture = $path;
            $profile->save();

            $this->dispatch('profile-updated');
            session()->flash('successAlert', 'Profile picture successfully updated.');
        } catch (\Exception $e) {
            session()->flash('errorAlert', 'Failed to update profile picture. ' . $e->getMessage());
        }
    }


    public function delete()
    {
        try {
            $profile = Auth::user();
            $delete = Storage::delete('public/' . $profile->profile_picture);
            $profile->profile_picture = null;
            $profile->save();

            $this->clear();
            $this->dispatch('profile-updated');
            session()->flash('successAlert', 'Profile picture successfully deleted.');
        } catch (\Exception $e) {
            session()->flash('errorAlert', 'Failed to delete profile picture. ' . $e->getMessage());
            return;
        }
    }

    public function clear()
    {
        $this->mount();
        $this->preview_profile_picture = $this->profilePictureUrl;
        $this->profile_picture = null;
    }
}
