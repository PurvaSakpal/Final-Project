<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'email' => 'sakpalpurva1@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 1,
            'role_id' => 1
        ]);
    }
}
