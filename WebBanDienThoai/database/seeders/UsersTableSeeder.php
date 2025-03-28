<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('roleName', 'Admin')->first();
        User::create([
            'userName' => 'admin',
            'email' => 'admin@gmail.com',
            'phoneNumber' => '0999999999',
            'password' => Hash::make('admin@gmail.com'),
            'roleId' => $role->roleId,
        ]);
    }
}
