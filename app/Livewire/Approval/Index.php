<?php

namespace App\Livewire\Approval;

use App\Jobs\ProcessPayment;
use App\Models\Activities;
use App\Models\OrganizationUser;
use App\Models\OrganizationWallet;
use App\Models\UploadedData;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;

class Index extends Component
{
    use WithPagination;

    public $data = [];

    public $search = '';

    public $sortField = 'created_at';

    public $sortOrder = 'asc';

    #[Computed]
    public function uploadedData()
    {

        return QueryBuilder::for(UploadedData::class)
            ->allowedIncludes(['organizationBatch', 'organizationUser', 'organization'])
            ->allowedFilters(['file_name', 'created_at'])
            ->allowedSorts('organizationBatch.batch_number', 'file_name', 'created_at')
            ->whereHas('organizationBatch', function ($query) {
                $query->where('status', 'pending');
            })
            ->whereHas('organizationBatch', function ($query) {
                $query->where('batch_number', 'like', '%'.$this->search.'%')
                    ->orWhere('created_by', 'like', '%'.$this->search.'%')
                    ->orWhere('file_name', 'like', '%'.$this->search.'%')
                    ->orWhere('total_records', 'like', '%'.$this->search.'%')
                    ->orWhere('total_amount', 'like', '%'.$this->search.'%')
                    ->orWhere('created_at', 'like', '%'.$this->search.'%')
                    ->orWhere('status', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortOrder)
            ->paginate(5);
    }

    public function render()
    {
        unset($this->uploadedData);
        $uploadedData = $this->uploadedData;

        return view('livewire.approval.index', compact('uploadedData'));
    }

    public function approve($id)
    {

        $loginOrg = auth()->user()->organization_id;
        $uploadedData = UploadedData::with('organizationBatch')->find($id);

        if (! $uploadedData) {
            session()->flash('error', 'Data not found.');

            return;
        }

        $file_data = json_decode($uploadedData->file_data, true);

        $organizationId = $uploadedData->organization_id;
        $organization_batch_id = $uploadedData->organization_batch_id;


        $loginOrgWallet = OrganizationWallet::find($loginOrg);
        //check if login org wallet exists
        if (!$loginOrgWallet) {
            return redirect()->with('error', 'organization wallet not found.');

        }
        if (is_null($loginOrgWallet->balance)) {
            $loginOrgWallet->balance = 0;
        }
        if ($loginOrgWallet->balance < array_sum(array_column($file_data, 3))) {
            session()->flash('error', 'Insufficient balance.');
            return;
        }

        $uploadedData->organizationBatch->status = 'approved';
        $uploadedData->organizationBatch->save();

        if ($loginOrg == $organizationId && $organization_batch_id != null) {

            $retunedstuff = ProcessPayment::dispatch($file_data, $organizationId, $organization_batch_id, $organization_user_id = auth()->user()->id);

        
        } else {
            session()->flash('error', 'authorization failed.');

            return;
        }
        Activities::create([
            'organization_user_id' => auth()->user()->id,
            'action' => 'approved',
            'description' => 'Data approved successfully.',
        ]);

        session()->flash('success', 'Data approved successfully.');
    }

    public function reject($id)
    {
        $uploadedData = UploadedData::with('organizationBatch')->find($id);
        if (! $uploadedData) {
            session()->flash('error', 'Data not found.');

            return;
        }

        // Mark all unread notifications for the current user as read

        // Update the status of the associated organization batch to 'rejected'
        $uploadedData->organizationBatch->status = 'rejected';
        $uploadedData->organizationBatch->save();

        session()->flash('success', 'Data rejected successfully.');
    }

    public function getUserName($id)
    {
        return OrganizationUser::find($id)->name;
    }

    public function details($id)
    {
        // Encode the ID before redirecting
        $encodedId = Crypt::encryptString($id);

        return redirect()->route('details', ['id' => $encodedId]);
    }

    public function search()
    {
        $this->resetPage();
        $this->uploadedData();
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
