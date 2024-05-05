<?php

namespace App\Livewire\Role;


use Livewire\Component;
use Livewire\Attributes\Computed;
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
        
    }

    

    public function view($id)
    {
        return redirect()->route('view-role', ['id' => $id]);
    }
}
