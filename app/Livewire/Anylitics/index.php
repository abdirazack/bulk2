<?php

namespace App\Livewire\Anylitics;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\OrganizationUser;
use App\Models\OrganizationBatch;
use App\Models\OrganizationWallet;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationPayment;

class index extends Component
{

    public $batches = [
        'approve' => 0,
        'reject' => 0,
        'pending' => 0,
        'approveAmount' => 0,
        'pendingAmount' => 0,
    ];

    public $walletBalance;

    public $totalSuccessPayments;

    public $totalPendingPayments;

    public $totalRejectedPayments;

    public $totalActiveUsers;

    public $totalSuspendedUsers;

    public $recentTransactions;

    public $recurringTransactionsCount;

    public $recurringTotalAmount;

    public $closestDueRecurringPayments;

    public $recentTransactionsCount;

    public $topAccountProviders;

    public function mount()
    {
        
        // Wallet Information
        $wallet = OrganizationWallet::where('organization_id', auth()->user()->organization_id)->first();
        // dd( $wallet  );
        if ($wallet) {
            $this->walletBalance = $wallet->balance;
        } else {
            $this->walletBalance = 0;
        }

        // Batches Information
        $this->batches['approve'] = OrganizationBatch::where('status', 'approved')->count();
        $this->batches['reject'] = OrganizationBatch::where('status', 'rejected')->count();
        $this->batches['pending'] = OrganizationBatch::where('status', 'pending')->count();
        $this->batches['approveAmount'] = OrganizationBatch::where('status', 'approved')->sum('total_amount');
        $this->batches['pendingAmount'] = OrganizationBatch::where('status', 'pending')->sum('total_amount');

        // Payment Information
        $this->totalSuccessPayments = OrganizationPayment::where('status', 'success')->sum('amount');
        $this->totalPendingPayments = OrganizationPayment::where('status', 'pending')->sum('amount');
        $this->totalRejectedPayments = OrganizationPayment::where('status', 'rejected')->sum('amount');

        // // Users Information
        // $this->totalActiveUsers = OrganizationUser::where('status', 'active')->count();
        // $this->totalSuspendedUsers = OrganizationUser::where('status', 'suspended')->count();

        // Recent Transactions
        $this->recentTransactions = OrganizationPayment::orderBy('payment_date', 'desc')->take(10)->get();
        // Recurring Transactions
        $this->recurringTransactionsCount = OrganizationPayment::where('is_recurring', 1)->count();
        $this->recurringTotalAmount = OrganizationPayment::where('is_recurring', 1)->sum('amount');
        $this->closestDueRecurringPayments = OrganizationPayment::where('is_recurring', 1)
            ->where('payment_date', '>=', Carbon::now())
            ->orderBy('payment_date', 'asc')
            ->take(1)
            ->get();

        $this->topAccountProviders = OrganizationPayment::select('account_provider', DB::raw('count(*) as count'))
            ->groupBy('account_provider')
            ->orderBy('count', 'desc')
            ->take(3)
            ->get();

    }

    public function render()
    {
        return view('livewire.Analytics.index', ['totalUsers' => OrganizationUser::count()]);
    }

    public function viewDetails()
    {
        return redirect()->route('analytics-details');
    }
}
