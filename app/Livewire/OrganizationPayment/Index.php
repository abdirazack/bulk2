<?php

namespace App\Livewire\OrganizationPayment;

use App\Models\OrganizationPayment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(as: 'S', history: true)]
    public $search = '';

    public $statusFilter = '';

    public $isRecurringFilter = '';

    public $accountProviderFilter = '';

    public $accountNameFilter = '';

    public $selectedDateFilter = '';

    public $amountFilter = '';

    public $amountValue = '';

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

    public function updated()
    {

        $this->filterOrganizationPayments();
    }

    public function filterOrganizationPayments()
    {
        // Get the base query
        $query = $this->OrganizationPayments();

        // Apply search filter
        $query->where(function ($q) {
            $q->where('account_name', 'like', '%'.$this->search.'%')
                ->orWhere('account_provider', 'like', '%'.$this->search.'%')
                ->orWhere('account_number', 'like', '%'.$this->search.'%')
                ->orWhere('amount', 'like', '%'.$this->search.'%')
                ->orWhere('payment_date', 'like', '%'.$this->search.'%');
        });

        // Apply other filters
        if (! empty($this->statusFilter) || $this->statusFilter !== '') {

            $query->where('status', $this->statusFilter);
        }
        if (! empty($this->isRecurringFilter) || $this->isRecurringFilter !== '') {
            $query->where('is_recurring', $this->isRecurringFilter);
        }
        if (! empty($this->accountProviderFilter) || $this->accountProviderFilter !== '') {
            $query->where('account_provider', $this->accountProviderFilter);
        }
        if ($this->accountNameFilter !== '' || ! empty($this->accountNameFilter)) {
            $query->where('account_name', $this->accountNameFilter);
        }

        if (! empty($this->selectedDateFilter) || $this->selectedDateFilter !== '') {
            //convert mysql date to php date
            $this->selectedDateFilter = date('Y-m-d', strtotime($this->selectedDateFilter));

            // dd($this->selectedDateFilter);
            $query->where('payment_date', $this->selectedDateFilter);
        }
        if (! empty($this->amountFilter) && ! empty($this->amountValue) || $this->amountFilter !== '' && $this->amountValue !== '') {
            if ($this->amountFilter == 'equals') {
                $query->where('amount', '=', $this->amountValue);
            } elseif ($this->amountFilter == 'less_than') {
                $query->where('amount', '<', $this->amountValue);
            } elseif ($this->amountFilter == 'greater_than') {
                $query->where('amount', '>', $this->amountValue);
            }
        }

        // Return paginated results
        return $query->paginate(10);
    }

    public function toggleIsRecurring($id)
    {
        $organizationPayment = OrganizationPayment::find($id);
        if (! $organizationPayment) {
            session()->flash('error', 'Organization Payment not found');
        }
        $organizationPayment->is_recurring = ! $organizationPayment->is_recurring;
        $organizationPayment->save();
        unset($this->OrganizationPayments);

        session()->flash('success', 'Payment updated successfully');
    }
}
