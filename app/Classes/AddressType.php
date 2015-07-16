<?php namespace App\Classes;
/**
 * Created by PhpStorm.
 * User: Tihomir
 * Date: 30.6.2015 г.
 * Time: 7:55
 */
class AddressType
{
    public static $types = [
        1 => 'Home',
        2 => 'Mail',
        3 => 'Business',
        4 => 'Billing',
        5 => 'Other'
    ];

    public static function getType($key)
    {
        return isset(self::$types[$key]) ? self::$types[$key] : 'not found';
    }
}