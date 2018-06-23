<?php

/**
 * Date: 2018/6/21
 * Time: 9:07
 */

namespace bing\core;

class AsciiTran
{

    // 字母转为ASCII编码
    public static function strToAscii($str){

        $str=mb_convert_encoding($str,'GB2312');
        $change_after='';
        for($i=0;$i<strlen($str);$i++){
            $temp_str=dechex(ord($str[$i]));
            $change_after.=$temp_str[1].$temp_str[0];
        }
        return strtoupper($change_after);
    }


    // ASCII编码转为字母
    public static function asciiToStr($ascii){

        $asc_arr= str_split(strtolower($ascii),2);
        $str='';
        for($i=0;$i<count($asc_arr);$i++){
            $str.=chr(hexdec($asc_arr[$i][1].$asc_arr[$i][0]));
        }
        return mb_convert_encoding($str,'UTF-8','GB2312');
    }
}