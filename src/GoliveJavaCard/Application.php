<?php
/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-24
 * Time: 15:46
 */

namespace Alfredluck\Golivephpsdk\GoliveJavaCard;



use Alfredluck\Golivephpsdk\GoliveJavaCard\UserInfo\ServiceProvider;
use Alfredluck\Kernel\ServiceContainer;

/**
 * Class Application
 * @property \Alfredluck\Golivephpsdk\GoliveJavaCard\UserInfo\Client        $auth
 * @package Alfredluck\Golivephpsdk\GoliveJavaCard
 */
class Application  extends ServiceContainer
{

    protected $providers = [
        ServiceProvider::class
    ];
}