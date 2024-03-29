<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add driver for every number so we can upload files at will and number lookup will work
        Driver::withoutEvents(function () {
            for ($x = 1; $x <= 74; $x++) {
                Driver::factory()->create([
                    'f1_number_id' => $x,
                    'type' => 'RESERVE',
                ]);
            }
        });
    }
}
