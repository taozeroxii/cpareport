<?
/////////////////// เช็คเก็บข้อมูลผู้เข้าชม sql นั้นๆ เพื่อเก็บ session นับจำนวน view  //////////////////////////////
$useronline = session_id();
$userlogin = $_SESSION['username'];
if(isset($_SESSION['username'])==''||isset($_SESSION['username'])==null){ $userlogin='ผู้เยี่ยมชมทั่วไป';}

$time = time();
$datenow = date("Y-m-d H:i:s");
$sql2 = "SELECT * FROM viewer where session = '".$useronline."' AND sql_file = '$sql'";
$result2 = mysqli_query($con,$sql2);
$num = mysqli_num_rows($result2);
if($num > 0 && $userlogin='ผู้เยี่ยมชมทั่วไป'){
        $ud = ("UPDATE viewer set time_online = '" .$time. "',username = '".$userlogin."' where session = '".$useronline."'");
        $uf = mysqli_query($con, $ud);
        mysqli_query($con, $uf);
}
else{
    $insertlog = ("INSERT INTO viewer (session,username,sql_file,time_online,datetime) VALUES ('" . $useronline. "', '".$userlogin ."','" . $sql. " ',' " .$time. "' ,' " .$datenow. " ')");
    $Qinsertlog = mysqli_query($con, $insertlog);
}
$selectuserstatusonline = "select * from viewer where sql_file = '".$sql."'";
$Rsonline = mysqli_query($con,$selectuserstatusonline);
$countview = mysqli_num_rows($Rsonline);
?>