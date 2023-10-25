<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Create a user record for the tenant
        $user = User::create([
            'role_id' => 1,
            'first_name' => 'Royan',
            'last_name' => 'Harsha',
            'email' => 'royanharsha6@gmail.com',
            'password' => bcrypt('123456'),
            'credit_points' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->assignRole('super admin');
    }
}
