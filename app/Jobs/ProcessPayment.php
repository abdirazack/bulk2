<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
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
                // Check if the keys match the expected headers
                if ($data[0] === 'name' && $data[1] === 'account_provider' && $data[2] === 'account_number' && $data[3] === 'amount') {
                    continue; // Skip the header row
                }

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
                $data = $this->updatedWallet($this->organization_id, $amount);


                // Call payment service or API based on account provider
                //$this->processPaymentByProvider($account_provider, $organizationPayment);

                // Log the successful payment
                Log::info("Processed payment for account provider: $account_provider, Payment ID: {$organizationPayment->id}");
            } catch (Exception $e) {
                // Log the error
                Log::error('Error processing payment: ' . $e->getMessage());
                // Optionally, handle the error (e.g., send notification)
            }
        }
    }

    /**
     * Process payment by provider.
     */
    protected function processPaymentByProvider(string $account_provider, OrganizationPayment $organizationPayment)
    {
        switch ($account_provider) {
            case 'hormuud':
                $this->HormuudPayment($organizationPayment);
                break;
            case 'somnet':
                $this->SomnetPayment($organizationPayment);
                break;
            default:
                Log::warning("Unknown account provider: $account_provider");
                break;
        }
    }

    protected function updatedWallet($organization_id, $amount)
    {
        $wallet = OrganizationWallet::where('organization_id', $organization_id)->first();
        $wallet->balance -= $amount;
        $wallet->save();
    }

    // Stub methods for payment processing - should be replaced with actual implementations
    protected function HormuudPayment(OrganizationPayment $organizationPayment)
    {

        //hit api here

        // Implement Hormuud payment logic here
    }

    protected function SomnetPayment(OrganizationPayment $organizationPayment)
    {
        // Implement Somnet payment logic here
    }
}
