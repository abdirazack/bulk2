<?php

namespace App\Livewire\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\Computed;

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

    public function delete($id)
    {
        try {
            Role::findOrFail($id)->delete();
            $this->roles; // refresh computed property
            session()->flash('message', 'Role Deleted Successfully.');
            unset($this->roles);
        } catch (\Exception $e) {
            session()->flash('message', 'Role Deletion Failed.');
        }
        
    }

    public function create()
    {
        return redirect()->route('organization-user');
    }

    public function removePermission($roleId, $permissionId)
    {
        // dd($roleId, $permissionId);
        $role = Role::findOrFail($roleId);
        $role->permissions()->detach($permissionId);
        $this->roles; // refresh computed property
        session()->flash('message', 'Permission Removed Successfully.');
        unset($this->roles);
    }

    // public function addPermission($roleId, $permissionId)
    // {
    //     // dd($roleId, $permissionId);
    //     $role = Role::findOrFail($roleId);
    //     $role->permissions()->attach($permissionId);
    //     $this->roles; // refresh computed property
    //     session()->flash('message', 'Permission Added Successfully.');
    //     unset($this->roles);
    // }

    public function view($id)
    {
        return redirect()->route('view-role', ['id' => $id]);
    }
}
