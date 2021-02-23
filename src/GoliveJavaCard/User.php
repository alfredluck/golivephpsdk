<?php
/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 10:53
 */

namespace Alfredluck\Golivephpsdk\GoliveJavaCard;


use Alfredluck\Golivephpsdk\HttpClient;


class User
{


    protected $appId;

    protected $appSecret;

    protected $apiUrl;


    public function __construct($appId, $appSecret, $apiUrl)
    {
        $this->appId     = $appId;
        $this->appSecret = $appSecret;
        $this->apiUrl    = $apiUrl;

    }

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
            'appId'     => $this->appId,
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
            $params['signValue'] = $common->getSign($params, $this->appSecret);

            $client = new HttpClient();
            $client->setGuzzleOptions(['headers' => ['Content-Type' => 'application/json']]);

            $response = $client->getHttpClient()->post($this->apiUrl . '/account/getAccountCode', [

                'body' => json_encode($params)

                ])->getBody()->getContents();

            return \json_decode($response, true);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }


}