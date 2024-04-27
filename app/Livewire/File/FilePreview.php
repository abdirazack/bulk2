<?php

namespace App\Livewire\File;

use Livewire\Component;
use App\Models\TemStorage;

class FilePreview extends Component
{

    public $file;

    public function mount()
    {
        $this->file = TemStorage::all();
    }
    public function render()
    {
        return view('livewire.file.file-preview');
    }
}
