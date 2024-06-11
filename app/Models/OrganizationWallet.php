<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationWallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organization_wallets';

    protected $fillable = [
        'organization_id',
        'balance',
    ];

    protected $guarded = ['id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
