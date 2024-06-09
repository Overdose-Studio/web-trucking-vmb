<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TruckSeeder;

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
        \App\Models\User::factory(20)->create();
        \App\Models\Client::factory(10)->create();

        // Seeders
        $this->call([
            TruckSeeder::class,
        ]);
    }
}
