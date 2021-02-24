<?php

namespace Golivephpsdk\Common;


/**
 * Created by PhpStorm.
 * User: yangjun
 * Date: 2021-02-23
 * Time: 10:57
 */
use GuzzleHttp\Client;

class HttpClient{


    protected $guzzleOptions =[];

    public function getHttpClient(){
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options){
        $this->guzzleOptions = $options;
    }
}