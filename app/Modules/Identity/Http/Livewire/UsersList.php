<?php

namespace App\Modules\Identity\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersList extends Component
{
    use WithPagination;

    // Filters
    public string $search = '';

    public string $roleFilter = '';

    public string $statusFilter = '';

    // Modal Form State
    public bool $showModal = false;

    public bool $isEditing = false;

    public ?int $selectedUserId = null;

    // Form fields
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $role = 'client';

    public string $phone = '';

    public string $bio = '';

    public bool $is_active = true;

    // Delete Modal
    public bool $showDeleteModal = false;

    public ?int $userToDeleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'email', 'password', 'phone', 'bio', 'selectedUserId']);
        $this->role = 'client';
        $this->is_active = true;
        $this->isEditing = false;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function openEditModal(int $id)
    {
        $this->resetValidation();
        $user = User::with('roles')->findOrFail($id);

        $this->selectedUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->phone = $user->phone ?? '';
        $this->bio = $user->bio ?? '';
        $this->is_active = (bool) $user->is_active;
        $this->role = $user->roles->first()?->name ?? 'client';

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function saveUser()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->selectedUserId)],
            'role' => ['required', 'string', 'exists:roles,name'],
            'phone' => ['nullable', 'string', 'max:30'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
        ];

        if (! $this->isEditing) {
            $rules['password'] = ['required', 'string', 'min:8'];
        } else {
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }

        $this->validate($rules);

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
        ];

        if (! empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }

        if ($this->isEditing) {
            $user = User::findOrFail($this->selectedUserId);
            $user->update($userData);
            $user->syncRoles([$this->role]);
            session()->flash('success', __('User updated successfully.'));
        } else {
            $user = User::create($userData);
            $user->assignRole($this->role);
            session()->flash('success', __('User created successfully.'));
        }

        $this->showModal = false;
        $this->reset(['name', 'email', 'password', 'phone', 'bio', 'selectedUserId']);
    }

    public function confirmDelete(int $id)
    {
        $this->userToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        if ($this->userToDeleteId) {
            // Prevent deleting yourself
            if ($this->userToDeleteId === auth()->id()) {
                session()->flash('error', __('You cannot delete your own account.'));
                $this->showDeleteModal = false;

                return;
            }

            $user = User::findOrFail($this->userToDeleteId);
            $user->delete();
            session()->flash('success', __('User deleted successfully.'));
        }

        $this->showDeleteModal = false;
        $this->userToDeleteId = null;
    }

    public function toggleUserStatus(int $id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            session()->flash('error', __('You cannot deactivate your own account.'));

            return;
        }

        $user->is_active = ! $user->is_active;
        $user->save();
        session()->flash('success', __('User status updated.'));
    }

    public function render()
    {
        $query = User::with('roles');

        if (! empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%');
            });
        }

        if (! empty($this->roleFilter)) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->roleFilter);
            });
        }

        if ($this->statusFilter !== '') {
            $query->where('is_active', (bool) $this->statusFilter);
        }

        $users = $query->latest()->paginate(10);
        $roles = Role::all();

        return view('livewire.admin.users.users-list', [
            'users' => $users,
            'roles' => $roles,
        ])->layout('admin.layouts.app', ['title' => __('Users Management')]);
    }
}
