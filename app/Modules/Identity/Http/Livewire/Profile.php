<?php

namespace App\Modules\Identity\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $bio = '';

    public string $current_password = '';

    public string $new_password = '';

    public string $new_password_confirmation = '';

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
            $this->bio = $user->bio ?? '';
        }
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->bio = $this->bio;
        $user->save();

        session()->flash('profile_success', __('Profile details updated successfully.'));
    }

    public function updatePassword()
    {
        $user = Auth::user();

        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_success', __('Password changed successfully.'));
    }

    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => Auth::user(),
        ])->layout('admin.layouts.app', ['title' => __('My Profile')]);
    }
}
