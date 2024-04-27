<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TemStorage;
use Livewire\WithFileUploads;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $hasHeaders;

    public $modifiedData = [];


    public $fileData;


    public function render()
    {
        return view('livewire.file-upload');
    }

    public function save()
    {
        $this->validate([
            'file' => 'required',
        ]);
        
        $reader = ReaderEntityFactory::createReaderFromFile($this->file->getRealPath());
        $reader->open($this->file->getRealPath());
    
        $fileData = [];
    
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // Extract cell values from the row and convert them to strings
                $cellValues = array_map('strval', $row->toArray());
                $fileData[] = $cellValues;
            }
        }
    
        $reader->close();
    
        $this->fileData = $fileData;

        $this->modifiedData = $fileData;
        $this->fileData = [];
    }

    
    public function saveModifiedData()
    {
        // dd($this->modifiedData);
        foreach ($this->modifiedData as $key => $value) {
            if ($key == 0 && $this->hasHeaders) {
                continue;
            }
            $tempStorage = new TemStorage();
            $tempStorage->name = $value[0];
            $tempStorage->account_provider = $value[1];
            $tempStorage->account_number = $value[2];
            $tempStorage->amount = $value[3];
            $tempStorage->save();
        }

        $this->modifiedData = [];
        $this->fileData = [];

        session()->flash('message', 'Data saved successfully.');


        
    }
}
