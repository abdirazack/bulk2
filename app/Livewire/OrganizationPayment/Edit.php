<?php

namespace App\Livewire\OrganizationPayment;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\OrganizationPayment;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public $id ;

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    #[Computed]
    public function payments()
    {
        return OrganizationPayment::with('organization', 'user', 'organizationBatch')->where('id', $this->id)->first();
    }

    public function mount($id)
    {
        $this->id = $id;
        // $this->payments = OrganizationPayment::findOrFail($id);

    }
    public function render()
    {
        return view('livewire.organization-payment.edit');
    }
}
