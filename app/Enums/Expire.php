<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static After10Minutes()
 * @method static static After30Minutes()
 * @method static static After1Hour()
 * @method static static After6Hours()
 * @method static static After12Hours()
 * @method static static After1Day()
 * @method static static After1Week()
 * @method static static After2Weeks()
 * @method static static After1Month()
 * @method static static AYear()
 * @method static static Never()
 */
final class Expire extends Enum
{
    const After10Minutes    = "+10 minutes";
    const After30Minutes    = "+30 minutes";
    const After1Hour        = "+1 hours";
    const After6Hours       = "+6 hours";
    const After12Hours      = "+12 hours";
    const After1Day         = "+1 days";
    const After1Week        = "+1 weeks";
    const After2Weeks       = "+2 weeks";
    const After1Month       = "+1 months";
    const AYear             = "+1 years";
    const Never             = "+1000 years";
}
