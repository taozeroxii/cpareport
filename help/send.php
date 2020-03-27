<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!-- 	
	HOSXP
f4SqOeCfkgNJAmdJOA1U79xX8d6MANYdCoHcgaw7ePm

 	EAKTAMP
7aTisrKodM65FCJYUWm66SiwCBmPYIUba0oaaDlETtz 

 -->
 	
<?php
 header( "refresh: 0; url=index.php" );
	require_once("../config/my_con.class.php");
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

    $message_in 	= $_POST['message_in'];
    $message_out 	= $_POST['message_out'];
	$dateupdate 	= date('Y-m-d H:i:s');
   	$date_th 	    = DateThai($strDate);
    $admin_send 	= "admin";
    $ipupdate		= "8.8.8.8";

$sql = "INSERT INTO help_hosxp (message_in, message_out, admin_send,dateupdate,ipupdate) 
	    VALUES ('".$message_in."','".$message_out."','".$admin_send."','".$dateupdate."','".$ipupdate."')";
$query = mysqli_query($con,$sql);
	$line_api = 'https://notify-api.line.me/api/notify';
	$access_token = 'f4SqOeCfkgNJAmdJOA1U79xX8d6MANYdCoHcgaw7ePm';
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