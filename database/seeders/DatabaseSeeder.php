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
