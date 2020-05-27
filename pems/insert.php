<!DOCTYPE html>
<html>

<head>
  <title></title>
</head>

<body>
  <?php
  date_default_timezone_set("Asia/Bangkok");
  include("config/my_con.class.php");

  $hn        = $_POST['hn'];
  $cid       = $_POST['cid'];
  $fname     = $_POST['fname'];
  $lname     = $_POST['lname'];
  $phone     = $_POST['phone'];
  $pttype    = $_POST['pttype'];
 // $lineid    = $_POST['lineid'];
  $adddess   = $_POST['adddess'];
  $moo       = $_POST['moo'];
  $district  = $_POST['district'];
  $amphoe    = $_POST['amphoe'];
  $province  = $_POST['province'];
  $zipcode   = $_POST['zipcode'];
  //$qcode     = ""; 
  //$keycode   = "";
  //$modify    = "";
  //$status    = "1";
  $flage     = "1";
  //$fileimg   = "";
  $dateupdate = DATE('Y-m-d H:i:s');
  $ipupdate   = $_SERVER['REMOTE_ADDR'];
  $cdate    = DATE('Y-m-d');
  $ctime    = DATE('H:i:s');

  $searchuser = "SELECT * FROM web_data_patient_pems where cid = '" . $cid . "'  ";
  $have_user_yet = mysqli_query($con, $searchuser);
  $count = mysqli_num_rows($have_user_yet);

  if ($count > 0) {
    echo    $log = "UPDATE  web_data_patient_pems SET hn = '$hn',cid = '$cid',fname = '$fname',lname = '$lname',phone='$phone'
       ,pttype='$pttype',adddess='$adddess',moo='$moo',district='$district',amphoe='$amphoe',province='$province'
       ,zipcode='$zipcode',flage='$flage',dateupdate='$dateupdate',ipupdate='$ipupdate',cdate='$cdate',ctime='$ctime'
      WHERE cid = '$cid'";
    $query = mysqli_query($con, $log);
    //header("Location: app.php?cid=$cid&hn=$hn");
    header("Location: complete.php"); //เอาค่า params ที่ส่งไปออกเพื่อให้ link clean ขึ้น
    mysqli_close($con);
  } else {
    $log = "INSERT INTO web_data_patient_pems (hn,cid,fname,lname,phone,pttype,adddess,moo,district,amphoe,province,zipcode,flage,dateupdate,ipupdate,cdate,ctime) 
                    VALUES ('$hn','$cid','$fname','$lname','$phone','$pttype','$adddess','$moo','$district','$amphoe','$province','$zipcode','$flage','$dateupdate','$ipupdate','$cdate','$ctime')";
    $query = mysqli_query($con, $log);
    header("Location: complete.php");
    mysqli_close($con);
  }

  ?>
</body>

</html>