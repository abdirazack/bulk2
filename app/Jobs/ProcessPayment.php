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
    protected $payment_date ;
    protected $orgranization_batch_id;


    /**
     * Create a new job instance.
     */
    public function __construct(array $modifiedData, int $organizationId, int $batchId)
    {
        $this->modifiedData = $modifiedData;
        $this->organization_id = $organizationId;
        $this->orgranization_batch_id = $batchId;
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
                'organization_batch_id' => $this->orgranization_batch_id,
                'account_provider' => $data[1],
                'account_name' => $data[0],
                'account_number' => $account_number,
                'amount' => $data[3],
                'payment_date' => $data[5],
                'status' => 'pending',
                'is_recurring' => $data[4]
            ]);
            $organizationPayment->save();
            // everytime the payment is saved, we should trigger an event to increase the progress bar in upload component 
             $this->dispatch('percentageProgress');
        }



    }
}
