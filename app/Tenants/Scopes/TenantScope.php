<?php

namespace App\Tenants\Scopes;

use App\Tenants\TenantManagement;
use Illuminate\Database\Eloquent\{Builder, Model, Scope};

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $tenantId = app(TenantManagement::class)->getTenantIdentifier();
        $builder->where('tenant_id', $tenantId);
    }
}
