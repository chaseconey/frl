<?php

/**
 * Takes team name and returns proper css border class name
 *
 * @param $name
 * @return string
 */
function f1_team_color($name)
{
    if ($name) {
        $transformed = Str::of($name)->lower()->slug();

        return "border-{$transformed}";
    }

    return '';
}

/**
 * Takes country short code and returns long-form country name
 *
 * @param $short
 * @return string
 */
function country_code_to_name($short)
{
    return config("countries.{$short}", $short);
}

/**
 * Converts a float time in seconds to a human readable string
 *
 * Example: 81.006 will be 01:21.006
 *
 * @param $timeInSeconds
 * @return string
 */
function format_seconds_as_human_time($timeInSeconds): string
{
    return now()->startOfDay()->addMillis($timeInSeconds * 1000)->format('i:s.v');
}
