<?php

namespace App\Admin\Enums;

final class ResponseCodeEnum
{
    const HTTP_OK = 200;
    const HTTP_UNAUTHORIZED = 401;

    // 业务操作正确码：1xx、2xx、3xx 开头，后拼接 3 位
    // 200 + 001 => 200001，也就是有 001 ~ 999 个编号可以用来表示业务成功的情况，当然你可以根据实际需求继续增加位数，但必须要求是 200 开头
    // 举个栗子：你可以定义 001 ~ 099 表示系统状态；100 ~ 199 表示授权业务；200 ~ 299 表示用户业务...
    const SERVICE_LOGIN_SUCCESS = 200100;

    // 客户端错误码：400 ~ 499 开头，后拼接 3 位
    const CLIENT_PARAMETER_ERROR = 400000;

    // 服务端操作错误码：500 ~ 599 开头，后拼接 3 位
    const SYSTEM_ERROR = 500000;

    public static $codeMap = [
        self::SERVICE_LOGIN_SUCCESS => '登录成功',

        self::CLIENT_PARAMETER_ERROR => '参数错误',

        self::SYSTEM_ERROR => '系统错误',
    ];

    public static function getMessage($code)
    {
        if (! array_key_exists($code, static::$codeMap)) {
            return null;
        }

        return static::$codeMap[$code];
    }
}
