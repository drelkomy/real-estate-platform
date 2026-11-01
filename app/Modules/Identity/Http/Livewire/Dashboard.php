<?php

namespace App\Modules\Identity\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = User::count();
        $totalAgents = User::role('agent')->count();
        $totalClients = User::role('client')->count();
        $totalRoles = Role::count();
        $recentUsers = User::with('roles')->latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalAgents' => $totalAgents,
            'totalClients' => $totalClients,
            'totalRoles' => $totalRoles,
            'recentUsers' => $recentUsers,
        ])->layout('admin.layouts.app', ['title' => __('Admin Dashboard')]);
    }
}
