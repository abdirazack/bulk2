<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\UploadedData;

use Illuminate\Support\Facades\Crypt;

class DisplayDetails extends Component
{
    public $displayDetails = null;
    public $data = null;
    public $id = null;
    public $batchInfo =[];


    public function mount($id)
    {

        $this->id = Crypt::decryptString($id);
      
        $this->displayDetails = UploadedData::where('id', $this->id)-> with('organizationBatch')->first();

        if (is_null($this->displayDetails)) {
            session()->flash('error', 'Uploaded data not found.');
            return;
        }
        $this->batchInfo = $this->displayDetails->organizationBatch;
        

        $this->displayDetails = json_decode($this->displayDetails->file_data, true);

    
        // Assign the decoded data to the component property
        $this->data = $this->displayDetails;
    }

    public function render()
    {
        return view('livewire.display-details');
    }



}
