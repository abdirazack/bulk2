<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\OrganizationBatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'organization_batch_id',
        'account_provider',
        'account_name',
        'account_number',
        'amount',
        'payment_date',
        'status',
        'is_recurring'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizationBatch()
    {
        return $this->belongsTo(OrganizationBatch::class);
    } 
}