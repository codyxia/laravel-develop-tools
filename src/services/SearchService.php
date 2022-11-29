<?php

namespace Cody\LaravelDevelopTools\services;

class SearchService
{
    public static function one($builder, $key, $item)
    {
        return $builder->when($item, function ($query) use ($key, $item) {
            return $query->where($key, $item);
        });
    }

    //复杂查询
    public static function complex($builder, $key, $item)
    {
        switch ($item[0]) {
            case 'like':
                $builder = $builder->when($item[1], function ($query) use ($key, $item) {
                    return $query->where($key, 'like', '%'.$item[1].'%');
                });
                break;
            case 'between':
                $builder = $builder->when($item[1] && $item[2], function ($query) use ($key, $item) {
                    return $query->whereBetween($key, [$item[1], $item[2]]);
                });
                break;
            case '>' || '<':
                $builder = $builder->when($item[1], function ($query) use ($key, $item) {
                    return $query->where($key, $item[0], $item[1]);
                });
                break;
        }
        return $builder;
    }

    //关联查询
    public static function related($builder, $key, $item)
    {
        if (is_array($item)) {
            return $builder->when($item[1], function ($query) use ($key, $item) {
                return $query->whereHasIn($key[0], function ($q) use ($key, $item) {
                    return self::complex($q, $key[1], $item);
                });
            });
        } else {
            return $builder->when($item, function ($query) use ($key, $item) {
                return $query->whereHasIn($key[0], function ($q) use ($key, $item) {
                    return self::one($q, $key[1], $item);
                });
            });
        }
    }

    //或查询
    public static function or($builder, $key, $item)
    {
        if (is_array($item)) {//复杂查询 like、between、or
            return $builder->where(function ($query) use ($key, $item) {
                return self::complex($query, $key[0], $item);
            })->orWhere(function ($query) use ($key, $item) {
                return self::complex($query, $key[1], $item);
            });
        } else {//简单查询
            return $builder->where(function ($query) use ($key, $item) {
                return self::one($query, $key[0], $item);
            })->orWhere(function ($query) use ($key, $item) {
                return self::one($query, $key[1], $item);
            });
        }
    }
}
