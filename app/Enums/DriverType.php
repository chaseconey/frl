<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static FullTime()
 * @method static static Reserve()
 * @method static static Retired()
 * @method static static Banned()
 */
final class DriverType extends Enum
{
    const FullTime = 'FULL_TIME';

    const Reserve = 'RESERVE';

    const Retired = 'RETIRED';

    const Banned = 'BANNED';
}
