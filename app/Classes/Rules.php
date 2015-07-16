<?php namespace App\Classes;
/**
 * Created by PhpStorm.
 * User: Tihomir
 * Date: 15.7.2015 г.
 * Time: 22:06
 */
class Rules
{
    private static $rules = [
        'phone' => "^\+?[0-9]+(\([0-9]+\))?[0-9-]*[0-9]$^",
    ];

    public static function getRule($key){
        if(self::$rules[$key]) {
            return self::$rules[$key];
        }
        return '';
    }
}