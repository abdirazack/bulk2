<?php

namespace App\Livewire\Organization;


use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Spatie\Permission\Models\Role;

class OrganizationUser extends Component
{

    public $user_id = '';
    public $name;
    public $email;
    public $password;

    public $confrmation_password;

    public $btnText = 'Create';

    public $headerText = 'Create New Organization User';


    public $roles ;

    public $selectedRoles;

    // computed user with roles
    #[Computed('user')]
    public function user()
    {
        return User::all()->load('roles');
    }
    


    public function mount($id = null)
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->confrmation_password = '';


        
        if ($id) {
            $this->user_id = $id;
            $this->user = User::findOrFail($id)->load('roles');
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->btnText = 'Update';
            $this->headerText = 'Update Organization User'; 
        }
    }


    public function render()
    {
        $this->roles = Role::all();
        return view('livewire.organization.organization-user');
    }
    public function submit()
    {
        // dd($this->name, $this->email, $this->password, $this->confrmation_password);
        $validated =  $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confrmation_password' => 'required|same:password',
        ]);
        // dd($validated);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset();

        session()->flash('message', 'User Created Successfully.');
        return redirect()->route('organization-user');
    }

    public function doesUserHaveRole()
    {
        // first if $user_id is empty then return false
        if (!$this->user_id) {
            return false;
        }

        // check if user has role 
        $user = User::findOrFail($this->user_id);
        return $user->roles()->exists();
    }

    public function attach($role_id)
    {
        $user = User::findOrFail($this->user_id);
        $user->roles()->attach($role_id);
        $this->mount($this->user_id);
        $this->render();
    }

    public function detach($role_id)
    {
        $user = User::findOrFail($this->user_id);
        $user->roles()->detach($role_id);
        $this->mount($this->user_id);
        $this->render();
    }


}
