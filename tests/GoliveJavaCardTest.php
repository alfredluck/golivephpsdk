<?php


/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 13:39
 */




namespace Golivephpsdk\tests;
use Golivephpsdk\Factory;
use Golivephpsdk\GoliveJavaCard\UserInfo\Client;
use PHPUnit\Framework\TestCase;


class GoliveJavaCardTest extends TestCase
{

    /**
     * java青卡用户信息获取单元测试
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetUserInfo(){
        $config  = [
            'appId'=>'H2001081059060727510',
            'appSecret'=>'990617',
            'apiUrl'=>'http://47.114.185.57:8181/account'
        ];
        $factory = Factory::goliveJavaCard($config);
        $response = $factory->auth->getUserInfo('杨军','18167106183','S10106',144);
        var_dump($response);
        $this->assertArrayHasKey('code',$response);
    }
}