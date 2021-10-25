<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    include 'config/mysql_con.class.php';
    date_default_timezone_set('Asia/Bangkok');
    
    $eram       = $_POST['eram'];	
    $ehdd       = $_POST['ehdd'];	
    $epower     = $_POST['epower'];	
    $evga       = $_POST['evga'];	
    $edrive     = $_POST['edrive'];	
    $eupgrade   = $_POST['eupgrade'];	
    $eprinter   = $_POST['eprinter'];
    $ewin       = $_POST['ewin'];
    $com_id       = $_POST['ma_comid'];	
    $note_detail  = $_POST['ma_note'];  
    $userupdate   = $_POST['ma_userupdate'];  
    $dateupdate   = DATE('Y-m-d H:i:s');
  
 	$sql = " INSERT INTO com_ma (com_id,note_detail,userupdate,dateupdate,eram,ehdd,epower,evga,edrive,eupgrade,ewin,eprinter) 
    VALUES ('$com_id','$note_detail','$userupdate','$dateupdate','$eram','$ehdd','$epower','$evga','$edrive','$eupgrade','$ewin','$eprinter') ";
    
//echo $sql;


if (mysqli_query($con, $sql)) {
       echo "<script type=\"text/javascript\">";
       echo "alert(\"เพิ่มกิจกรรมข้อมูลสำเร็จ...\");";
       echo "location.href = 'com_detail.php';";
       echo "</script>";
       exit();

  }else {
      echo "<script type=\"text/javascript\">";
      echo "alert(\"ไม่สามารถเพิ่มกิจกรรมข้อมูลได้ กรุณาตรวจสอบ...\");";
      echo "location.href = 'com_detail.php';";
      echo "</script>";
      exit();

	}
 mysqli_close($con);

?>
    
    </body>
</html>