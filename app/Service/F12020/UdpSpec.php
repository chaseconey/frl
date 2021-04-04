<?php


namespace App\Service\F12020;


class UdpSpec
{

    const TIRES_VISUAL = [
        16 => "S",
        17 => "M",
        18 => "H",
        7 => "I",
        8 => "W"
    ];

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
