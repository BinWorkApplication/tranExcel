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

    public function display($fileName = null,$ext = 'php'){

        // 实例化路由
        $route = new \bing\core\Route();

        // 首字母大写
        $module = ucfirst($route->module);
        $action = strtolower($route->action);

        if(!empty($fileName)){
            $filePath = APP_CORE . $module . DS . 'view' . DS . $fileName . '.' . $ext;
        }else{
            $filePath = APP_CORE . $module . DS . 'view' . DS . $action . '.' . $ext;
        }

        if(is_file($filePath)){
            extract($this->assign);
            include $filePath;
        }else{
            throw new \Exception('找不到该视图文件：' . $filePath);
        }
    }
}