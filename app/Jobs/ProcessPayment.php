<?php

namespace App\Jobs;

use App\Models\OrganizationPayment;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $modifiedData;
    protected $organizationId;
    protected $batchId;
    protected $organizationUserId;

    /**
     * Create a new job instance.
     */
    public function __construct(array $modifiedData, int $organizationId, int $batchId, int $organizationUserId)
    {
        $this->modifiedData = $modifiedData;
        $this->organizationId = $organizationId;
        $this->batchId = $batchId;
        $this->organizationUserId = $organizationUserId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->modifiedData as $data) {
            // Access the data using the correct keys
            [$name, $accountProvider, $accountNumber, $amount, $recurring, $paymentDate] = $data;
            try {
                $organizationPayment = $this->createOrganizationPayment([
                    'name' => $name,
                    'account_provider' => $accountProvider,
                    'account_number' => $accountNumber,
                    'amount' => $amount,
                    'recurring' => $recurring,
                    'payment_date' => $paymentDate,
                ]);

                // If the payment date is today, dispatch HandleTransaction job
                if ($organizationPayment->payment_date == now()->toDateString()) {
                    HandleTransaction::dispatch($organizationPayment);
                }

                Log::info("Processed payment for account provider: $accountProvider, Payment ID: {$organizationPayment->id}");
            } catch (Exception $e) {
                // Log the error
                Log::error('Error processing payment: '.$e->getMessage());
                throw new Exception('Error processing payment: '.$e->getMessage());
            }
        }
    }

    /**
     * Create an organization payment.
     *
     * @param array $data
     * @return OrganizationPayment
     * @throws Exception
     */
    protected function createOrganizationPayment(array $data): OrganizationPayment
    {
        try {
            DB::beginTransaction();
            $organizationPayment = OrganizationPayment::create([
                'organization_id' => $this->organizationId,
                'organization_batch_id' => $this->batchId,
                'organization_user_id' => $this->organizationUserId,
                'account_provider' => $data['account_provider'],
                'account_name' => $data['name'],
                'account_number' => $data['account_number'],
                'amount' => $data['amount'],
                'payment_date' => $data['payment_date'],
                'status' => 'pending',
                'is_recurring' => $data['recurring'],
            ]);
            DB::commit();

            return $organizationPayment;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating organization payment: '.$e->getMessage());
            throw new Exception('Error creating organization payment: '.$e->getMessage());
        }
    }
}
