<?php

namespace App\Livewire\Approval;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Jobs\ProcessPayment;
use App\Models\UploadedData;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Computed]
    public function uploadedData()
    {
        $organizationId = auth()->user()->organization_id;

        // Fetch pending batches with payments for the logged-in organization
        return UploadedData::where('organization_id', $organizationId)
            ->with('organizationBatch')
            ->whereHas('organizationBatch', function ($query) {
                $query->where('status', 'pending');
            })
            ->paginate(5);
    }   
    public function render()
    {
        $uploadedData = $this->uploadedData;
        return view('livewire.approval.index', compact('uploadedData'));
    }

    public function approve($id)
    {

        $loginOrg = auth()->user()->organization_id;
        $uploadedData = UploadedData::with('organizationBatch')->find($id);

        if (!$uploadedData) {
            session()->flash('error', 'Data not found.');
            return;
        }

        $file_data = json_decode($uploadedData->file_data, true);

        $organizationId = $uploadedData->organization_id;
        $organization_batch_id = $uploadedData->organization_batch_id;

        //check login org  wallet and sum of amount in file_data

        // $loginOrgWallet = OrganizationWallet::find($loginOrg)->wallet;
        // //check if login org wallet exists
        // if (!$loginOrgWallet) {
        //     session()->flash('error', 'Wallet not found.');
        //     return;
        // }
        // if (is_null($loginOrgWallet->balance)) {
        //     $loginOrgWallet->balance = 0;
        // }
        // if ($loginOrgWallet->balance < array_sum(array_column($file_data, 3))) {
        //     session()->flash('error', 'Insufficient balance.');
        //     return;
        // }

        $uploadedData->organizationBatch->status = 'approved';
        $uploadedData->organizationBatch->save();

        if ($loginOrg == $organizationId && $organization_batch_id != null) {
            //    call process payment job
            ProcessPayment::dispatch($file_data, $organizationId, $organization_batch_id);
        } else {
            session()->flash('error', 'authorization failed.');
            return;
        }

        session()->flash('success', 'Data approved successfully.');
    }

    public function reject($id)
    {
        $uploadedData = UploadedData::with('organizationBatch')->find($id);
        if (!$uploadedData) {
            session()->flash('error', 'Data not found.');
            return;
        }
        
        // Mark all unread notifications for the current user as read
       
        
        // Update the status of the associated organization batch to 'rejected'
        $uploadedData->organizationBatch->status = 'rejected';
        $uploadedData->organizationBatch->save();
        
        session()->flash('success', 'Data rejected successfully.');
    }
}