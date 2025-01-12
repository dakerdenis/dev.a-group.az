<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public int $daysToCountOnSale;

    public static function group(): string
    {
        return 'general';
    }
}
