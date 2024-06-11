<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationBatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'batch_number',
        'organization_user_id',
        'total_records',
        'total_amount',
        'status',
    ];

    public function organizationPayments()
    {
        return $this->hasMany(OrganizationPayment::class);
    }

    public function user()
    {
        return $this->belongsTo(OrganizationUser::class, 'organization_user_id');
    }
}
