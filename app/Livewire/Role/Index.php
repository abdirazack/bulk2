<?php

namespace App\Livewire\Role;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    #[Computed('roles')]
    public function roles()
    {
        return Role::with('permissions')->get();
    }

    public function render()
    {
        return view('livewire.role.index');
    }

    public function create()
    {
        return redirect()->route('organization-user');
    }

    public function removePermission($roleId, $permissionId)
    {
        $role = Role::findOrFail($roleId);
        $role->revokePermissionTo($permissionId);
        session()->flash('message', 'Permission removed successfully.');
        $this->dispatch('permissionRemoved')->to(Index::class);
    }

    public function view($id)
    {
        return redirect()->route('view-role', ['id' => $id]);
    }

    #[On('permissionRemoved')]
    public function permissionRemoved()
    {
        session()->flash('message', 'Permission removed successfully.');
        unset($this->roles);
        $this->render();
    }
}
