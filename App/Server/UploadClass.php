<?php
namespace App\Server;

use App\Base;

class UploadClass extends Base{

    public $max_size;
    public $path;
    public $new_name;
    public $root_path;
    public $ext;
    public $file;
    /**
     * 上传错误信息
     * @var string
     */
    public $error = false; //上传错误信息

    public function __construct()
    {
        parent::__construct();
        switch ($this->config['upload_path'])
        {
            case "day" :
                $this->path = date("Ymd") . "/";
                break;
            case "month" :
                $this->path = date("Ym") . "/";
                break;
            case "Year" :
                $this->path = date("Y") . "/";
                break;
            case "/" :
                $this->path = "/";
                break;
            default :
                $this->path = "/";
                break;
        }
        $this->max_size     = $this->config['max_size'];
        $this->new_name     = md5(time()); //自定义文件新名字,如果不设置,文件的新名规则为随机的md5字符串
        $this->root_path    = dirname(dirname(__DIR__)) . '/upload/';
        $this->ext          = json_decode($this->config['file_ext']);
    }

    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError(){
        return $this->error;
    }
    public function upload($file){
        if(empty($file)){
            $this->error = '没有选择文件';
            return $this;
        }
        if (empty($_FILES[$file]))
        {
            $this->error = '上传未成功:' . $_FILES[$file]["error"];
            return $this;
        }
        if (!empty($this->ext) && !in_array($_FILES[$file]["type"],$this->ext))
        {
            $this->error = '不被允许的类型';
            return $this;
        }
        $ret = mkdir($this->root_path.$this->path,0777,true);

        if(!is_dir($this->root_path.$this->path)){
            $this->error = "不能建立目录" . $this->root_path.$this->path.",请在根目录建立upload文件夹,并给目录赋予权限777.";
            return $this;
        }
        $this->new_name = $this->new_name .'.' . end(explode('.',$_FILES[$file]['name']));
        $fileSavePath   = $this->root_path.$this->path . "{$this->new_name}";

        if (move_uploaded_file($_FILES[$file]["tmp_name"],$fileSavePath))
            $this->file = "/upload/" .$this->path . "{$this->new_name}";
        else
            $this->error = "移动到目录失败";

        return $this;

    }



}