<?php

namespace App\Livewire\File;

use Livewire\Component;

class Preview extends Component
{
    public $fileData = [];

    public $recurring;

    public $paymentDate;

    public $modifiedData = [];

    public function mount($fileData)
    {
        $this->fileData = json_decode($fileData, true);
        // dd($this->fileData);    
    }
  

    public function render()
    {
        return view('livewire.file.preview'
        , [
            'fileData' => $this->fileData
        ]);
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
        dd($this->modifiedData);

        return redirect()->route('file.save', ['modifiedData' => json_encode($this->modifiedData)]);
    }

    public function cancel()
    {
        return redirect()->route('file-upload');
    }


}
