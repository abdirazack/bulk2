<?php

namespace App\Livewire\Approval;

use Livewire\Component;
use App\Models\UploadedData;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Details extends Component
{
    use WithPagination;
    public $displayDetails = null;
    private $data = null;
    public $data2 = null;
    public $id = null;
    public $batchInfo =[];
    private $perPage = 10;

    public function mount($id)
    {

        $this->id = Crypt::decryptString($id);
      
        $this->displayDetails = UploadedData::where('id', $this->id)->with('organizationBatch')->first();


        if (is_null($this->displayDetails)) {
            session()->flash('error', 'Uploaded data not found.');
            return;
        }
        $this->batchInfo = $this->displayDetails->organizationBatch;
        

        $this->displayDetails = json_decode($this->displayDetails->file_data, true);

    
        // Assign the decoded data to the component property
        $this->data = $this->displayDetails;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage =  $this->perPage;
    $total = count($this->displayDetails);
    $data = collect($this->displayDetails)->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $this->data = new LengthAwarePaginator($data, $total, $perPage, $currentPage);

    }

    public function render()
    {
        $data = $this->data;
        // dd($data);
        return view('livewire.approval.details', compact('data'));
    }
    public function updatedPage($page)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage;
        $total = count($this->displayDetails);
        $data = collect($this->displayDetails)->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $this->data = new LengthAwarePaginator($data, $total, $perPage, $currentPage);
    }
}
