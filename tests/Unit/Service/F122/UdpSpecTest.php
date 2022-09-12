<?php

namespace Tests\Unit\Service\F122;

use App\Exceptions\ResultsUploadError;
use App\Service\F122\UdpSpec;
use PHPUnit\Framework\TestCase;

class UdpSpecTest extends TestCase
{
    public function testMappingFastestTire()
    {
        $raceData =
            [
                'm_bestLapTimeLapNum' => 14,
                'm_tyreStintsHistoryData' => [
                    [
                        'm_endLap' => 4,
                        'm_tyreActualCompound' => 18,
                        'm_tyreVisualCompound' => 18,
                    ],
                    [
                        'm_endLap' => 10,
                        'm_tyreActualCompound' => 17,
                        'm_tyreVisualCompound' => 17,
                    ],
                    [
                        'm_endLap' => 255,
                        'm_tyreActualCompound' => 17,
                        'm_tyreVisualCompound' => 17,
                    ],
                    [
                        'm_endLap' => 0,
                        'm_tyreActualCompound' => 0,
                        'm_tyreVisualCompound' => 0,
                    ],
                ],
            ];

        $fastestTire = UdpSpec::getFastestLapTire($raceData);

        $this->assertEquals('M', $fastestTire);
    }

    public function testMappingFastestTireWhenMissingData()
    {
        // Missing m_bestLapTimeLapNum
        $raceData = [
            'm_tyreStintsHistoryData' => [
                [
                    'm_endLap' => 4,
                    'm_tyreActualCompound' => 18,
                    'm_tyreVisualCompound' => 18,
                ],
            ],
        ];

        $this->expectException(ResultsUploadError::class);

        UdpSpec::getFastestLapTire($raceData);

        // Missing m_tyreStintsHistoryData
        $raceData = [
            'm_bestLapTimeLapNum' => 14,
        ];

        $this->expectException(ResultsUploadError::class);

        UdpSpec::getFastestLapTire($raceData);
    }
}
