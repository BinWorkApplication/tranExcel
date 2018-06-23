<?php

/**
 * Date: 2018/5/31
 * Time: 20:03
 */

namespace bing\core;

class UploadFile
{
    // 上传目录
    public $uploadPath = 'upload';

    // 文件大小，单位：字节 默认为2m
    public $fileSize = 2097152;

    // 上传文件
    private $file;

    // 返回代码
    const SUCCESS = '200';       // 文件保存成功
    const SIZELG = '201';        // 文件大小超过设定值
    const FILEEXIST = '202';     // 文件已经存在


    // $files = $_FILES['upload_file']
    public function __construct($files)
    {
        $this->file = $files;
    }

    // 检查上传目录是否存在，不存在则创建
    private function _checkPathExists()
    {
        if(!is_dir($this->uploadPath)){
            mkdir($this->uploadPath,0777,true);
        }
    }

    // 返回文件名，不包含后缀
    public function fileNameWithoutExt(){
        $name = explode('.',$this->file['name']);
        return $name[0];
    }


    // 上传文件
    public function uploadFile()
    {
        $this->_checkPathExists();
        if($this->file['size'] > $this->fileSize){
            return self::SIZELG;
        }
        $filePath = $this->uploadPath.'/'.$this->file['name'];

        if (file_exists($filePath)){
            return self::FILEEXIST;
        }else{
            move_uploaded_file($this->file['tmp_name'],$filePath);
            return self::SUCCESS;
        }

    }

}