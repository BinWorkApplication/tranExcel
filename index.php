<?php

/*版本号：1.0
命名约定：
1、类文件名，类名，均采用驼峰法，首字母大写
2、方法名采用驼峰法，首字母小写
*/

// 定义应用目录
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);
define('APP_PATH', __DIR__ . DS . 'app' . DS);
define('APP_CORE', APP_PATH . 'core' . DS);
define('BING_PATH', __DIR__ . DS . 'bing' . DS);
define('BING_CORE', BING_PATH . 'core' . DS);
define('VENDOR_PATH', __DIR__ . DS . 'vendor' . DS);
define('MEDIA_PATH', __DIR__ . DS . 'media' . DS);
define('CONFIG_PATH', BING_PATH . 'config' . DS);


// 加载框架引导文件
require BING_PATH . 'engineStart.php';
