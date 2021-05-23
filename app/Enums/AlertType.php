<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Alert()
 * @method static static Info()
 * @method static static Success()
 * @method static static Warning()
 * @method static static Error()
 */
final class AlertType extends Enum
{
    const Alert     = "alert";
    const Info      = "info";
    const Success   = "success";
    const Warning   = "warning";
    const Error     = "error";
}
