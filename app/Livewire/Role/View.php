<?php

namespace App\Livewire\Role;


use Livewire\Component;

use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class View extends Component
{
    public $role_id = null;
    // computed roles
    #[Computed('roles')]
    public function roles()
    {
        return Role::with('permissions')->where('id', $this->role_id)->first();    
    }

    #[Computed('permissions')]
    public function permissions()
    {
        return Permission::whereNotIn('id', $this->roles->permissions->pluck('id'))->get();
    }

    
    public function render()
    {
        return view('livewire.role.view');
    }

   
    public function mount($id)
    {
        $this->role_id = $id;
        $this->roles = Role::findOrFail($id)->load('permissions');
        $this->permissions = Permission::whereNotIn('id', $this->roles->permissions->pluck('id'))->get();
    }


        public function attach($roleId, $permissionId)
    {
        // dd($roleId, $permissionId);
        $role = Role::findOrFail($roleId);
        $role->permissions()->attach($permissionId);
        session()->flash('message', 'Permission Added Successfully.');
        $this->refresh();   
    }

    public function detach($roleId, $permissionId)
    {
        // dd($roleId, $permissionId);
        $role = Role::findOrFail($roleId);
        $role->permissions()->detach($permissionId);
        session()->flash('message', 'Permission Removed Successfully.');
        $this->refresh();   
    }

    
    public function refresh()
    {
    //    remount and rerender the component
        $this->mount($this->role_id);
        $this->render();
    }
}
