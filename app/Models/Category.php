<?php

namespace App\Models;

use App\Tenants\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    use TenantTrait;

    protected $fillable = [
        'tenant_id',
        'name',
        'slug',
        'description',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
