<?php
/**
 * Date: 2018/6/21
 * Time: 17:44
 */

namespace bing\core;


class Controller
{
    public $assign = array();

    public function assign($key,$value){
        $this->assign[$key] = $value;
    }

    public function display($fileName,$ext = 'php'){
        $filePath = APP_CORE . 'Index' . DS . 'view' . DS . $fileName . '.' . $ext;

        if(is_file($filePath)){
            extract($this->assign);
            include $filePath;
        }else{
            throw new \Exception('找不到该视图文件：' . $filePath);
        }
    }
}