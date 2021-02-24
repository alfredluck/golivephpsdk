<?php


/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 13:39
 */




namespace Golivephpsdk\tests;
use Golivephpsdk\GoliveJavaCard\User;
use PHPUnit\Framework\TestCase;


class GoliveJavaCardTest extends TestCase
{

    public function testGetUserInfo(){

        $User = new User('H2001081059060727510','990617','http://47.114.185.57:8181/account');

        $response = $User->getUserInfo('杨军','18167106183','S10106',144);

        var_dump($response);


    }
}