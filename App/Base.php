<?php
namespace App;

class Base {

    protected $container;
    public $config;

    public function __construct()
    {
        error_reporting(E_ERROR);
        $this->config = config::returnConfig();
    }
    public static function response($data = null,$ret='200',$msg='操作成功')
    {
        if (empty($data))
        {
            $res =  ['ret'=>intval($ret),'msg'=>$msg,'data'=>[]];
        } else {
            $res =  ['ret'=>intval($ret),'msg'=>$msg,'data'=>$data];
        }
        header('Content-type: application/json');
        return json_encode($res,JSON_UNESCAPED_UNICODE);
    }
}
