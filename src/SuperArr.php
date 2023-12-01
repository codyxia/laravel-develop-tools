<?php

namespace Cody\LaravelDevelopTools;

class SuperArr
{
    /**
     * @throws \Exception
     * 传入一个数组和指定的value 会将value作为key 重新生成一个数组返回
     */
    public static function createArrayWithKeyFromValue($inputArray, $valueKey)
    {
        if (! is_array($inputArray)) {
            throw new \Exception('error input array');
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
}
