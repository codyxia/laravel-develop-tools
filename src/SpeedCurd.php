<?php

namespace Cody\LaravelDevelopTools;

use Cody\LaravelDevelopTools\services\SearchService;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SpeedCurd
{
    /**
     * @param  Builder  $builder
     * @param $params
     * @return Builder|mixed
     */
    static public function SearchLists(Builder $builder, $params)
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

    static public function CreateOrUpdateById(Builder $builder, $params)
    {
        if (isset($params['id']) && $params['id'] != null) {
            return $builder->where('id', $params['id'])->update($params);
        }
        return $builder->create($params);
    }

    static public function CreateOrUpdateByAttribute(Builder $builder, $params)
    {
        return $builder->updateOrCreate($params['attribute'], $params['data']);
    }
}
