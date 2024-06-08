<?php

namespace App\Livewire\Anylitics;

use Livewire\Component;
use App\Models\OrganizationPayment;
use Illuminate\Support\Carbon;
class details extends Component
{
public $details ;

    public function render()
    {
        $this->details = $this->details();
        return view('livewire.Analytics.details', ['details' => $this->details]);
    }
    
    public function details(){
        return $this->details = OrganizationPayment::where('is_recurring', 1)
        ->where('payment_date', '>=', Carbon::now())
        ->orderBy('payment_date', 'asc')
        ->take(10)
        ->get();
        
    }

}