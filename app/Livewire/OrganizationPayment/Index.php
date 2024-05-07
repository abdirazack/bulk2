<?php

namespace App\Livewire\OrganizationPayment;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Models\OrganizationPayment;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    #[Url(as: 'S', history: true)]
    public $search = '';

    #[Computed]
    public function OrganizationPayments()
    {
        return OrganizationPayment::with('organization', 'user', 'organizationBatch')->where('organization_id', auth()->user()->organization_id);
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
            [
                'organizationPayments' => $this->OrganizationPayments->where('account_name', 'like', '%' . $this->search . '%')
            ->orWhere('account_provider', 'like', '%' . $this->search . '%')
            ->orWhere('account_number', 'like', '%' . $this->search . '%')
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->orWhere('payment_date', 'like', '%' . $this->search . '%')
            ->orWhereHas('user', function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('organizationBatch', function ($query) {
                $query->where('batch_number', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('organization', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(5)
            ]
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
       unset($this->OrganizationPayments);
        session()->flash('success', 'Payment updated successfully');
    }
}
