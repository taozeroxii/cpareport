<?php include("config.inc.php"); 
			$update = date("Y-m-d H:i:s");
			$name = $_POST["name"];
			$phone_num = $_POST["phone_num"];
			$nickname = $_POST["nickname"];
			$radios = $_POST["radios"];
			$phone_id = $_POST["phone_id"];
			
			$sql = "UPDATE  `phone_tbl` SET  
					`name` =  '$name',
					`phone_num` =  '$phone_num',
					`nickname` =  '$nickname',
					`type_id` =  '$radios',
					`update` =  '$update' 
					WHERE `phone_id` =$phone_id;";
			$query = mysql_query($sql);

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