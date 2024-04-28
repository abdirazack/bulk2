<?php

namespace App\Livewire\OrganizationUser;

use Livewire\Component;
use App\Models\OrganizationUser;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
   
    public $username;
    public $email;
    public $password;
    public $organization_id;
    public $password_confirmation;
    public function render()
    {
        return view('livewire.organization-user.create');
    }

    public function save()
    {
        $this->validate([
            'username' => 'required|unique:organization_users,username',
            'email' => 'required|email|unique:organization_users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        // check if the user is already exist
        $user = OrganizationUser::where('email', $this->email)->first();
        if ($user) {
            session()->flash('error', 'User already exist.');
            return;
        }

        try {
            $this->createUser();
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong.');
        }

        session()->flash('message', 'Organization User Created Successfully.');
        $this->closeModal();
    }

    public function createUser()
    {
        OrganizationUser::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'organization_id' => 1,//auth()->user()->organization_id,
        ]);
    }
}
