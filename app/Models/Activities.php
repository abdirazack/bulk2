<?php

namespace App\Models;

use App\Models\OrganizationUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activities extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_user_id',
        'action',
        'description'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
