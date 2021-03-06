<?php

namespace App\Observers;

use App\Models\Tenant;
use Illuminate\Support\Str;

class TenantObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param Tenant $tenant
     * @return void
     */
    public function creating(Tenant $tenant)
    {
        $tenant->uuid = Str::uuid();
        $tenant->slug = Str::slug($tenant->name);
    }

    /**
     * Handle the Tenant "updating" event.
     *
     * @param Tenant $tenant
     * @return void
     */
    public function updating(Tenant $tenant)
    {
        $tenant->slug = Str::slug($tenant->name);
    }
}
