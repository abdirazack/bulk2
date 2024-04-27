<?php

use App\Models\User;
use App\Livewire\User\UserList;

use App\Livewire\FileUpload;
use Illuminate\Support\Facades\Route;
use App\Livewire\Role\View as RoleView;
use App\Livewire\Role\Index as RoleIndex;
use App\Livewire\Organization\OrganizationUser;


Route::view('/', 'welcome');

Route::get('dashboard', function () {
    return view('dashboard', ['users' => User::all()]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/organization-user/{id?}', OrganizationUser::class)
    ->name('organization-user')
    ->middleware('auth');
Route::get('/view-role/{id?}', RoleView::class)
    ->name('view-role')
    ->middleware('auth');

Route::get('/users', UserList::class)->name('users')->middleware('auth');
Route::get('/roles', RoleIndex::class)->name('roles')->middleware('auth');


Route::get('/file-upload', FileUpload::class)->name('file-upload')->middleware('auth');  

require __DIR__.'/auth.php';
