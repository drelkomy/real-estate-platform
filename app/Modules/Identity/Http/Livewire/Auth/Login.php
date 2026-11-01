<?php

namespace App\Modules\Identity\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public string $errorMessage = '';

    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function login()
    {
        $this->errorMessage = '';
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => true], $this->remember)) {
            session()->regenerate();

            if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'agency-manager', 'agent'])) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(url('/'));
        }

        // Check if user exists but inactive
        $user = User::where('email', $this->email)->first();
        if ($user && ! $user->is_active) {
            $this->errorMessage = __('Your account is deactivated. Please contact support.');

            return;
        }

        $this->errorMessage = __('The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.admin.auth.login')
            ->layout('admin.layouts.auth', ['title' => __('Sign In')]);
    }
}
