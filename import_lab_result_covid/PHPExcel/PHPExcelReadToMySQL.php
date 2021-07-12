<a href="../">ย้อนกลับ กลับหน้าแรก</a>
้
<hr>
<?php
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';

$datetime = date("Ymd");
$inputFileName = "./uploads/myDatas" . $datetime . ".xls";
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setReadDataOnly(true);
$objPHPExcel = $objReader->load($inputFileName);

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
	$dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
	if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
		++$r;
		foreach ($headingsArray as $columnKey => $columnHeading) {
			$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
		}
	}
}

//echo '<pre>';
//var_dump($namedDataArray);
//echo '</pre><hr />';

//*** Connect to MySQL Database ***//
$objConnect = mysql_connect("172.18.2.2", "webcvhost", "WebCpa10665Hos!") or die(mysql_error());
$objDB = mysql_select_db("lab_rs_covid_19");
mysql_query('TRUNCATE TABLE lab_result;') or die(mysql_error()); // เครียข้อมูลเก่าทั้งหมด
$i = 0;
foreach ($namedDataArray as $result) {
	$i++;
	$strSQL = "";
	$strSQL .= "INSERT INTO lab_result ";
	$strSQL .= "(vn_lab,send_department,recieve_department,objective,cid,sent_date,status,passport,birth,pre_name,name,lname,name_eng,lname_eng,collection_date,results,results_date,approve_results,approve_date,remark) ";
	$strSQL .= "VALUES ";
	$strSQL .= "('" . $result["vn_lab"] . "','" . $result["send_department"] . "' ";
	$strSQL .= ",'" . $result["recieve_department"] . "','" . $result["objective"] . "' ";
	$strSQL .= ",'" . $result["cid"] . "','" . $result["sent_date"] . "','" . $result["status"] . "','" . $result["passport"] . "','" . $result["birth"] . "' ";
	$strSQL .= ",'" . $result["pre_name"] . "','" . $result["name"] . "','" . $result["lname"] . "','" . $result["name_eng"] . "','" . $result["lname_eng"] . "' ";
	$strSQL .= ",'" . $result["collection_date"] . "','" . $result["results"] . "','" . $result["results_date"] . "','" . $result["approve_results"] . "','" . $result["approve_date"] . "' ";
	$strSQL .= ",'" . $result["remark"] . "') ";
	mysql_query($strSQL) or die(mysql_error());
	// echo $strSQL;
	echo "Row $i Inserted...<br>";
}
mysql_close($objConnect);
?>