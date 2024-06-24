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
            // Access the data using the correct keys
            [$name, $account_provider, $account_number, $amount, $recurring, $payment_date] = $data;
            try {
                $organizationPayment = $this->create_organization_payment([
                    'name' => $name,
                    'account_provider' => $account_provider,
                    'account_number' => $account_number,
                    'amount' => $amount,
                    'recurring' => $recurring,
                    'payment_date' => $payment_date,
                ]);

                //if the payment_date is today dispatch HandleTransaction job
                if ($organizationPayment->payment_date == now()->toDateString()) {
                    HandleTransaction::dispatch($organizationPayment);
                }

                Log::info("Processed payment for account provider: $account_provider, Payment ID: {$organizationPayment->id}");
            } catch (Exception $e) {
                // Log the error
                Log::error('Error processing payment: '.$e->getMessage());
                throw new Exception('Error Processing Payment'.$e->getMessage());
            }
        }

    }

    public function create_organization_payment($data): OrganizationPayment
    {
        try {
            DB::beginTransaction();
            $organizationPayment = new OrganizationPayment([
                'organization_id' => $this->organization_id,
                'organization_batch_id' => $this->organization_batch_id,
                'organization_user_id' => $this->organization_user_id,
                'account_provider' => $data['account_provider'],
                'account_name' => $data['name'],
                'account_number' => $data['account_number'],
                'amount' => $data['amount'],
                'payment_date' => $data['payment_date'],
                'status' => 'pending',
                'is_recurring' => $data['recurring'],
            ]);
            $organizationPayment->save();
            DB::commit();

            return $organizationPayment;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
