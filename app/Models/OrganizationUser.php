<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrganizationUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'organization_users';
    
   protected $fillable = [
    'organization_id',
    'email',
    'username',
    'password',
];

protected $hidden = [
    'password',
];

protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

public function roles(): BelongsToMany
{
    return $this->belongsToMany(Role::class);
}


public function hasRole(string $role): bool
{
    return $this->roles->contains('name', $role);
}

public function hasPermission(string $permission): bool
{
    return $this->permissions->contains('name', $permission);
}

public function assignRole(string $role): void
{
    $this->roles()->attach(Role::where('name', $role)->first());
}


public function removeRole(string $role): void
{
    $this->roles()->detach(Role::where('name', $role)->first());
}


// organization has many users
public function organization() : BelongsTo
{
    return $this->belongsTo(Organization::class);
}
}
