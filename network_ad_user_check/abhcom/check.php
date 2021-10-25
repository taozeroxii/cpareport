<?php
	session_start();
	include "config/mysql_con.class.php";
	

	$time = date('Y-m-d H:i:s');
	$ip   = $_SERVER['REMOTE_ADDR'];

    $username   = mysqli_real_escape_string($con,$_POST['username']);
    $password   = MD5(mysqli_real_escape_string($con,$_POST['password']));
    $token      = MD5(mysqli_real_escape_string($con,$_POST['username']));
	$strSQL = " SELECT * 
               FROM com_admin 
               WHERE 1 = 1
               AND username = '$username'
               AND password = '$password' 
               AND authun_key = '$token' ";

$objQuery  = mysqli_query($con, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);

	if(!$objResult)
	{
        echo "<script language=\"javascript\">
        alert(\"อย่ามั่วสิครับ มีสิทธิ์หรือป่าวครับ คิดดี ๆ ลองนึกดูว่าใช้ User อะไรครับ หรือ รหัสผิดป่าว\\n \");
        window.location='login.html';
        </script>";
        
	}
	else
	{
			$_SESSION["id"] = $objResult["id"];
			$_SESSION["status_group"] = $objResult["status_group"];

			session_write_close();
			
			if($objResult["status_group"] == "Y")
			{
				$log = "INSERT INTO com_log_admin (useradmin,logintime,iplog) 
				VALUES ('$username','$time','$ip')";
				$query = mysqli_query($con,$log);
				header("location:com_detail.php");
			}
			else
			{
				header("location:login.html");
			}
	}
?>