<?php

namespace Cody\LaravelDevelopTools;

use Cody\LaravelDevelopTools\services\SearchService;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SpeedCurd
{
    /**
     * @return Builder|mixed
     */
    public static function SearchLists(Builder $builder, $params)
    {
        foreach ($params as $key => $item) {
            if (str_contains($key, '|')) {//or 查询
                $key_arr = explode('|', $key);
                if (count($key_arr) != 2) {
                    throw new BadRequestException('只支持两个字段的or查询');
                } else {
                    $builder = $builder->where(function ($query) use ($key_arr, $item) {
                        return SearchService::or($query, $key_arr, $item);
                    });
                }
            } elseif (str_contains($key, '.')) {//关联查询
                $key_arr = explode('.', $key);
                if (count($key_arr) > 2) {
                    throw new BadRequestException('只支持一层的关联查询查询');
                } else {
                    SearchService::related($builder, $key_arr, $item);
                }

            } else {//直接查询
                if (is_array($item)) {//复杂查询 like、between、or
                    $builder = SearchService::complex($builder, $key, $item);
                } else {//简单查询
                    $builder = SearchService::one($builder, $key, $item);
                }
            }
        }

        return $builder;
    }

    public static function CreateOrUpdateById(Builder $builder, $params)
    {
        if (isset($params['id']) && $params['id'] != null) {
            return $builder->where('id', $params['id'])->update($params);
        }

        return $builder->create($params);
    }

    public static function CreateOrUpdateByAttribute(Builder $builder, $params)
    {
        return $builder->updateOrCreate($params['attribute'], $params['data']);
    }

    /**
     * @return bool
     * 判断数据是否存在
     */
    public static function dataExists(Builder $builder, $params): bool
    {
        return $builder->where($params)->exists();
    }
}
