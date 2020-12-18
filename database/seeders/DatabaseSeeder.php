<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DivisionSeeder::class);
//        $this->call(F1NumberSeeder::class);
        $this->call(F1TeamSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TrackSeeder::class);
        $this->call(RaceSeeder::class);
    }
}
