<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedData extends Model
{
    use HasFactory;

    protected $table = 'uploaded_data';

    protected $fillable = [
        'file_name',
        'file_data',
        'organization_id',
        'created_by',
        'organization_batch_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizationBatch()
    {
        return $this->belongsTo(OrganizationBatch::class);
    }

    public function user()
    {
        return $this->belongsTo(OrganizationUser::class, 'created_by');
    }
}
