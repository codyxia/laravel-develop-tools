<?php

namespace Cody\LaravelDevelopTools;

use Exception;

class SuperArr
{
    /**
     * @throws Exception
     * 传入一个数组和指定的value 会将value作为key 重新生成一个数组返回
     */
    public static function createArrayWithKeyFromValue($inputArray, $valueKey): array
    {
        if (! is_array($inputArray)) {
            throw new Exception('error input array');
        }
        $newArr = [];
        foreach ($inputArray as $item) {
            if (! in_array($item, $valueKey)) {
                continue;
            }
            $newArr[$item[$valueKey]] = $item;
        }

        return $newArr;
    }

    //传入一个数组和指定的判断条件 会将满足条件的数组元素重新生成一个数组返回
    /**
     * @throws Exception
     * $inputArray
     * $condition
     */
    public static function createArrayWithCondition($inputArray, $condition): array
    {
        if (! is_array($inputArray)) {
            throw new Exception('error input array');
        }
        $newArr = [];
        foreach ($inputArray as $item) {
            if (! $condition($item)) {
                continue;
            }
            $newArr[] = $item;
        }

        return $newArr;
    }

}
