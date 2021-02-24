<?php
/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-24
 * Time: 15:46
 */

namespace Golivephpsdk\GoliveJavaCard;



use Golivephpsdk\GoliveJavaCard\UserInfo\ServiceProvider;
use Golivephpsdk\Kernel\ServiceContainer;

/**
 * Class Application
 *
 * @property \Golivephpsdk\GoliveJavaCard\UserInfo\Client        $auth
 *
 */
class Application  extends ServiceContainer
{

    protected $providers = [
        ServiceProvider::class
    ];
}