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
        \App\Models\User::factory(10)->create();
        $this->call(F1NumberSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(F1TeamSeeder::class);
        $this->call(TrackSeeder::class);
    }
}
