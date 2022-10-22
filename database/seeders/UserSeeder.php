<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('secret'),
                'role' => User::ROLE_ADMIN
            ],
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'password' => Hash::make('secret'),
                'role' => User::ROLE_USER
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
