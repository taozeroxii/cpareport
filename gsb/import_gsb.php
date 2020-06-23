<?php
set_time_limit(0); 
header('Content-Type: text/html; charset=utf-8');

$mysqli = new mysqli('172.16.0.251','report','report','cpareportdb');
if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

$inputFileName="excelfile/filename.xlsx";

require_once 'PHPExcel/Classes/PHPExcel.php';

include 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}
foreach ($namedDataArray as $resx) {
 //Insert
  $query = " INSERT INTO gsb_datacheck_import (gsb_id,gsb_personid,pname,fname,lname,gsb_cid,gsb_startdate,gsb_perstatus,gsb_emp_type,gsb_enddate,gsb_age,gsb_groupname) VALUES
      (
       '".$resx['gsb_id']."',
       '".$resx['gsb_personid']."',
       '".$resx['pname']."',
       '".$resx['fname']."',
       '".$resx['lname']."',
       '".$resx['gsb_cid']."',
       '".$resx['gsb_startdate']."',
       '".$resx['gsb_perstatus']."',
       '".$resx['gsb_emp_type']."',
       '".$resx['gsb_enddate']."',
       '".$resx['gsb_age']."',
       '".$resx['gsb_groupname']."'
      );";
  $res_i = $mysqli->query($query);
  echo $query;
}
$mysqli->close();
?>