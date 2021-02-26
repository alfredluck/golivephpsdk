<?php
/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 11:03
 */

namespace Golivephpsdk\GoliveJavaCard\Lib;


class Common
{

    public function getSign($data, $key)
    {
        ksort($data);
        $dataJson = json_encode($data, JSON_UNESCAPED_UNICODE);
        $signHash = hash_hmac('sha256', $dataJson, $key);
        $sign     = base64_encode($signHash);
        return $sign;
    }
}