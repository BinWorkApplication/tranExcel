<?php
/**
 * Created by Bingo.
 * Date: 2018/6/20
 * Time: 19:52
 */

include 'bing/core/AsciiTran.php';

use \bing\core\AsciiTran;

//分割字符串
function mb_str_split( $string ) {
    # Split at all position not after the start: ^
    # and not before the end: $
    return preg_split('/(?<!^)(?!$)/u', $string );
}


$str = '，。《》、？；：‘“、|【】｛｝！@#￥%……&’”';

$results = mb_str_split($str);

foreach ($results as $result){
    echo AsciiTran::strToAscii($result),':',AsciiTran::asciiToStr(AsciiTran::strToAscii($result)),'<br>';
}
