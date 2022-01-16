<?php

namespace App\Tenants;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantManagement
{
    public function getTenantIdentifier()
    {
        return Auth::user()->tenant_id;
    }

    public function getTenant(): Tenant
    {
        return Auth::user()->tenant;
    }

    public function isAdmin(): bool
    {
        return in_array(Auth::user()->email, config('tenant.admins'));
    }
}
