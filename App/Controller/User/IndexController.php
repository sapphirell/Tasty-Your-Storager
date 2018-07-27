<?php
namespace App\Controller\User;

use App\Base;
use App\Model\ModelClass;
use App\Server\DBClass;
use App\Server\PDClass;
use App\Server\Queue;
use App\Server\RedisClass;
use App\Server\RequestClass;
use App\Server\UploadClass;

class IndexController extends Base {
    public $model;
    public $upload;
    public $redis;
    public $queue;
    public function __construct
    (
        RequestClass $requestClass,
        UploadClass $upload)
    {
        $this->upload = $upload;
    }
    public function tester()
    {
        echo "<form action='/upload_file' method=\"post\"enctype=\"multipart/form-data\">

                <label for=\"file\">Filename:</label>
                <input type=\"file\" name=\"image\" id=\"file\" /> 
                <br />
                <input type=\"submit\" name=\"submit\" value=\"Submit\" />
              </form>
            ";
    }
    public function index(){
        return $this->tester();
    }
    public function upload()
    {
        $ret = $this->upload->upload('image');
        if ($ret->error)
        {
            return self::response([],40000,$ret->error);
        }
        return self::response(['url'=>$ret->file]);
    }
    public function test()
    {
        return 'hello,Moe';

    }
}
