<?php

namespace App\Tenants\Traits;

use App\Tenants\Observers\TenantObserver;
use App\Tenants\Scopes\TenantScope;

trait TenantTrait
{
    protected static function booted()
    {
        parent::booted();

        static::observe(TenantObserver::class);

        static::addGlobalScope(new TenantScope());
    }
}
