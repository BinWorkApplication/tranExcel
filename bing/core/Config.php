<?php
/**
 * Date: 2018/6/21
 * Time: 20:24
 */

namespace bing\core;


use PhpOffice\PhpSpreadsheet\Exception;

class Config
{
    public static $config = array();

    public static function get($file,$name){
        if(isset(self::$config[$file][$name])){
            return self::$config[$file][$name];
        }else{
            $filePath = CONFIG_PATH . $file . '.php';
            if(is_file($filePath)){
               $config[$file] = include $filePath;
               if(isset($config[$file][$name])){
                   return $config[$file][$name];
               }else{
                   throw new Exception('找不到配置项：' . $name);
               }
            }else{
                throw new Exception('找不到配置文件：' . $filePath);
            }
        }
    }
}