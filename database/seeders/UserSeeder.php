<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $permission = Permission::firstOrCreate(['name' => 'access-admin']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->permissions()->syncWithoutDetaching([$permission->id]);

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $index => $userData) {
            $user = User::firstOrCreate(['email' => $userData['email']], $userData);

            if ($index === 0) {
                $user->roles()->syncWithoutDetaching([$adminRole->id]);
            }
        }
    }
}
