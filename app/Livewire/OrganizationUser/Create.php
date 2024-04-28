<?php

namespace App\Livewire\OrganizationUser;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public function render()
    {
        return view('livewire.organization-user.create');
    }
}
