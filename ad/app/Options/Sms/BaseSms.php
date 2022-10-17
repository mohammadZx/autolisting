<?php

namespace App\Options\Sms;

class BaseSms{
    public static $drivers = [
        'melipayamak' => \App\Options\Sms\Melipayamak\Melipayamak::class,
        'ghasedak' => \App\Options\Sms\Ghasedak\Ghasedak::class
    ];

    public static function sms($driver = 'ghasedak')
    {
        return new self::$drivers[$driver]();
    }
}