<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\OrganizationPayment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $modifiedData;
    protected $organization_id;
    protected $payment_date;
    protected $organization_batch_id;


    /**
     * Create a new job instance.
     */
    public function __construct(array $modifiedData, int $organizationId, int $batchId)
    {
        $this->modifiedData = $modifiedData;
        $this->organization_id = $organizationId;
        $this->organization_batch_id = $batchId;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->modifiedData as $data) {
            // Check if the keys match the expected headers
            $hasExpectedHeaders = $data[0] === 'name' && $data[1] === 'account_provider' && $data[2] === 'account_number' && $data[3] === 'amount';

            // If the keys match, skip the header row and continue to process the data
            if ($hasExpectedHeaders) {
                continue; // Skip the header row
            }

            // Access the data using the correct keys
            $name = $data[0];
            $account_provider = $data[1];
            $account_number = $data[2];
            $amount = $data[3];
            $recurring = $data[4];
            $payment_date = $data[5];

            // Create a new OrganizationPayment instance
            $organizationPayment = new OrganizationPayment([
                'organization_id' => $this->organization_id,
                'organization_batch_id' => $this->organization_batch_id,
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


            // Track the successful payment

        }
    }
}
