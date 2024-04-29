<?php

namespace App\Livewire\File;

use Livewire\Component;
use Livewire\WithFileUploads;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Livewire\Attributes\On; 


class Upload extends Component
{
    use WithFileUploads;

    public $ProgressValue = -1;  
    public $file;
    public $hasHeaders;


    public $fileData;

    #[on('percentageProgress')]
    public function render()
    {
        $this->ProgressValue++;
        return view('livewire.file.upload'
        );
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
                //if has headers, skip the first row
                if ($this->hasHeaders) {
                    $this->hasHeaders = false;
                    continue;
                }
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
