<?php
// require file autoload.php di dalam folder vendor
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// mengisi cell A1 dengan text Hello World !
$sheet->setCellValue('A1', 'Hello World !');
 
$writer = new Xlsx($spreadsheet);
//nama file yang tersimpan
$writer->save('hello world.xlsx');
?>