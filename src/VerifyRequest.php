<?php

namespace Cody\LaravelDevelopTools;

use Cody\LaravelDevelopTools\enum\ResponseEnum;
use Cody\LaravelDevelopTools\exception\BusinessException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VerifyRequest
{
    //验证参数是否存在
    public static function unique($table, $data, $parameter, $id, $where = [], $message = '数据已存在')
    {
        $messages = [
            $parameter.'.unique' => $data[$parameter].'已存在',
        ];
        $validator = Validator::make($data, [
            $parameter => [
                Rule::unique($table)->ignore($id)->where(function ($query) use ($where) {
                    if ($where) {
                        foreach ($where as $k => $v) {
                            $query = $query->where($k, $v);
                        }
                    }

                    return $query;
                }),
            ],
        ], $messages);
        if ($validator->fails()) {
            throw new BusinessException(ResponseEnum::CLIENT_SAVE_DATA_EXIST, $message);
        }
    }
}
