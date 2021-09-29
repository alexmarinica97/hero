<?php


namespace App\traits;


Trait SystemTrait
{
    /**
     * @param $value
     * @return bool
     */
    public static function chance($value)
    {
        return mt_rand(0, 99) < ($value * 100);
    }
}