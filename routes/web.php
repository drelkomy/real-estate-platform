<?php

use App\Modules\Identity\Http\Livewire\Auth\Login;
use App\Modules\Identity\Http\Livewire\Auth\Register;
use App\Modules\Identity\Http\Livewire\Dashboard;
use App\Modules\Identity\Http\Livewire\Profile;
use App\Modules\Identity\Http\Livewire\RolesList;
use App\Modules\Identity\Http\Livewire\UsersList;
use App\Modules\Listings\Http\Livewire\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Real Estate Platform
|--------------------------------------------------------------------------
*/

// Public Home Page (Hero, Filter, Property Cards)
Route::get('/', HomePage::class)->name('home');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Logout Route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Protected Admin & Identity Management Routes
Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/users', UsersList::class)->name('users');
    Route::get('/roles', RolesList::class)->name('roles');
    Route::get('/profile', Profile::class)->name('profile');
});
