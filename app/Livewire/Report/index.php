<?php

namespace App\Livewire\Report;
use Livewire\Component;

class index extends Component
{

    public $start_date;
    public $end_date;
    public $filter;

    public function render()
    {
        return view('livewire.report.index');
    }

    public function generateReport()
    {
   dd($this->filter, $this->start_date, $this->end_date);

    }




    
}
