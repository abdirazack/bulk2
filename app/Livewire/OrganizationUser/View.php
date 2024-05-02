<?php

namespace App\Livewire\OrganizationUser;

use Livewire\Component;
use App\Models\OrganizationUser;
use Spatie\Permission\Models\Role;

class View extends Component
{
    public $user_id;

    public $roles;

    public $user;

    public function mount($user_id)
    {
        $this->user_id = $user_id;

        $this->user = OrganizationUser::findOrFail($this->user_id);

        $this->roles = Role::all();
    }


    public function render()
    {
        return view('livewire.organization-user.view'
        , [
            'user' => OrganizationUser::with('roles')->findOrFail($this->user_id)
        ]);
    }

    public function doesUserHaveRole()
    {
        // first if $user_id is empty then return false
        if (!$this->user_id) {
            return false;
        }

        // check if user has role 
        $user = OrganizationUser::findOrFail($this->user_id);
        return $user->roles()->exists();
    }

    public function attach($role_id)
    {
        $user = OrganizationUser::findOrFail($this->user_id);
        $user->roles()->attach($role_id);
        $this->mount($this->user_id);
        $this->render();
    }

    public function detach($role_id)
    {
        $user = OrganizationUser::findOrFail($this->user_id);
        $user->roles()->detach($role_id);
        $this->mount($this->user_id);
        $this->render();
    }
}
