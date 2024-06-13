<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'organization_batch_id',
        'organization_user_id',
        'account_provider',
        'account_name',
        'account_number',
        'amount',
        'payment_date',
        'status',
        'is_recurring',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizationBatch()
    {
        return $this->belongsTo(OrganizationBatch::class);
    }

    public function user()
    {
        return $this->belongsTo(OrganizationUser::class, 'organization_user_id');
    }

    public function getAmountAttribute($value)
    {
        return number_format($value, 2);
    }

    // cast the is_recurring attribute to boolean
    protected $casts = [
        'is_recurring' => 'boolean',
        'payment_date' => 'date',
    ];
}
