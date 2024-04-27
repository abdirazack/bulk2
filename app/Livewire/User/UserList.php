<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{    
    use WithPagination;


    
    public function render()
    {
        return view('livewire.user.user-list'
        , ['users' => User::with('roles')->paginate(10)]);
    }

    public function delete($id)
    {
        try {
            User::findOrFail($id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
        } catch (\Exception $e) {
            session()->flash('message', 'User Deletion Failed.');
        }
        
    }

    public function create()
    {
        return redirect()->route('organization-user');
    }

    public function view($id)
    {
        return redirect()->route('organization-user', ['id' => $id]);
    }


}
