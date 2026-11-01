<?php

namespace App\Modules\Identity\Providers;

use App\Modules\Identity\Http\Livewire\Auth\Login;
use App\Modules\Identity\Http\Livewire\Auth\Register;
use App\Modules\Identity\Http\Livewire\Dashboard;
use App\Modules\Identity\Http\Livewire\Profile;
use App\Modules\Identity\Http\Livewire\RolesList;
use App\Modules\Identity\Http\Livewire\UsersList;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class IdentityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register Livewire components explicitly with aliases
        Livewire::component('admin.dashboard', Dashboard::class);
        Livewire::component('admin.users.users-list', UsersList::class);
        Livewire::component('admin.roles.roles-list', RolesList::class);
        Livewire::component('admin.profile', Profile::class);
        Livewire::component('auth.login', Login::class);
        Livewire::component('auth.register', Register::class);
    }
}
