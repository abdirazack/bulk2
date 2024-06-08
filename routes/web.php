<?php

use App\Models\User;
use App\Livewire\Setting;
use App\Http\Livewire\Details;
use App\Livewire\User\UserList;
use App\Http\Livewire\ViewDetails;

use Illuminate\Support\Facades\Route;
use App\Livewire\Role\View as RoleView;
use App\Livewire\Role\Index as RoleIndex;
use App\Livewire\File\Upload as FileUpload;
use App\Livewire\OrganizationPayment\Index;
use App\Http\Controllers\DashboardController;
use App\Livewire\File\Preview as FilePreview;
use App\Livewire\Organization\OrganizationUser;
use App\Livewire\Approval\Index as ApprovalIndex;
use App\Livewire\Approval\Details as ApprovalDetails;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Livewire\OrganizationUser\Show as OrganizationUserShow;
use App\Livewire\OrganizationUser\View as OrganizationUserView;
use App\Livewire\OrganizationPayment\Index as OrganizationPayment;


Route::view('/', 'welcome');


Route::get('dashboard', function () {
    return view('dashboard', ['users' => User::all()]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::get('/organization-user/{id?}', OrganizationUser::class)
// ->name('organization-user')
// ->middleware('auth');


// Route::get('/users', UserList::class)->name('users')->middleware('auth');


// Route::get('/file-upload', FileUpload::class)->name('file-upload')->middleware('auth');  

//organization-user
Route::get('/organization-user', OrganizationUserShow::class)->name('organization-user')->middleware('auth');

//organization-user.view

Route::get('/organization-user/view/{user_id}', OrganizationUserView::class)->name('organization-user.view')->middleware('auth');

// file.preview

// OrganizationPayment

//settings
Route::get('/settings', Setting::class)->name('settings')->middleware('auth');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/file-upload', FileUpload::class)->name('file-upload')->middleware('auth');
    Route::get('/organization-payment', OrganizationPayment::class)->name('organization-payment')->middleware('auth');
    Route::get('file/preview', FilePreview::class)->name('file.preview')->middleware('auth');
    Route::get('/roles', RoleIndex::class)->name('roles')->middleware('auth');
    Route::get('/approval', ApprovalIndex::class)->name('approval')->middleware('auth');
    Route::get('/display-details/{id?}', ApprovalDetails::class)->name('details')->middleware('auth');


    Route::get('/view-role/{id?}', RoleView::class)
        ->name('view-role')
        ->middleware('auth');


});



require __DIR__ . '/auth.php';
