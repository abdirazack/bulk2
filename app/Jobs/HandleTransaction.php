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

class HandleTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $organizationPayment;

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
        $organization_id = $this->organizationPayment->organization_id;
        $amount = $this->organizationPayment->amount;
        $account_number = $this->organizationPayment->account_number;
        $account_provider = $this->organizationPayment->account_provider;

        switch ($account_provider) {
            case 'premier_bank':
                $data = $this->premier_bank_gateway($this->organizationPayment);
                if ($data) {
                    $this->create_processed_payments($this->organizationPayment);
                    $this->update_organization_wallet($organization_id, $amount);
                    $this->change_organization_payment_status($this->organizationPayment);
                }
                break;

            default:
                throw new Exception('Invalid account provider');
        }
    }

    public function create_processed_payments(OrganizationPayment $organizationPayment): void
    {
        //create processed payments record
        try {
            DB::beginTransaction();
            $processed_payment = new ProcessedPayment();
            $processed_payment->organization_id = $organizationPayment->organization_id;
            $processed_payment->organization_payment_id = $organizationPayment->organization_payment_id;
            $processed_payment->amount = $this->organizationPayment->amount;
            $processed_payment->account_number = $this->organizationPayment->account_number;
            $processed_payment->account_provider = $this->organizationPayment->account_provider;
            $processed_payment->status = 'success';
            $processed_payment->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update_organization_wallet(int $organization_id, int $amount): void
    {
        //update organization wallet
        $organization = Organization::find($organization_id);
        if ($organization === null) {
            throw new Exception('Organization not found');
        }

        $org_wallet = $organization->wallet;
        $org_wallet->amount = $org_wallet->amount - $amount;
        $org_wallet->save();
    }

    public function change_organization_payment_status(OrganizationPayment $organizationPayment): void
    {
        //change organization payment status
        $organizationPayment = $this->organizationPayment;
        $organizationPayment->status = 'success';
        $organizationPayment->save();
    }

    public function premier_bank_gateway(OrganizationPayment $organizationPayment): bool
    {
        //premier bank gateway
        return true;
    }
}
