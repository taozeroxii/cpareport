<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!-- 	
 	EAKTAMP
7aTisrKodM65FCJYUWm66SiwCBmPYIUba0oaaDlETtz 
 -->
 	
<?php
    header('Content-Type: text/html; charset=utf-8');
  //header( "refresh: 0; url=index.php" );
	//require_once("../config/my_con.class.php");
	date_default_timezone_set("Asia/Bangkok");
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}	
/*
    $message_in 	= $_POST['message_in'];
    $message_out 	= $_POST['message_out'];
	$dateupdate 	= date('Y-m-d H:i:s');
   	$date_th 	    = DateThai($strDate);
    $admin_send 	= "admin";
    $ipupdate		= "8.8.8.8";
*/



// $message_out .= '1 :  '."\n";

$message_out .=  'ลำดับ | รายการ  | วันนี้  | ย้อนหลัง1 |  ย้อนหลัง2 |  ย้อนหลัง3 |  ย้อนหลัง4 | ย้อนหลัง5 '."\n";
$message_out .=  '1	ผู้รับบริการผู้ป่วยนอก OPD	1023	220	271	890	1038'."\n";
$message_out .=  '2	คลินิกระบบทางเดินหายใจ (ARI Clinic)	53	0	0	60	69'."\n";
$message_out .=  '3	คลินิกระบบทางเดินหายใจ ( ช่วงอายุ น้อยกว่าหรือเท่ากับ 15 ปี)	2	0	0	2	4'."\n";
$message_out .=  '4	คลินิกระบบทางเดินหายใจ (ช่วงอายุ มากกว่า 15 ปี)	51	0	0	57	65'."\n";
$message_out .=  '5	ผู้ป่วย Admit	35	56	53	64	75'."\n";
$message_out .=  '6	ผู้ป่วย จำหน่าย	34	56	63	81	78'."\n";
$message_out .=  '7	ผู้รับบริการ ผ่าตัด	14	7	9	8	12'."\n";
$message_out .=  '8	ผู้รับบริการ ทันตกรรม	24	0	0	35	23'."\n";
$message_out .=  '9	Refer_in (รับเข้า)	48	8	11	52	70'."\n";
$message_out .=  '10	Refer_out (ส่งต่อ)	23	4	5	21	13'."\n";

/*
$sql = "INSERT INTO help_hosxp (message_in, message_out, admin_send,dateupdate,ipupdate) 
	    VALUES ('".$message_in."','".$message_out."','".$admin_send."','".$dateupdate."','".$ipupdate."')";
$query = mysqli_query($con,$sql);
*/
	$line_api = 'https://notify-api.line.me/api/notify';
	$access_token = '7aTisrKodM65FCJYUWm66SiwCBmPYIUba0oaaDlETtz';
	$str 		=	$message_out;
	$image_thumbnail_url = ''; 
	$image_fullsize_url = ''; 
	$message_data = array(
 'message' => $str,
 'imageThumbnail' => $image_thumbnail_url,
 'imageFullsize' => $image_fullsize_url,
);
$result = send_notify_message($line_api, $access_token, $message_data);
print_r($result);

function send_notify_message($line_api, $access_token, $message_data)
{
 $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$access_token );
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $line_api);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $result = curl_exec($ch);
 if(curl_error($ch))
 {
 }
 else
 {
 }
 curl_close($ch);
 return $return_array;
}
?>

 </body>
</html>