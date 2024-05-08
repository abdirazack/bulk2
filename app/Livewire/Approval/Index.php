<?php

namespace App\Livewire\Approval;

use Livewire\Component;
use App\Models\Activities;
use App\Jobs\ProcessPayment;
use App\Models\UploadedData;
use Livewire\WithPagination;
use App\Models\OrganizationUser;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Crypt;
class Index extends Component
{
    use WithPagination;

    public $data=[];
    public $search = '';
  

    #[Computed]
    public function uploadedData()
    {
        $organizationId = auth()->user()->organization_id;
    
        $query = UploadedData::where('organization_id', $organizationId)
            ->with('organizationBatch')
            ->whereHas('organizationBatch', function ($query) {
                $query->where('status', 'pending');
            });
    
        if (!empty($this->search)) {
       
            $query->with('organizationBatch')->whereHas('organizationBatch', function ($query){
                $query->where('batch_number', 'like', '%' . $this->search . '%')
                    ->orWhere('created_by', 'like', '%' . $this->search . '%')
                    ->orWhere('file_name', 'like', '%' . $this->search . '%')
                    ->orWhere('total_records', 'like', '%' . $this->search . '%')
                    ->orWhere('total_amount', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            });
        }
    
        return $query->paginate(5);
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
        //    dd($file_data);
           $retunedstuff =  ProcessPayment::dispatch($file_data, $organizationId, $organization_batch_id, $organization_user_id = auth()->user()->id);

        //    dd($retunedstuff);
        } else {
            session()->flash('error', 'authorization failed.');
            return;
        }
        Activities::create([
            'organization_user_id' => auth()->user()->id,
            'action' => 'approved',
            'description' => 'Data approved successfully.'
        ]);


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
    

    
    
}
