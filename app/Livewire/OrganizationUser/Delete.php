<?php

namespace App\Livewire\OrganizationUser;

use Livewire\Attributes\Computed;
use Livewire\Component;

use App\Models\OrganizationUser;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\OrganizationUser\Show;

class Delete extends ModalComponent
{

    public $id;

    public $user;

    #[Computed]
    public function user()
    {
        return OrganizationUser::find($this->id);
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function mount($id)
    {
        // find user by id
        $this->user = OrganizationUser::find($id);
        if (!$this->user) {
            session()->flash('error', 'User not found.');
            return;
        } else {
            $this->id = $id;
        }
    }

    public function render()
    {
        return view('livewire.organization-user.delete');
    }

    public function delete()
    {
        try {
            if ($this->user) {
                $this->user->delete();
                $this->closeModal();
                $this->dispatch('userDeleted')->to(Show::class);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Organization User is associated with some records.' . $e->getMessage());
        }
    }
}
