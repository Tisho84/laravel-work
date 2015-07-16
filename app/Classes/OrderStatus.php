<?php namespace App\Classes;
/**
 * Created by PhpStorm.
 * User: Tihomir
 * Date: 30.6.2015 г.
 * Time: 0:17
 */
class OrderStatus
{
    public static $statuses = [
        1 => 'Pending',
        2 => 'Processing',
        3 => 'Preparing',
        4 => 'Paid',
        5 => 'Delivered',
        6 => 'Cancelled'
    ];

    public static function getStatus($key)
    {
        return isset(self::$statuses[$key]) ? self::$statuses[$key] : 'not found';
    }
}