<?php include("config.inc.php"); 
$i=1;
	while($i<=$_POST['amounth']) {
			$update = date("Y-m-d H:i:s");
			$name = $_POST["name$i"];
			$phone_num = $_POST["phone_num$i"];
			$nickname = $_POST["nickname$i"];
			$radios = $_POST["radios$i"];
			
			
			$sql = "INSERT INTO `phone_tbl` (`phone_id`, `name`, `phone_num`, `nickname`, `type_id`, `update`) VALUES 
					   (NULL, '$name', '$phone_num', '$nickname', '$radios', '$update');";
					  // echo $sql;
			$query = mysql_query($sql);
			
			$i++;
}
			echo "<meta http-equiv='refresh' content='0;url=index.php'>";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">


<title>บันทึกสำเร็จ</title>
</head>

<body>

</body>
</html>