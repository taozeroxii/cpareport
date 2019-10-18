<html>
<head>
<title>****************************************</title>
</head>
<body>
<form name="form1" method="post" action="" enctype="multipart/form-data">
	<input type="file" name="filUpload"><br>
	<input name="btnSubmit" type="submit" value="Submit">
</form>
</body>

<?php
	   $fname  = DATE('YmdHis').".jpg";
	  //$fname   = $_FILES["filUpload"]["name"];
	 // $fname   = $_FILES["filUpload"]["name"];

	if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"fileupload/".$fname))
	{
		echo "OK <br>";

		//*** Insert Record ***//
		$objConnect = mysql_connect("172.16.0.251","report","report") or die("Error Connect to Database");
		$objDB   = mysql_select_db("cpareportdb");

		$todate  = DATE('y-m-d H:i:s');
		$strSQL  = "INSERT INTO f43_imgdoc (name,file_name,type_img,status_id,dateupdate,text_b,text_c,text_h)"; 
		$strSQL .= "VALUES ('f43','".$fname."','OK','1','".$todate."','Y','Y','Y')";
		$objQuery = mysql_query($strSQL);		
	}
?>
<center><a href="/report/admin/f43/document.php">กลับ</a></center>
</body>
</html>