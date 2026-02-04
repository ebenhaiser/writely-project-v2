<?php

namespace App\Livewire\Profile\Setting;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;

class DeleteAccount extends Component
{
    #[Validate('required')]
    public $email;

    #[Validate('required|email')]
    public $password;

    #[Validate('required')]
    public $confirmationWord;

    public function render()
    {
        return view('livewire.profile.setting.delete-account');
    }

    public function openAuthModal()
    {
        $this->dispatch('open-auth-modal');
    }

    public function submit()
    {
        $this->resetErrorBag();

        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Auth::user();

        if ($this->email !== $user->email) {
            $this->addError('email', 'E-mail does not match.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect.');
            return;
        }

        // ✅ LOLOS → TUTUP MODAL 1, BUKA MODAL 2
        $this->dispatch('close-auth-modal');
        $this->dispatch('open-confirm-modal');
    }


    public function confirm()
    {
        $this->resetErrorBag();

        // 1️⃣ Validasi input
        $this->validate([
            'confirmationWord' => 'required',
        ]);

        // 2️⃣ Cek kata konfirmasi
        if ($this->confirmationWord !== 'DELETE') {
            $this->addError(
                'confirmationWord',
                'You must type DELETE to confirm account deletion.'
            );
            return;
        }

        // 3️⃣ Ambil user
        $user = Auth::user();

        // 4️⃣ Logout dulu (WAJIB)
        Auth::logout();

        // 5️⃣ Hapus akun
        $user->delete();

        // 6️⃣ Redirect (Livewire way)
        return redirect()->to('/');
    }


    public function cancel()
    {
        $this->reset(['email', 'password', 'confirmationWord']);
    }
}
