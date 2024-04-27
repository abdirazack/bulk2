<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'organization_user';

    
   protected $guarded =['id'];


    // Define the relationship with the Organization model
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
