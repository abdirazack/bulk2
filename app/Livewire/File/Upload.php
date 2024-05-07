<?php

namespace App\Livewire\File;

use Livewire\Component;
use Livewire\WithFileUploads;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Livewire\Attributes\On; 


class Upload extends Component
{
    use WithFileUploads;

    public $ProgressValue = -2;  
    public $file;
    public $hasHeaders;

    


    public $fileData=0;

    #[on('percentageProgress')]
    public function render()
    {
        return view('livewire.file.upload');
    }


    public function save()
    {
        $this->validate([
            'file' => 'required',
        ]);
        
        $fileData = [];
        $reader = ReaderEntityFactory::createReaderFromFile($this->file->getRealPath());
    
        try {
            $reader->open($this->file->getRealPath());
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
        } catch (\Exception $e) {
            $reader->close();
            session()->flash('error', 'Error Looping through file.' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    
        $this->fileData = $fileData;
        $encodedHasHeaders = base64_encode(json_encode($this->hasHeaders));
        session()->put('fileData', json_encode($this->fileData));
        session()->flash('success', 'File uploaded successfully. Now make your changes.');
    
        return redirect()->route('file.preview', [
            'hasHeaders' => $encodedHasHeaders
        ]);
    }
    
}
