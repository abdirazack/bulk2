<?php

namespace App\Livewire\File;

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
        $this->modifiedData = $this->fileData;
        $organization_batch_id = '';

        //check if date and recurring is selected
        if ($this->recurring && $this->paymentDate != null) {
            foreach ($this->modifiedData as $key => $value) {
                $this->modifiedData[$key][] = $this->recurring;
                $this->modifiedData[$key][] = $this->paymentDate;
            }
        }



        // Create a new instance of OrganizationBatch
        try{
            $organizationBatch = new OrganizationBatch();
            $organizationBatch->batch_number = 'BATCH-' . time();
            $organizationBatch->total_records = count($this->modifiedData);
            $organizationBatch->total_amount = array_sum(array_column($this->modifiedData, 3));
            $organizationBatch->status = 'pending';
            $organizationBatch->save();

           $organization_batch_id = $organizationBatch->id;
        }catch(\Exception $e){
            // dd($e->getMessage());  
            session()->flash('error', 'Error saving batch data. Please try again later.' . $e->getMessage()); 
        }

     
       

        // Convert modified data to JSON
        $fileDataJson = json_encode($this->modifiedData);

        // Insert data into UploadedData table
        try{
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
