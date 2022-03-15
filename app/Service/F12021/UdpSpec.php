<?php


namespace App\Service\F12021;

class UdpSpec
{
    const TIRES_VISUAL = [
        16 => "S",
        17 => "M",
        18 => "H",
        7 => "I",
        8 => "W"
    ];


    const RACE_RESULT_STATUS = [
        0 => 'Invalid',
        1 => 'Inactive',
        2 => 'Active',
        3 => 'Finished',
        4 => 'DNF',
        5 => 'DSQ',
        6 => 'Not Classified',
        7 => 'Retired',
    ];

    /**
     * @param $status
     * @return bool
     */
    public static function isRaceResultStatusFinished($status): bool
    {
        return $status === 3;
    }

    /**
     * Maps a UDP tire stint to our string representation
     *
     * @param  array  $tires
     * @return string
     */
    public static function mapTireStint(array $tires): string
    {
        $stint = "";
        foreach ($tires as $tire) {
            if (array_key_exists($tire, self::TIRES_VISUAL)) {
                $stint .= self::TIRES_VISUAL[$tire];
            }
        }

        return $stint;
    }
}
