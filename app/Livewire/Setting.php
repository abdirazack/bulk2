<?php

namespace App\Livewire;

use Log;
use Livewire\Component;
use Illuminate\Support\Facades\Schema;
use App\Models\OrganizationUser;

class Setting extends Component
{
    public $theme;
    public function render()
    {
        return view('livewire.setting');
    }

    public function toggleTheme()
{
    // Check if the 'theme' column exists in the 'organization_users' table
    if (Schema::hasColumn('organization_users', 'theme')) {
        // Update the 'theme' attribute of the authenticated user
       $user = OrganizationUser::where('id', auth()->id())->first();
       $user->theme = $this->theme;
         $user->save();

        // Update the theme in the session
        session(['theme' => $this->theme]);
    } else {
        // Log a message or handle the case where the 'theme' column doesn't exist
        // You can log an error message or perform any other action based on your requirements
        Log::error('The theme column does not exist in the organization_users table.');
    }

    // Redirect the user back to the previous page
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
