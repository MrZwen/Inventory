<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::inRandomOrder()->first()->id;
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role_id' => $roles
            ],
            [
                'name' => 'Staff',
                'username' => 'staff',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('staff'),
                'role_id' => $roles
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
