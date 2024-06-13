<?php

namespace App\Livewire\File;

use App\Models\AccountProvider;
use App\Models\OrganizationBatch;
use App\Models\UploadedData;
use Livewire\Component;

class Preview extends Component
{
    public $progress;

    public $fileData = [];

    public $recurring;

    public $paymentDate;

    public $modifiedData = [];

    public $AccountProviders = [];

    public function mount()
    {
        $fileData = session('fileData');
        if (is_null($fileData)) {
            session()->flash('error', 'No file data found. Please upload a file.');

            return redirect()->route('file-upload');
        }

        $this->fileData = json_decode($fileData, true);
        if (is_null($this->fileData)) {
            session()->flash('error', 'File data could not be parsed. Please try again.');

            return redirect()->route('file-upload');
        }
    }

    protected function getTrimmedAccountProviders()
    {
        // Fetch account providers and trim their names
        return AccountProvider::pluck('name')->map(function ($name) {
            return trim($name);
        })->toArray();
    }

    public function render()
    {
        $AccountProviders = $this->getTrimmedAccountProviders();

        $this->compareAccount($this->fileData, $AccountProviders);

        return view('livewire.file.preview', [
            'fileData' => $this->fileData,
            'accountProviders' => $AccountProviders,
        ]);
    }

    public function compareAccount($fileData, $accountProviders)
    {

        if (empty($fileData) || empty($accountProviders)) {
            return false;
        }

        foreach ($fileData as $row) {

            if (empty($row[1])) {
                return redirect()->route('file-upload')->with('error', 'Account provider not found.');
            }
            $account_provider = trim($row[1]);

            if (! in_array($account_provider, $accountProviders)) {
                return redirect()->route('file-upload')->with('error', 'Account provider not found.');
            }
        }

        return true;
    }

    public function deleteRow($index)
    {
        unset($this->fileData[$index]);
    }

    public function saveModifiedData()
    {
        // validate payment date
        $val = $this->validate([
            'paymentDate' => 'required|date',
        ]);

        $this->modifiedData = $this->fileData;

        // Check if date and recurring are selected
        if ($this->paymentDate != null) {
            foreach ($this->modifiedData as $key => $value) {
                if ($this->recurring == null) {
                    $this->modifiedData[$key][] = false;
                } else {
                    $this->modifiedData[$key][] = true;
                }
                $this->modifiedData[$key][] = $this->paymentDate;
            }
        }
        $batchNumber = strtoupper(substr(uniqid(), -6));

        try {
            $organizationBatch = new OrganizationBatch();
            $organizationBatch->organization_user_id = auth()->user()->id;
            $organizationBatch->batch_number = $batchNumber;
            $organizationBatch->total_records = count($this->modifiedData); // Exclude header row
            $organizationBatch->total_amount = array_sum(array_column($this->modifiedData, 3));
            $organizationBatch->status = 'pending';
            $organizationBatch->save();

            // Convert modified data to JSON
            $fileDataJson = json_encode($this->modifiedData);

            $UploadedData = new UploadedData();
            $UploadedData->file_name = 'FILE-'.time();
            $UploadedData->file_data = $fileDataJson;
            $UploadedData->created_by = auth()->user()->id;
            $UploadedData->organization_id = auth()->user()->organization_id;
            $UploadedData->organization_batch_id = $organizationBatch->id;
            $UploadedData->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Error saving uploaded data. Please try again later. '.$e->getMessage());

            return;
        }

        session()->flash('success', 'File uploaded successfully!');

        return redirect()->route('approval');
    }

    public function cancel()
    {
        return redirect()->route('file-upload');
    }
}
