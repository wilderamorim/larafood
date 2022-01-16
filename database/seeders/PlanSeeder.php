<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name'  => 'Básico',
                'price' => '0.00',
            ],
            [
                'name'  => 'Padrão',
                'price' => '199.99',
            ],
            [
                'name'  => 'Premium',
                'price' => '499.99',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
