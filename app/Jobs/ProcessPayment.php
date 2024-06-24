<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Jobs\HandleTransaction;
use App\Models\OrganizationWallet;
use App\Models\OrganizationPayment;
use function Livewire\Volt\updated;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPayment implements ShouldQueue
{ 
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $modifiedData;

    protected $organization_id;

    protected $organization_batch_id;

    protected $organization_user_id;

    /**
     * Create a new job instance.
     */
    public function __construct(array $modifiedData, int $organizationId, int $batchId, $organization_user_id)
    {
        $this->modifiedData = $modifiedData;
        $this->organization_id = $organizationId;
        $this->organization_batch_id = $batchId;
        $this->organization_user_id = $organization_user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->modifiedData as $data) {
            try {
               
                // Access the data using the correct keys
                [$name, $account_provider, $account_number, $amount, $recurring, $payment_date] = $data;

                // Create a new OrganizationPayment instance
                $organizationPayment = new OrganizationPayment([
                    'organization_id' => $this->organization_id,
                    'organization_batch_id' => $this->organization_batch_id,
                    'organization_user_id' => $this->organization_user_id,
                    'account_provider' => $account_provider,
                    'account_name' => $name,
                    'account_number' => $account_number,
                    'amount' => $amount,
                    'payment_date' => $payment_date,
                    'status' => 'pending',
                    'is_recurring' => $recurring,
                ]);

                // Save the organization payment
                $organizationPayment->save();

                //dispatch HandleTransaction job
                HandleTransaction::dispatch($organizationPayment);
               
                Log::info("Processed payment for account provider: $account_provider, Payment ID: {$organizationPayment->id}");
            } catch (Exception $e) {
                // Log the error
                Log::error('Error processing payment: ' . $e->getMessage());
                // Optionally, handle the error (e.g., send notification)
            }
        }
    }

    
}
