<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            'Division 1',
            'Division 2',
        ];

        foreach ($divisions as $division) {
            // Turn off event listeners for seeder
            Division::withoutEvents(function() use ($division) {
                Division::factory()->create(['name' => $division]);
            });
        }
    }
}
