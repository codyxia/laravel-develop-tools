<?php

namespace Cody\LaravelDevelopTools;

class FastMath
{
    public static function decimal($number, $decimal = 2)
    {
        return round($number, $decimal);
    }

    public static function avg($number1, $number2, $decimal = 2)
    {
        return $number1 > 0 && $number2 > 0 ? self::decimal(($number1 / $number2), $decimal) : 0;
    }

    public static function up_down($number1, $number2)
    {
        $diff_price = abs($number1 - $number2);
        $pre = $number1 != 0 && $number2 != 0 ? round(($diff_price / $number2) * 100, 2) : 0;
        if ($pre == 0) {
            return 0;
        }
        if ($number1 > $number2) {
            return -$pre;
        } else {
            return $pre;
        }
    }

    public static function percentage($number1, $number2)
    {

    }
}
