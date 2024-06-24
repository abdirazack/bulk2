<?php

namespace App\Jobs;

use App\Models\OrganizationPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckForTransactionToHandle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Go throught organization payments and check if there are any transactions to handle today
        $organizationPayments = OrganizationPayment::whereRaw('MONTH(payment_date) = ? AND DAY(payment_date) = ?', [now()->month, now()->day])
            ->get();
        foreach ($organizationPayments as $organizationPayment) {
            if ($organizationPayment->status == 'pending') {
                HandleTransaction::dispatch($organizationPayment);
                // Log the transaction
                Log::info('Transaction handled', ['organization_payment_id' => $organizationPayment->id]);
            }

            if (($organizationPayment->status == 'success') && ($organizationPayment->is_recurring == true)) {
                HandleTransaction::dispatch($organizationPayment);
                // Log the transaction
                Log::info('Transaction handled', ['organization_payment_id' => $organizationPayment->id]);
            }
        }
        // If there are, dispatch a new job to handle the transaction

    }
}
