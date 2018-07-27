<?php
namespace App;

use App\Server\RouteClass;

class Route {

    public $serverRoute;
    public $config;
    public function __construct($config)
    {
        $this->serverRoute  = new RouteClass();
        $this->config  =  $config instanceof \Closure ?  call_user_func($config) : "";

    }

    public function useDistribute()
    {
        return $this->serverRoute->distribute(self::returnRoute());
    }
    public static function returnRoute()
    {
        return [
            ''=>['User','IndexController','test'],
            '/index'=>['User','IndexController','index'],
            '/upload_file'=>['User','IndexController','upload']

        ];
    }
}