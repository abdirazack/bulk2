<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationWallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organization_wallet';

    protected $fillable = [
        'organization_id',
        'balance',
    ];
    protected $guarded =['id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
