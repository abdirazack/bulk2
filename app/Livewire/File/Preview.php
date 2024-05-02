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

        //check if date and recurring is selected
        if ($this->recurring && $this->paymentDate != null) {
            foreach ($this->modifiedData as $key => $value) {
                $this->modifiedData[$key][] = $this->recurring;
                $this->modifiedData[$key][] = $this->paymentDate;
            }
        }

        // Get login user id and organization id
        $loginUserId = auth()->user()->id;
        $orgId = auth()->user()->organization_id;

        // Create a new instance of OrganizationBatch
        $organizationBatch = new OrganizationBatch([
            'batch_number' => 'BATCH-' . time(),
            'total_records' => count($this->modifiedData),
            'total_amount' => array_sum(array_column($this->modifiedData, 3)),
            'status' => 'pending',
        ]);

        $organizationBatch->save();

        // Convert modified data to JSON
        $fileDataJson = json_encode($this->modifiedData);

        // Insert data into UploadedData table
        $UploadedData = new UploadedData([
            'file_name' => 'FILE-' . time(),
            'file_data' => $fileDataJson,
            'created_by' => $loginUserId,
            'organization_id' => $orgId,
            'organization_batch_id' => $organizationBatch->id,
        ]);

        $UploadedData->save();

        session()->flash('message', 'File uploaded successfully!');
    }

    public function cancel()
    {
        return redirect()->route('file-upload');
    }

}
