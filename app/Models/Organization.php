<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
