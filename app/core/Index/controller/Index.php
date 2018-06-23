<?php
/**
 * Date: 2018/6/21
 * Time: 11:06
 */

namespace app\core\index;

use PhpOffice\PhpSpreadsheet\IOFactory;
use bing\core\AsciiTran;
use bing\core\Controller;

class Index extends Controller
{
    public function index()
    {

        $this->assign('text','This is the first time');
        $this->display('index');
        exit();

        $spreadsheet = IOFactory::load(MEDIA_PATH . 'upload\excel\PO992993.xlsx');

        $worksheet = $spreadsheet->getActiveSheet();
        $allColumn = $worksheet->getHighestColumn();
        $allRow = $worksheet->getHighestRow();


        $allColumn++;
        for ($row=1;$row<=$allRow;$row++){
            for ($column='A';$column!=$allColumn;$column++){

                // 是否中文字符的标志
                $flag_chinese = false;

                $excelData = $worksheet->getCell($column.$row)->getValue();
                if(isset($excelData)){
                    $excelDataArr = $this->_mbStrSplit($excelData);
                    for($i=0;$i<count($excelDataArr);$i++){

                        if(strlen($excelDataArr[$i])!=1){

                            $excelDataArr[$i]=$this->_chToEng(asciiTran::strToAscii($excelDataArr[$i]));
                            $flag_chinese = true;
                        }
                    }
                    if($flag_chinese){
                        $excelDataStr = implode($excelDataArr);
                        $worksheet->getCell($column.$row)->setValue($excelDataStr);
                    }
                }
            }
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(MEDIA_PATH . 'export\excel\PO992993.xlsx');

        echo 'Successful!';
    }

    private function _mbStrSplit( $string )
    {
        # Split at all position not after the start: ^
        # and not before the end: $
        return preg_split('/(?<!^)(?!$)/u', $string );
    }


    // 中文字符转英文字符
    //3ACA:，
    //1A3A:。
    //1A6B:《
    //1A7B:》
    //3AFB:？
    //3ABB:；
    //3AAB:：
    //1AEA:‘
    //1A0B:“
    //1A2A:、
    //1AEB:【
    //1AFB:】
    //3ABF:｛
    //3ADF:｝
    //3A1A:！
    //3A4A:￥
    //1AFA:’
    //1A1B:”
    private function _chToEng($str){
        switch ($str){
            case '3ACA':
                $newStr = ',';
                break;
            case '1A3A':
                $newStr = '.';
                break;
            case '1A6B':
                $newStr = '<';
                break;
            case '1A7B':
                $newStr = '>';
                break;
            case '3AFB':
                $newStr = '?';
                break;
            case '3ABB':
                $newStr = ':';
                break;
            case '3AAB':
                $newStr = ':';
                break;
            case '1AEA':
            case '1AFA':
                $newStr = '\'';
                break;
            case '1A0B':
            case '1A1B':
                $newStr = '"';
                break;
            case '1A2A':
                $newStr = '\\';
                break;
            case '1AEB':
                $newStr = '[';
                break;
            case '1AFB':
                $newStr = ']';
                break;
            case '3ABF':
                $newStr = '{';
                break;
            case '3ADF':
                $newStr = '}';
                break;
            case '3A1A':
                $newStr = '!';
                break;
            case '3A4A':
                $newStr = '$';
                break;
            default:
                $newStr = '*';
        }
        return $newStr;
    }

}