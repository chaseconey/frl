<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class F1NumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numbers = [
            2,
            7,
            8,
            13,
            15,
            19,
            21,
            23,
            25,
            26,
            28,
            29,
            30,
            32,
            34,
            35,
            36,
            37,
            38,
            39,
            40,
            41,
            42,
            43,
            45,
            46,
            48,
            49,
            50,
            51,
            52,
            53,
            54,
            56,
            57,
            58,
            59,
            60,
            61,
            62,
            64,
            65,
            66,
            67,
            68,
            69,
            70,
            71,
            72,
            73,
            74,
            75,
            78,
            79,
            80,
            81,
            82,
            83,
            84,
            85,
            86,
            87,
            88,
            89,
            90,
            91,
            92,
            93,
            94,
            95,
            96,
            97,
            98,
            99,
        ];

        foreach ($numbers as $number) {
            \App\Models\F1Number::factory()->create(['racing_number' => $number]);
        }
    }
}
