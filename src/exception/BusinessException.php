<?php

namespace Cody\LaravelDevelopTools\exception;

use Exception;

class BusinessException extends Exception
{
    public function __construct(array $codeResponse, $info = '')
    {
        [$code, $message] = $codeResponse;
        parent::__construct($info ?: $message, $code);
    }
}
