<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
  //  header('Content-Type: application/json');
    include 'config/mysql_con.class.php';
    date_default_timezone_set('Asia/Bangkok');
    
    $com_name       = $_POST['com_name'];
    $com_code       = $_POST['com_code'];
    $com_year       = $_POST['com_year'];
    $com_status     = $_POST['com_status'];
    $com_os_m       = $_POST['com_os_m'];
    $com_type       = $_POST['com_type'];
    $com_brand      = $_POST['com_brand'];
    $com_graphip    = $_POST['com_graphip'];
    $com_dvdrom     = $_POST['com_dvdrom'];
    $com_cpu_m      = $_POST['com_cpu_m'];
    $com_cpu        = $_POST['com_cpu'];
    $com_ghz        = $_POST['com_ghz'];
    $com_ram_m      = $_POST['com_ram_m'];
    $com_hdd_m      = $_POST['com_hdd_m'];
    $com_note       = $_POST['com_note'];	
    $com_userupdate = $_POST['com_userregis'];  
    
    $com_dateupdate   = DATE('Y-m-d H:i:s');
    $com_regisdate   =  DATE('Y-m-d H:i:s');

 	$sql = " INSERT INTO com_detail (com_name,com_code,com_year,com_status,com_os_m,com_type,com_brand,com_graphip,com_dvdrom,com_cpu_m,com_cpu,com_ghz,com_ram_m,com_hdd_m,com_note,com_dateupdate,com_userupdate,com_regisdate) 
	VALUES ('$com_name','$com_code','$com_year','$com_status','$com_os_m','$com_type','$com_brand','$com_graphip','$com_dvdrom','$com_cpu_m','$com_cpu','$com_ghz','$com_ram_m','$com_hdd_m','$com_note','$com_dateupdate','$com_userupdate','$com_regisdate') ";

if (mysqli_query($con, $sql)) {
       // echo json_encode(array("statusCode"=>200));
       echo "<script type=\"text/javascript\">";
       echo "alert(\"เพิ่มข้อมูลสำเร็จ...\");";
       echo "location.href = 'com_detail.php';";
       echo "</script>";
       exit();

  }else {
      //  echo json_encode(array("statusCode"=>201));
      echo "<script type=\"text/javascript\">";
      echo "alert(\"ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบ...\");";
      echo "location.href = 'com_detail.php';";
      echo "</script>";
      exit();

	}
 mysqli_close($con);

?>
    
    </body>
</html>