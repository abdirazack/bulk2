<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
