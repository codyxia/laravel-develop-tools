<?php

namespace Cody\LaravelDevelopTools;

class FastMath
{
    /**
     * @param $number
     * @param $decimal
     * @return float
     * 对小数取精度
     */
    public static function decimal($number, $decimal = 2)
    {
        return round($number, $decimal);
    }

    /**
     * @param $number1
     * @param $number2
     * @param $decimal
     * @return float|int
     * 计算两个数字的平均数
     */
    public static function avg($number1, $number2, $decimal = 2)
    {
        return $number1 > 0 && $number2 > 0 ? self::decimal(($number1 / $number2), $decimal) : 0;
    }

    /**
     * @param $number1
     * @param $number2
     * @return float|int
     * 计算number1相对number2的变化幅度
     */
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

    /**
     * 计算$number2相对于$number1的百分比。
     *
     * @param float $number1 分母
     * @param float $number2 分子
     * @return float 返回百分比值
     */
    public static function calculatePercentage($number1, $number2)
    {
        // 避免除零错误
        if ($number1 == 0) {
            return 0;
        }
        // 计算百分比
        return ($number2 / $number1) * 100;
    }
}
