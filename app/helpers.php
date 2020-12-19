<?php

function f1_team_color($name)
{
    if ($name) {
        $transformed = Str::of($name)->lower()->slug();

        return "border-{$transformed}";
    }

    return '';
}
