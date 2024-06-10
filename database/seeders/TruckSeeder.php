<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data
        $qty = 10;
        $brand = ['Mercedes', 'Volvo', 'Scania'];
        $production_year = [2015, 2016, 2017, 2018, 2019, 2020, 2021];
        $last_maintenance = ['2024-01-01', '2024-02-01', '2024-03-01', '2024-04-01', '2024-05-01', '2024-06-01', '2024-07-01', '2024-08-01', '2024-09-01', '2024-10-01', '2024-11-01', '2024-12-01'];

        // Seed
        for ($i = 0; $i < $qty; $i++) {
            // Create Truck
            $truck = new \App\Models\Truck();
            $truck->license_plate = fake()->regexify('[A-Z]{2}[0-9]{4}[A-Z]{2}');
            $truck->brand = $brand[array_rand($brand)];
            $truck->production_year = $production_year[array_rand($production_year)];
            $truck->last_maintenance = $last_maintenance[array_rand($last_maintenance)];

            // Create State
            $state = new \App\Models\State();
            $state->type = 'good';
            $state->evidence = null;
            $state->save();

            // Associate State
            $truck->state_id = $state->id;

            // Save Truck
            $truck->save();
        }
    }
}
