<?php

namespace App\Livewire\OrganizationUser;

use App\Models\OrganizationUser;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    #[Url(as: 'S', history: true)]
    public $search = '';

    public $sortField = 'created_at';

    public $sortOrder = 'asc';

    #[Computed]
    public function organizationUsers()
    {
        return OrganizationUser::with('roles')->where('organization_id', Auth()->user()->organization_id);
    }

    // listen for closeModal event the rerender the component

    #[on('closeModal')]
    public function render()
    {
        $organizationUsers = $this->organizationUsers->where('username', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('created_at', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortOrder)
            ->paginate(5);

        return view(
            'livewire.organization-user.show',
            [
                'organizationUsers' => $organizationUsers,
            ]
        );
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

    public function viewUser($user_id)
    {
        return redirect()->route('organization-user.view', ['user_id' => $user_id]);

    }

    #[On('userCreated')]
    public function userCreated()
    {
        session()->flash('success', 'User Created Successfully.');
        $this->render();
    }

    #[On('userUpdated')]
    public function userUpdated()
    {
        session()->flash('success', 'User Updated Successfully.');
        $this->render();
    }

    #[On('userDeleted')]
    public function userDeleted()
    {
        session()->flash('success', 'User Deleted.');
        $this->render();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortOrder = 'asc';
        }

        $this->sortField = $field;
    }
}
