<?php

namespace App\Livewire\OrganizationPayment;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public function render()
    {
        return view('livewire.organization-payment.edit');
    }
}
