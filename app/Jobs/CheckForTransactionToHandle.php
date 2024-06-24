<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Models\OrganizationPayment;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        // Get today's date components
        $month = now()->month;
        $day = now()->day;

        // Fetch organization payments due today
        $organizationPayments = OrganizationPayment::whereRaw('MONTH(payment_date) = ? AND DAY(payment_date) = ?', [$month, $day])
            ->get();

        // Process each payment
        foreach ($organizationPayments as $organizationPayment) {
            $this->processPayment($organizationPayment);
        }
    }

    /**
     * Process an organization payment.
     *
     * @param OrganizationPayment $organizationPayment
     */
    protected function processPayment(OrganizationPayment $organizationPayment): void
    {
        try {
            if ($organizationPayment->status === 'pending' || ($organizationPayment->status === 'success' && $organizationPayment->is_recurring)) {
                HandleTransaction::dispatch($organizationPayment);
                Log::info('Transaction handled', ['organization_payment_id' => $organizationPayment->id]);
            }
        } catch (Exception $e) {
            Log::error('Error handling transaction', ['organization_payment_id' => $organizationPayment->id, 'error' => $e->getMessage()]);
        }
    }
}
