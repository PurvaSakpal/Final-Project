<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            ['role_name' => 'SUPERADMIN'],
            ['role_name' => 'ADMIN'],
            ['role_name' => 'INVENTORY MANAGER'],
            ['role_name' => 'ORDER MANAGER'],
            ['role_name' => 'CUSTOMER']
        ];

        Role::insert($roles);
    }
}
