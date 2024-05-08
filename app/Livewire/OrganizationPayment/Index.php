<?php

namespace App\Livewire\OrganizationPayment;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Models\OrganizationPayment;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;

class Index extends Component
{
    use WithPagination;
    #[Url(as: 'S', history: true)]
    public $search = '';

    public $statusFilter='';
    public $isRecurringFilter='';
    public $accountProviderFilter='';
    public $accountNameFilter='';
    public $dateRangeFilter='';
    public $amountFilter = '';
    
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
        $organizationPayments = $this->filterOrganizationPayments();

        return view('livewire.organization-payment.index', ['organizationPayments' => $organizationPayments]);
    }
    public function updated($property)
    {

        $this->filterOrganizationPayments();

    }
    
  
    public function filterOrganizationPayments()
    {       
        // Get the base query
        $query = $this->OrganizationPayments();

        // Apply search filter
        $query->where(function ($q) {
            $q->where('account_name', 'like', '%' . $this->search . '%')
              ->orWhere('account_provider', 'like', '%' . $this->search . '%')
              ->orWhere('account_number', 'like', '%' . $this->search . '%')
              ->orWhere('amount', 'like', '%' . $this->search . '%')
              ->orWhere('payment_date', 'like', '%' . $this->search . '%');
        });

        // Apply other filters
        if (!empty($this->statusFilter) || $this->statusFilter !== '') {


            $query->where('status', $this->statusFilter);
        }
        if (!empty($this->isRecurringFilter) || $this->isRecurringFilter !== '') {
            $query->where('is_recurring', $this->isRecurringFilter);
        }
        if (!empty($this->accountProviderFilter) || $this->accountProviderFilter !== '') {
            $query->where('account_provider', $this->accountProviderFilter);
        }
        if($this->accountNameFilter !== '' || !empty($this->accountNameFilter)) {
            $query->where('account_name', $this->accountNameFilter);
        }

        if(!empty($this->dateRangeFilter) || $this->dateRangeFilter !== '') {
            $query->where('payment_date', $this->dateRangeFilter);
        }
        if($this->amountFilter !== '' || !empty($this->amountFilter)) {
            $query->whereBetween('amount', [$this->amountFilter, $this->amountFilter]);
        }

        // Return paginated results
        return $query->paginate(20);
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
