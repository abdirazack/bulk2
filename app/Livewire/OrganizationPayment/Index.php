<?php

namespace App\Livewire\OrganizationPayment;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\OrganizationPayment;

class Index extends Component
{

    #[Computed]
    public function OrganizationPayments()
    {
        return OrganizationPayment::with('organization', 'organizationBatch')->where('organization_id', auth()->user()->organization_id)->paginate(10);
    }
    #[On('isRecurringChanged')]
    public function isRecurringChanged()
    {
        $this->OrganizationPayments;

        session()->flash('success', 'Payment updated successfully');
    }
    public function render()
    {
        return view(
            'livewire.organization-payment.index'
            ,
            ['organizationPayments' => $this->OrganizationPayments]
        );
    }

    public function toggleIsRecurring($id)
    {
        $organizationPayment = OrganizationPayment::find($id);
        if(!$organizationPayment)
        {
            session()->flash('error', 'Organization Payment not found');
        }
        $organizationPayment->is_recurring = !$organizationPayment->is_recurring;
        $organizationPayment->save();
        $this->dispatch('isRecurringChanged');

        session()->flash('success', 'Payment updated successfully');
    }
}
