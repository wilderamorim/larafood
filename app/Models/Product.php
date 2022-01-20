<?php

namespace App\Models;

use App\Tenants\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use TenantTrait;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
