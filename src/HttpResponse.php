<?php

namespace Cody\LaravelDevelopTools;

use Cody\LaravelDevelopTools\enum\ResponseEnum;
use Cody\LaravelDevelopTools\exception\BusinessException;

trait HttpResponse
{
    public function success($data = null)
    {
        [$code] = ResponseEnum::HTTP_OK;

        return response()->json([
            'status' => true,
            'code' => $code,
            'data' => $data,
        ]);
    }

    public function successPaginate($data)
    {
        return $this->success($this->paginate($data));
    }

    /**
     * @return array
     */
    public function paginate($data)
    {
        return [
            'total' => $data->total(),
            'items' => $data->items(),
            'additional' => $data->additional ?? null,
        ];
    }

    /**
     * @throws BusinessException
     */
    public function throwBusinessException(array $codeResponse = ResponseEnum::SYSTEM_ERROR, string $info = '')
    {
        throw new BusinessException($codeResponse, $info);
    }
}
