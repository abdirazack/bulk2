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

    // clear cache
    public function clearCache()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
        return redirect(request()->header('Referer'));
    }
}
