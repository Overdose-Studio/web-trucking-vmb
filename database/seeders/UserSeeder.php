<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Set Data Environment
        $roles = ['trucking', 'finance', 'admin', 'operation'];
        $password = 'password';

        // Loop through the roles
        foreach ($roles as $role) {
            // Create User
            $user = new User();
            $user->name = fake()->name();
            $user->email = $role . '@example.com';
            $user->role = $role;
            $user->password = Hash::make($password);
            $user->remember_token = Str::random(10);

            // Save User
            $user->save();
        }
    }
}
