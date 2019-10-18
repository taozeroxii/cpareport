<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<center><font size="10px">Update รูปภาพในการเก็บข้อมูล</font></center>
<P>
</P>
<P>
<body background="p_750485.jpg"  align ="center" >
<center> <form name="form1" method="post" action="index.php" enctype="multipart/form-data">
   <input type="file" name="file">
   <input type="submit" name="Submit" value="Upload now">
 </form>
</center>
</P>
<?
if($_POST[Submit]){
 set_time_limit(3000);

  //set up basic connection
 $ftp_server = "172.16.0.251";
 $ftp_user_name = "report";
 $ftp_user_pass = "report";

 $destination_file = $_FILES['file']['name'];
 $source_file = $_FILES['file']['tmp_name'];
 $size_file=$_FILES['file']['size'];

 $conn_id = ftp_connect($ftp_server);
 
 
 // login with username and password
 $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

 //ftp_chdir($conn_id,"upcscd/cscdup");



   // check connection  
 if ((!$conn_id) || (!$login_result)) {
     echo "FTP connection has failed!";
     echo "Attempted to connect to $ftp_server for user $ftp_user_name";
     exit;
 } else {
     echo " ทำรายการ Upload File Connected For User $ftp_user_name เรียนร้อยแล้ว<br/>";     }      

// upload the file  
 $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);    

// check upload status  
 if (!$upload) {
     echo "ไม่สามารถ  Upload  ได้ มี File นี้ในระบบแล้ว : FTP upload has failed!";
  }    

// close the FTP stream  
ftp_close($conn_id);}//end $_POST[Submit]



if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"],"myfile/".$_FILES["fileUpload"]["name"])) // Upload/Copy
{

//*** Insert Record ***//
    $objConnect = mysql_connect("172.16.0.251","report","report") or die("Error Connect to Database");
    $objDB = mysql_select_db("cpareportdb",$objConnect);
    mysql_query("SET character_set_results=utf8");
    mysql_query("SET character_set_client=utf8");
    mysql_query("SET character_set_connection=utf8");
    
    $strSQL = "INSERT INTO `work`.`work_du_file`";
    $strSQL .="(`file_du_name`, `tag_du_id`, `file_du_detail`, `last_update`) VALUES ('".$_FILES["fileUpload"]["name"]."','".$_REQUEST["tag_du_id"]."','".$_POST["file_du_detail"]."',NOW())";
    $objQuery = mysql_query($strSQL) or die(mysql_error()); 
    
    // if($objQuery){
    //   echo "<script>alert('เพิ่มไฟล์เรียบร้อย');window.location=\"tag_details_durable.php?tag_du_id=$_POST[tag_du_id]\";</script>";
    // } else {
    //   echo 'ไม่สามารถเพิ่มข้ขอมูลได้!!!!!!!';
    // }
  }
?>
