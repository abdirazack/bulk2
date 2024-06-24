<?php

namespace App\Jobs;

use App\Models\Organization;
use App\Models\OrganizationPayment;
use App\Models\ProcessedPayment;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HandleTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $organizationPayment;

    /**
     * Create a new job instance.
     */
    public function __construct(OrganizationPayment $organizationPayment)
    {
        $this->organizationPayment = $organizationPayment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            switch ($this->organizationPayment->account_provider) {
                case 'premier_bank':
                    $data = $this->premierBankGateway();
                    if ($data) {
                        DB::transaction(function () {
                            $this->createProcessedPayment();
                            $this->updateOrganizationWallet();
                            $this->changeOrganizationPaymentStatus();
                        });
                    }
                    break;

                default:
                    throw new Exception('Invalid account provider');
            }
        } catch (Exception $e) {
            Log::error('Transaction handling failed', ['exception' => $e]);
            throw $e; // Re-throw the exception to let the queue handle retries
        }
    }

    protected function createProcessedPayment(): void
    {
        ProcessedPayment::create([
            'organization_id' => $this->organizationPayment->organization_id,
            'organization_payment_id' => $this->organizationPayment->id,
            'amount' => $this->organizationPayment->amount,
            'account_number' => $this->organizationPayment->account_number,
            'account_provider' => $this->organizationPayment->account_provider,
            'status' => 'success',
        ]);
    }

    protected function updateOrganizationWallet(): void
    {
        $organization = Organization::findOrFail($this->organizationPayment->organization_id);
        $organization->wallet->decrement('amount', $this->organizationPayment->amount);
    }

    protected function changeOrganizationPaymentStatus(): void
    {
        $this->organizationPayment->update(['status' => 'success']);
    }

    protected function premierBankGateway(): bool
    {
        // Simulate Premier Bank gateway logic
        return true;
    }
}
