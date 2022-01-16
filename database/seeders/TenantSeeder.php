<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::orderBy('price', 'DESC')->first();

        $plan->tenants()->create([
            'name'      => 'Uebi',
            'email'     => 'agencia@uebi.com.br',
            'document'  => '24936410000107',
        ]);
    }
}
