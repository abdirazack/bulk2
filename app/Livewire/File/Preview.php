<?php

namespace App\Livewire\File;

use Livewire\Component;
use App\Jobs\ProcessPayment;
use App\Models\OrganizationBatch;
use Livewire\Attributes\On;

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
        $this->fileData = json_decode($fileData, true);
        // dd($this->fileData);
        $this->hasHeaders = $hasHeaders;

    }



    public function render()
    {
        return view(
            'livewire.file.preview'
            ,
            [
                'fileData' => $this->fileData
            ]
        );
    }

    public function saveModifiedData()
    {
        $this->validate([
            'recurring' => 'required',
            'paymentDate' => 'required',
        ]);

        $this->modifiedData = $this->fileData;

        foreach ($this->modifiedData as $key => $value) {
            $this->modifiedData[$key][] = $this->recurring;
            $this->modifiedData[$key][] = $this->paymentDate;
        }
        // dd($this->modifiedData);
        // loged in user organization id
        $organizationId = auth()->user()->organization_id;
        // dd($organizationId);

        // create new instance of OrganizationBatch
        $organizationBatch = new OrganizationBatch([
            'batch_number' => 'BATCH-' . time(),
            'total_records' => count($this->modifiedData),
            'total_amount' => array_sum(array_column($this->modifiedData, 3)),
            'status' => 'pending'
        ]);

        $organizationBatch->save();

        $organization_batch_id = $organizationBatch->id;

        //    call process payment job
        ProcessPayment::dispatch($this->modifiedData, $organizationId, $organization_batch_id);

        session()->flash('message', 'Payments processed successfully!');

        return redirect()->route('file-upload');
    }

    public function cancel()
    {
        return redirect()->route('file-upload');
    }


}
