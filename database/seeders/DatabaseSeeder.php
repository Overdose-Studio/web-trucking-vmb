<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Get users with email `admin@example.com`
        $admin = User::where('email', 'admin@example.com')->first();

        // If there has admin user, then exit
        if ($admin) {
            return;
        }

        // Factories
        User::factory(20)->create();
        Client::factory(10)->create();

        // Seeders
        $this->call([
            TruckSeeder::class,
            UserSeeder::class,
        ]);
    }
}
