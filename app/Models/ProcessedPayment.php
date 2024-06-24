<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\OrganizationPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessedPayment extends Model
{
    use HasFactory;
    protected $table = 'processed_payments';
    protected $fillable = [
        'organization_id',
        'organization_payment_id',
        'account_provider',
        'account_number',
        'amount',
        'status',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizationPayment()
    {
        return $this->belongsTo(OrganizationPayment::class);
    }
}
