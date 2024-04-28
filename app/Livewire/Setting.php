<?php

namespace App\Livewire;

use Livewire\Component;

class Setting extends Component
{
    public $theme;
    public function render()
    {
        return view('livewire.setting');
    }

    public function toggleTheme()
    {
       session(['theme' => $this->theme]);

        // re render the app
        return redirect(request()->header('Referer'));
    }
}
