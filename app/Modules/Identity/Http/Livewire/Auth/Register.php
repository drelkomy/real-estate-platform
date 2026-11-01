<?php

namespace App\Modules\Identity\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $account_type = 'client';

    public bool $terms = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account_type' => ['required', 'in:client,agent'],
            'terms' => ['accepted'],
        ];
    }

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'is_active' => true,
        ]);

        $roleToAssign = $this->account_type === 'agent' ? 'agent' : 'client';
        $user->assignRole($roleToAssign);

        Auth::login($user);

        if ($user->hasRole('agent')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(url('/'));
    }

    public function render()
    {
        return view('livewire.admin.auth.register')
            ->layout('admin.layouts.auth', ['title' => __('Create an Account')]);
    }
}
