<?php

namespace App\Tenants\Observers;

use App\Tenants\TenantManagement;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $tenantId = app(TenantManagement::class)->getTenantIdentifier();

        $model->tenant_id = $tenantId;
    }
}
