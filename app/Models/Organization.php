<?php

namespace App\Models;

use App\Models\OrganizationUser;
use App\Models\OrganizationWallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'organizations';

    
   protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    public function wallet()
    {
        return $this->hasOne(OrganizationWallet::class);
    }
}
