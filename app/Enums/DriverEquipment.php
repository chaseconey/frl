<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class DriverEquipment
 *
 * @method static static Pad()
 * @method static static Wheel()
 * @method static static Keyboard()
 */
final class DriverEquipment extends Enum
{
    const Pad = 'pad';

    const Wheel = 'wheel';

    const Keyboard = 'keyboard';
}
