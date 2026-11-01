<?php

namespace App\Modules\Identity\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesList extends Component
{
    use WithPagination;

    public bool $showModal = false;

    public bool $isEditing = false;

    public ?int $selectedRoleId = null;

    public string $name = '';

    public array $selectedPermissions = [];

    public bool $showDeleteModal = false;

    public ?int $roleToDeleteId = null;

    public function getPermissionGroupsProperty(): array
    {
        return [
            'dashboard' => [
                'title_ar' => 'لوحة التحكم والتقارير',
                'title_en' => 'Dashboard & Analytics',
                'icon' => 'fas fa-th-large',
                'permissions' => ['view dashboard'],
            ],
            'users' => [
                'title_ar' => 'إدارة المستخدمين',
                'title_en' => 'Users Management',
                'icon' => 'fas fa-users',
                'permissions' => ['view users', 'manage users'],
            ],
            'roles' => [
                'title_ar' => 'إدارة الأدوار والصلاحيات',
                'title_en' => 'Roles & Permissions',
                'icon' => 'fas fa-shield-alt',
                'permissions' => ['view roles', 'manage roles'],
            ],
            'properties' => [
                'title_ar' => 'إدارة الأصول والعقارات',
                'title_en' => 'Properties Management',
                'icon' => 'fas fa-building',
                'permissions' => ['view properties', 'manage properties'],
            ],
            'listings' => [
                'title_ar' => 'إدارة عروض البيع والإيجار',
                'title_en' => 'Listings Management',
                'icon' => 'fas fa-tag',
                'permissions' => ['view listings', 'manage listings'],
            ],
            'leads' => [
                'title_ar' => 'طلبات العملاء والاستفسارات',
                'title_en' => 'Leads & Inquiries',
                'icon' => 'fas fa-user-tag',
                'permissions' => ['view leads', 'manage leads'],
            ],
            'appointments' => [
                'title_ar' => 'مواعيد المعاينات والزيارات',
                'title_en' => 'Viewing Appointments',
                'icon' => 'fas fa-calendar-check',
                'permissions' => ['view appointments', 'manage appointments'],
            ],
            'settings' => [
                'title_ar' => 'إعدادات المنصة',
                'title_en' => 'Platform Settings',
                'icon' => 'fas fa-cogs',
                'permissions' => ['view settings', 'manage settings'],
            ],
        ];
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'selectedPermissions', 'selectedRoleId']);
        $this->isEditing = false;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function openEditModal(int $id)
    {
        $this->resetValidation();
        $role = Role::with('permissions')->findOrFail($id);

        $this->selectedRoleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function saveRole()
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('roles', 'name')->ignore($this->selectedRoleId),
            ],
            'selectedPermissions' => ['nullable', 'array'],
        ]);

        if ($this->isEditing) {
            $role = Role::findOrFail($this->selectedRoleId);
            $role->name = $this->name;
            $role->save();
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('success', __('Role updated successfully.'));
        } else {
            $role = Role::create(['name' => $this->name, 'guard_name' => 'web']);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('success', __('Role created successfully.'));
        }

        $this->showModal = false;
        $this->reset(['name', 'selectedPermissions', 'selectedRoleId']);
    }

    public function confirmDelete(int $id)
    {
        $role = Role::findOrFail($id);
        if ($role->name === 'super-admin') {
            session()->flash('error', __('The super-admin role cannot be deleted.'));

            return;
        }

        $this->roleToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteRole()
    {
        if ($this->roleToDeleteId) {
            $role = Role::findOrFail($this->roleToDeleteId);
            if ($role->name !== 'super-admin') {
                $role->delete();
                session()->flash('success', __('Role deleted successfully.'));
            }
        }

        $this->showDeleteModal = false;
        $this->roleToDeleteId = null;
    }

    public function render()
    {
        $roles = Role::with(['permissions', 'users'])->paginate(10);

        return view('livewire.admin.roles.roles-list', [
            'roles' => $roles,
            'permissionGroups' => $this->permissionGroups,
        ])->layout('admin.layouts.app', ['title' => __('Roles & Permissions')]);
    }
}
