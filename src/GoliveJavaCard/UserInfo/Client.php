<?php
/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 10:53
 */

namespace Golivephpsdk\GoliveJavaCard\UserInfo;


use Golivephpsdk\Common\HttpClient;
use Golivephpsdk\GoliveJavaCard\Lib\Common;
use Golivephpsdk\Kernel\BaseClient;


class Client extends BaseClient
{
    /**
     * 获取java青卡用户信息
     * @param string $name
     * @param string $pone
     * @param string $tenantCode
     * @param int    $tenantId
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserInfo($name, $pone, $tenantCode, $tenantId)
    {
        $params = [
            'appId'     => $this->app['config']->get('appId'),
            'body'      => [
                'phone'      => $pone,
                'pwd'        => $name,
                'tenantCode' => $tenantCode,
                'tenantId'   => $tenantId,
            ],
            'signType'  => '2',
            'timestamp' => date('Y-m-d H:i:s'),
            'version'   => '1.0',
        ];

        try {
            $common              = new Common();
            $params['signValue'] = $common->getSign($params, $this->app['config']->get('appSecret'));
            $client = new HttpClient();
            $client->setGuzzleOptions(['headers' => ['Content-Type' => 'application/json']]);
            $response = $client->getHttpClient()->post($this->app['config']->get('apiUrl') . '/account/getAccountCode', [
                'body' => json_encode($params),
                'timeout'=> 10
            ])->getBody()->getContents();
            return \json_decode($response, true);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }


}