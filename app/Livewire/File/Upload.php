<?php

namespace App\Livewire\File;

use Livewire\Component;
use Livewire\WithFileUploads;


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


}
