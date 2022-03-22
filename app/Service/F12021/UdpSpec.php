<?php

namespace App\Service\F12021;

use App\Exceptions\ResultsUploadError;

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

    /**
     * Gets fastest lap tired using lap history and maps to visual tire character
     */
    public static function getFastestLapTire(array $result): string
    {
        // Make sure we have required data
        if (!array_key_exists('m_tyreStintsHistoryData', $result) || !array_key_exists('m_bestLapTimeLapNum', $result)) {
            throw new ResultsUploadError('Missing tire stint data');
        }

        $stints = collect($result['m_tyreStintsHistoryData']);
        $bestLapNum = $result['m_bestLapTimeLapNum'];

        // Grab stint where fastest lap occurred
        $sortedStints = $stints->where('m_tyreVisualCompound', '>', 0)
            ->sortBy('m_endLap');

        if ($sortedStints->count() === 1) {
            $fastestStint = $sortedStints->first();
        } else {
            $fastestStint = $sortedStints->firstWhere('m_endLap', '>', $bestLapNum);
        }

        // Get the visual compound
        $tireId = $fastestStint['m_tyreVisualCompound'];

        // Map it into visual identifier
        $visualTire = $tireId ? static::TIRES_VISUAL[$tireId] : null;

        return $visualTire;
    }
}
