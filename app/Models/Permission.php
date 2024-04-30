<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'org_permissions';


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'org_role_permission', 'org_permission_id', 'org_role_id');
    }
   
}
