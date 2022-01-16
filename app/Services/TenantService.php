<?php

namespace App\Services;

use App\Models\{Plan, User};
use Illuminate\Support\Facades\Hash;

class TenantService
{
    /** @var Plan */
    private $plan;

    /** @var array */
    private $data;

    public function __construct(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
    }

    public function make(): User
    {
        return $this->storeUser($this->storeTenant());
    }

    private function storeTenant()
    {
        return $this->plan->tenants()->create([
            'name'          => $this->data['company_name'],
            'email'         => $this->data['email'],
            'document'      => $this->data['document'],

            //subscription
            'subscription'  => now(),
            'expires_at'    => now()->addDays(7),
        ]);
    }

    private function storeUser($tenant)
    {
        return $tenant->users()->create([
            'name'      => $this->data['name'],
            'email'     => $this->data['email'],
            'password'  => Hash::make($this->data['password']),
        ]);
    }
}
