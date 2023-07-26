<?php

namespace App;

class Redirector
{
    public static function redirectWithParamsEncoded($url, array $params):void
    {
        $encodedParams = base64_encode(json_encode($params));

        header("Location: $url?data=$encodedParams");
        exit();
    }
}
