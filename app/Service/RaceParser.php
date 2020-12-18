<?php

namespace App\Service;

class RaceParser
{

    /**
     * @param  string  $json
     * @return \Illuminate\Support\Collection
     */
    public function parse(string $json)
    {
        $result = json_decode($json, true);

        $drivers = $result['Driver'];
        $grouped = [];

        foreach ($result as $label => $data) {
            foreach ($drivers as $id => $driver) {
                $grouped[$id][$label] = $data[$id];
            }
        }

        return collect($grouped);
    }
}
