<?php

namespace App\Http\Controllers;

use App\Livewire\Organization\OrganizationUser;


class DashboardController extends Controller
{


    public function index()
    {
        $usersInfo = OrganizationUser::where('organization_id', auth()->user()->organization_id)->get();
        dd($usersInfo);
        return view('dashboard');
    }
}
