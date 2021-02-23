<?php
/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 14:36
 */

namespace Alfredluck\Golivephpsdk\GoliveJavaCard;


class ServiceProvider extends  \Illuminate\Support\ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->singleton(User::class, function(){
            return new User(config('services.golivephpsdk.appId'),config('services.golivephpsdk.appSecret'),config('services.golivephpsdk.apiUrl'));
        });

        $this->app->alias(User::class, 'golivephpsdk');
    }

    public function provides()
    {
        return [User::class, 'golivephpsdk'];
    }
}