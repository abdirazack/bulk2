<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    #[On('theme-changed')]
    public function refresh()
    {
        $this->render();
    }

    public function render(): View
    {
        return view('layouts.app');
    }
}
