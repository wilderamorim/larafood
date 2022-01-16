<?php

namespace Database\Seeders;

use App\Models\{Tenant, User};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name'      => 'Wilder',
            'email'     => 'wilderamorim@msn.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
