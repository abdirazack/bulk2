<?php

namespace App\Models;

use App\Models\OrganizationPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationBatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'batch_number',
        'total_records',
        'total_amount',
        'status'
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
