<?php
/**
 * Date: 2018/6/21
 * Time: 11:10
 */

require BING_CORE . 'AsciiTran.php';
require VENDOR_PATH . 'autoload.php';
require BING_PATH . 'Bing.php';


spl_autoload_register('\bing\Bing::load');

// 载入系统配置
\bing\core\Config::set(include BING_PATH . 'config' . DS . 'config.php');

// 载入用户配置
\bing\core\Config::set(include APP_PATH . 'config.php',null,'_app_');

\bing\Bing::run();


//require APP_CORE . 'Index/controller/index.php';

//// 实例化控制器的index()方法
//use app\core\index\Index;
//
//$indexCtr = new Index;
//$indexCtr->index();
