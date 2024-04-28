<?php

namespace App\Livewire\OrganizationUser;

use Livewire\Component;
use App\Models\OrganizationUser;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    // listen for closeModal event the rerender the component
    
    #[on('closeModal')]
    public function render()
    {
        return view('livewire.organization-user.show'
        , [
            'organizationUsers' => OrganizationUser::paginate(10)
        ]);
    }

    public function delete($id)
    {
        try {
            OrganizationUser::find($id)->delete();
            session()->flash('message', 'Organization User Deleted Successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Organization User is associated with some records.');
        }
       
    }
}
