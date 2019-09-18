<?php
date_default_timezone_set("Asia/Bangkok");
function thaiDate($datetime)
{
	if(!is_null($datetime))
	{
		list($date,$time) = split('T',$datetime);
		list($Y,$m,$d) = split('-',$date);
		$Y = $Y+543;
		switch($m)
		{
			case "01":$m = "ม.ค."; break;
			case "02":$m = "ก.พ."; break;
			case "03":$m = "มี.ค."; break;
			case "04":$m = "เม.ย."; break;
			case "05":$m = "พ.ค."; break;
			case "06":$m = "มิ.ย."; break;
			case "07":$m = "ก.ค."; break;
			case "08":$m = "ส.ค."; break;
			case "09":$m = "ก.ย."; break;
			case "10":$m = "ต.ค."; break;
			case "11":$m = "พ.ย."; break;
			case "12":$m = "ธ.ค."; break;
		}
		return $d." ".$m." ".$Y."";
	}
	return "";
}

$DATABASE_HOST = '172.16.0.251';
$DATABASE_USER = 'report';
$DATABASE_PASS = 'report';
$DATABASE_NAME = 'cpareportdb';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
mysqli_set_charset($con,"utf8");
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// $stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// $stmt->bind_param('i', $_SESSION['id']);
// $stmt->execute();
// $stmt->bind_result($password, $email);
// $stmt->fetch();
// $stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>  จำด</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/css.login.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1>  </h1>
			<!-- <a href="#" title="ผู้ใช้งาน"><i class="fas fa-user-circle"></i><?=$_SESSION['name']?></a> -->
			<!-- <a href="logout.php" title="ออกจากระบบ"><i class="fas fa-sign-out-alt"></i>Logout</a> -->
		</div>
	</nav>
	<div class="content">
		<h2>     </h2>
		<div>
			<!-- <p><span class="warning"> * </span>  </p> -->
			<?php

			$sql = " SELECT m.menu_sub,m.menu_link,m.menu_file,s.sql_file,s.sql_code
			FROM cpareport_menu as m 
			INNER JOIN cpareport_sql as s on s.sql_file = m.menu_file ";
			$stmt = $con->prepare($sql);
			$stmt ->execute();
			$result = $stmt->get_result();
			?>
			<table width="100%;">
				<tr >
					<th class="td-c">ชื่อรายการ</th>
					<th class="td-c">ชื่อฟอร์ม</th>
					<th class="td-c">ชุดคำสั่ง</th>
					<th class="td-c">แก้ไขโค้ด SQL หลัก</th>
				</tr>
				<?php


				while ($row = $result->fetch_assoc()) 
				{
					$menu_sub 		= $row["menu_sub"];
					$menu_link 		= $row["menu_link"];
					$menu_file		= $row["menu_file"];
					$sql_file		= $row["sql_file"];
					$sql_code		= $row["sql_code"];

					?>
					<tr>
						<td class=""><?php echo $row["menu_sub"]; ?></td>
						<td class=""><?php echo $row["menu_link"]; ?></td>
						<td><?php echo $row["sql_file"]; ?></td>
						<td class="td-c">
							<a href="" title="คลิกเพื่อให้แสดงหน้าเว็บ" data-toggle="modal" data-target="#myModal" onclick="getid('<?php echo $sql_file;?>','<?php echo $sql_code;?>')">
								<img src="img/checklist-icon.png" class="png">
							</a>
						</td> 
					</tr>
					<?php	
				}
				$con->close();
				?>	
			</table>

		</div>
	</div>
</body>
</html>


<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title cen">************ : <span id="sql_file"></span>  ประเภท : <span id="sql_file"></span></h4>
			</div>
			<div class="modal-body">
				<div id="detail"></div>
				<hr>
				<center>
					<div class="form-group">	
						<form name="update_status" id="update_status" action="" method="POST">
							<input type="text" name="sqlcode" id="sqlcode">
							<input type="submit" class="btn" id="update_comp" name="update_comp" value="แก้ไขโค้ด">
						</form>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function getid(sql_file){
		$("#sql_file").html(sql_file);
		//$("#id_p").html(group_name);
		//$("#detail").html(detail);
		//$("#id").val(id);
	}

	// $(document).ready(function() {	
	// 	$("#update_comp").click(function() {	
	// 		$.ajax({
	// 			type: "POST",
	// 			url: "update.php",
	// 			data: $("#update_status").serialize(),
	// 			success: function(result)  {
	// 				console.log(result);
	// 				if(result.status == 1)
	// 				{
	// 					console.log(result);
	// 					alert(result.message); 
	// 					location.reload();
	// 				}
	// 				else
	// 				{
	// 					console.log(result);
	// 					alert(result.message);
	// 					location.reload();
	// 				}
	// 			}
	// 		});
	// 	});
	// });

</script>