<?php
$connection = mysql_connect("172.18.2.2", "webcvhost", "WebCpa10665Hos!");
$db = mysql_select_db("cpa19db", $connection); 

$hn             = $_POST['hn'];
$pname          = $_POST['pname'];
$fname          = $_POST['fname'];
$lname          = $_POST['lname'];
$cid            = $_POST['cid'];
$pttype         = $_POST['pttype'];
$phone          = $_POST['phone'];
$adddess        = $_POST['adddess'];
$moo            = $_POST['moo'];
$district       = $_POST['district'];
$amphoe         = $_POST['amphoe'];
$province       = $_POST['province'];
$zipcode        = $_POST['zipcode'];
$flage          = "1";
$birthday       = $_POST['birthday'];
$dateupdate     = date('Y-m-d H:i:s');
$full_name      = $_POST['full_name'];

$query = mysql_query(" INSERT INTO patient (hn,pname,fname,lname,cid,pttype,phone,adddess,moo,district,amphoe,province,zipcode,flage,birthday,dateupdate,full_name) 
values ('$hn','$pname','$fname','$lname','$cid','$pttype','$phone','$adddess','$moo','$district','$amphoe','$province','$zipcode','$flage','$birthday','$dateupdate','$full_name')");

echo "Succesfully";
mysql_close($connection); 


?>

