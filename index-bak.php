<?php

//header("content-type:text/html;charset=utf-8");

require 'vendor/autoload.php';
require 'bing/core/asciiTran.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use bing\core\asciiTran;

error_reporting(E_ALL);
//
//$spreadsheet = new Spreadsheet();
//$sheet = $spreadsheet->getActiveSheet();
//$sheet->setCellValue('A1', 'Hello World !');
//
//$writer = new Xlsx($spreadsheet);
//$writer->save('media\export\excel\hello world.xlsx');

$spreadsheet = IOFactory::load('media\upload\excel\Laige.xlsx');

//$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);

//分割字符串
function mb_str_split( $string ) {
    # Split at all position not after the start: ^
    # and not before the end: $
    return preg_split('/(?<!^)(?!$)/u', $string );
}


$worksheet = $spreadsheet->getActiveSheet();
$allColumn = $worksheet->getHighestColumn();


$allColumn++;
for ($column='A';$column!=$allColumn;$column++){
    $excelData = $worksheet->getCell($column.'1')->getValue();
    $excelDataArr = mb_str_split($excelData);
    foreach ($excelDataArr as $temp){
        echo $temp,':',asciiTran::strToAscii($temp),':',asciiTran::asciiToStr(asciiTran::strToAscii($temp)),'<br>';
    }
    var_dump($excelDataArr);
//    exit();
}



//$worksheet->getCell('A1')->setValue('John');
//$worksheet->getCell('A2')->setValue('Smith');
//
//$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
//$writer->save('media\export\excel\Laige.xls');

