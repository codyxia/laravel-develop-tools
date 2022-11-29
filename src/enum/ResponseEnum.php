<?php

namespace Cody\LaravelHttpResponse\enum;

class ResponseEnum
{
    const HTTP_OK                       = [200, '操作成功'];
    const CLIENT_HTTP_UNAUTHORIZED      = [401, '未登录'];
    const CLIENT_SAVE_DATA_EXIST        = [402, '数据已存在'];
    const CLIENT_NOT_ALLOW_OPERATE      = [403, '禁止操作'];
    const CLIENT_NOT_FOUND_ERROR        = [404, '请求数据不存在'];
    const CLIENT_METHOD_HTTP_TYPE_ERROR = [405, '请求类型错误'];
    const CLIENT_REQUEST_TOO_MANY       = [406, '操作频率太高'];
    const CLIENT_METHOD_ERROR           = [407, '请求地址出错'];
    const SYSTEM_ERROR                  = [500, '服务器错误'];
}
