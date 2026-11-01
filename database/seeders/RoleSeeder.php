<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'super-admin',
            'admin',
            'agency-manager',
            'agent',
            'client',
        ];

        foreach ($roles as $role) {
            Role::findOrCreate($role, 'web');
        }

        $permissions = [
            // Dashboard
            'view dashboard',

            // Users & Roles
            'view users',
            'manage users',
            'view roles',
            'manage roles',

            // Properties & Listings
            'view properties',
            'manage properties',
            'view listings',
            'manage listings',

            // Leads & Inquiries
            'view leads',
            'manage leads',

            // Viewings & Appointments
            'view appointments',
            'manage appointments',

            // Settings
            'view settings',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // Assign all permissions to super-admin and admin
        $superAdmin = Role::findByName('super-admin', 'web');
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::findByName('admin', 'web');
        $admin->givePermissionTo(Permission::all());

        $agent = Role::findByName('agent', 'web');
        $agent->syncPermissions([
            'view dashboard',
            'view properties',
            'manage properties',
            'view listings',
            'manage listings',
            'view leads',
            'view appointments',
        ]);

        $client = Role::findByName('client', 'web');
        $client->syncPermissions([
            'view listings',
            'view appointments',
        ]);
    }
}

