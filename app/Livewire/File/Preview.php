<?php

namespace App\Livewire\File;

use App\Models\Organization;
use Livewire\Component;
use App\Models\UploadedData;
use App\Models\OrganizationBatch;

class Preview extends Component
{
    public $progress;
    public $fileData = [];

    public $recurring;

    public $paymentDate;

    public $modifiedData = [];

    public $hasHeaders;

    

    public function mount()
    {
        $fileData = request('fileData');
        $hasHeaders = request('hasHeaders');
        if ($hasHeaders) {
            array_shift($fileData);
        }
        $this->hasHeaders = $hasHeaders;
        $this->fileData = json_decode($fileData, true);
        // dd($this->fileData);

    }

    public function render()
    {
        return view(
            'livewire.file.preview'
            ,
            [
                'fileData' => $this->fileData,
            ]
        );
    }

    public function saveModifiedData()
    {
        // validate payment date
       $val = $this->validate([
            'paymentDate' => 'required|date',
        ]);
        
        $this->modifiedData = $this->fileData;
    

        //check if date and recurring is selected
        if ($this->paymentDate != null) 
        {
            foreach ($this->modifiedData as $key => $value) {
                if($this->recurring == null){
                    $this->modifiedData[$key][] = false;
                }
                else{
                    $this->modifiedData[$key][] = true;
                }
              
                $this->modifiedData[$key][] = $this->paymentDate;
       }
    }
        // Create a new instance of OrganizationBatch
        try{
            $organizationBatch = new OrganizationBatch();
            $organizationBatch->organization_user_id = auth()->user()->id;
            $organizationBatch->batch_number = 'BATCH-' . time();
            $organizationBatch->total_records = count($this->modifiedData);
            $organizationBatch->total_amount = array_sum(array_column($this->modifiedData, 3));
            $organizationBatch->status = 'pending';
            $organizationBatch->save();
 

        // Convert modified data to JSON
        $fileDataJson = json_encode($this->modifiedData);

            $UploadedData = new UploadedData();
            $UploadedData->file_name = 'FILE-' . time();
            $UploadedData->file_data = $fileDataJson;
            $UploadedData->created_by = auth()->user()->id;
            $UploadedData->organization_id = auth()->user()->organization_id;
            $UploadedData->organization_batch_id = $organizationBatch->id;
            $UploadedData->save();
        }
        catch(\Exception $e){
            // dd($e->getMessage());  
            session()->flash('error', 'Error saving uploaded data. Please try again later.' . $e->getMessage()); 
        }
       
        session()->flash('success', 'File uploaded successfully!');

        return redirect()->route('approval');
    }

    public function cancel()
    {
        return redirect()->route('file-upload');
    }

}
