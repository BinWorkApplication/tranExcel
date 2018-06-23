<?php

/**
 * Date: 2018/6/21
 * Time: 20:03
 */

namespace bing;

class Bing
{
    private static $classMap = array();

    public static function run(){
        new \bing\core\Controller();

        // 实例化路由
        $route = new \bing\core\Route();
        $route->test();
    }

    public static function load($class){
        // 为了避免重复引入已经引入的类，先判断该类是否已经被引入
        // 例如实例化route类，参数 $class = 'core\route'
        // 需要转化为 '/core/route.php'，用include引入对应的文件
        // 判断是否已经引入了该类文件。

        if( isset( $classMap[$class] ) ){
            return true;
        }else{
            $classArr = explode('\\',$class);
            $class = implode(DS,$classArr);
            $file = ROOT . $class.'.php';

            if( is_file( $file ) ){
                include $file;
                self::$classMap[$class] = $class;
            }else{
                return false;
            }
        }
    }
}