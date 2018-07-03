<?php
/**
 * Date: 2018/6/22
 * Time: 15:13
 */

namespace bing\core;

//1、默认控制器方法
//2、获取控制器
//3、获取方法
//4、获取get参数
//5、不同的传参方式 1）?id=1&id2=2  2）/id/1/id2/2
class Route
{

    // 存储应用
    public $module;
    // 存储控制的变量
    public $controller;
    // 存储方法的变量
    public $action;

    public function __construct(){
        // 默认的应用、控制器和方法
        $this->module = \bing\core\Config::get('module','_app_');
        $this->controller = \bing\core\Config::get('controller','_app_');
        $this->action = \bing\core\Config::get('action','_app_');

        // 如果网站不是放在根目录
        if($_SERVER['SCRIPT_NAME'] != '/index.php'){
            $tempUrl = str_replace('/index.php','',$_SERVER['SCRIPT_NAME']);
            $realUrl = str_replace($tempUrl,'',$_SERVER['REQUEST_URI']);
        }else{
            $realUrl = $_SERVER['REQUEST_URI'];
        }

        // 是否带有?id=1&id2=2的get方式参数
        if(!empty($_SERVER['QUERY_STRING'])){
            $realUrl = str_replace('?'.$_SERVER['QUERY_STRING'],'',$realUrl);
        }

        $realUrlArr = explode('/',ltrim($realUrl,'/'));

        if(!empty($realUrlArr[0])){
            $this->module = $realUrlArr[0];
            unset($realUrlArr[0]);
        }
        if(!empty($realUrlArr[1])){
            $this->controller = $realUrlArr[1];
            unset($realUrlArr[1]);
        }
        if(!empty($realUrlArr[2])){
            $this->action = $realUrlArr[2];
            unset($realUrlArr[2]);
        }

        // 当采用/id/1/id2/2这种方式传参时，需要手动对$_GET超全局变量赋值
        if(empty($_SERVER['QUERY_STRING']) && count($realUrlArr)>2){
            // 奇偶判断，我用的是桉位运算来判断，也有求余来判断的
            if((count($realUrlArr) & 1) == 0){
                for($i=3;$i<count($realUrlArr)+3;$i=$i+2){
                    $_GET[$realUrlArr[$i]] = $realUrlArr[$i+1];
                }
            }else{
                throw new \Exception('Url传递的参数不正确：'.$_SERVER['REQUEST_URI']);
            }
        }

    }

}