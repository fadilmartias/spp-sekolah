<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);
        $user = User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "username" => "admin",
            "status" => 1,
            "phone" => "081234567890",
            "password" => bcrypt("namakau123"),
        ]);
        $user->assignRole($role_admin);
        $user = User::create([
            "name" => "User",
            "email" => "user@gmail.com",
            "username" => "user",
            "status" => 1,
            "phone" => "081234567890",
            "password" => bcrypt("namakau123"),
        ]);
        $user->assignRole($role_user);
    }
}
