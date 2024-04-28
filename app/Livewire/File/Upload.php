<?php

namespace App\Livewire\File;

use Livewire\Component;
use Livewire\WithFileUploads;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;



class Upload extends Component
{
    use WithFileUploads;

    public $file;
    public $hasHeaders;


    public $fileData;

    public function render()
    {
        return view('livewire.file.upload');
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

        $fileData = json_encode($fileData);
        
        return redirect()->route('file.preview', ['fileData' => $fileData]);
    }

}
