<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
            ],
            [
                'name' => 'Vendor',
                'email' => 'vendor@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Buyer',
                'email' => 'buyer@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => 3,
            ],
        ];

        User::insert($users);
    }
}
