<?php
include('../config/my_con.class.php');
$s = $_GET['search_menu'];
$topLevelItems = " SELECT * FROM cpareport_menu WHERE menu_status in ('1','2') and menu_sub LIKE '%%$s%%'  ";
$res = mysqli_query($con, $topLevelItems);
 session_start(); 
 ?>
<?php
require_once("../config/my_con.class.php");
date_default_timezone_set("Asia/Bangkok");
function DateThai($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}
$strDate = date('Y/m/d');
$show 	 = DateThai($strDate);
$sql  = " SELECT * FROM help_hosxp ORDER BY id DESC LIMIT 1; ";
$query = mysqli_query($con,$sql);  
$row  = mysqli_fetch_array($query);

$message_in 		=	$row['message_in'];
$message_out 		=	$row['message_out'];
$admin_send 		=	$row['admin_send'];
$dateupdate 		=	$row['dateupdate'];
$id 				=	$row['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LINE ADMIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style type="text/css">
		.color-a{
			color: #2F58CE;
			font-weight: bold;
		}
		.color-b{
			color: #7D3C98;
		}		
		.s1{
			color: #0E6655;
		}
		.s2{
			color: #CF4006;
		}
	</style>
</head>
<body>
	<?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
		echo "<script>window.location ='../login.php';</script>";
	} ?>
	<div class="container-contact100" style="background-image: url('images/bg-01.jpg');">
		<div class="wrap-contact100">

			<form class="contact100-form validate-form" name="send" id="send" action="send.php" method="post">
				<span class="contact100-form-title">
					Admin Help HosXp | <?php echo $show; ?>
				</span>		
				<div class="color-a" title="รายการที่แจ้งปัญหาล่าสุด | และรายการตอบปัญหาล่าสุด ">
					<?php echo "<u>รายการล่าสุด</u> : ".$id." : ".$message_in." |<span class='s1'> ".$message_out ?></span></div>
				<div class="color-b" title="ผู้ตอบรายการปัญหาล่าสุด | และวันเวลาการตอบปัญหาล่าสุด ">
					<?php echo " | ".$admin_send." |<span class='s2'> ".$dateupdate ?></span></div>
				<hr>
<!-- 
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Tell us your name *</span>
					<input class="input100" type="text" name="name" placeholder="Enter your name">
				</div> -->

				<!-- <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Enter your email *</span>
					<input class="input100" type="text" name="email" placeholder="Enter your email">
				</div> -->

				<!-- <div class="wrap-input100">
					<span class="label-input100">Your Website</span>
					<input class="input100" type="text" name="web" placeholder="http://">
				</div> -->
				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">ปัญหาที่เกิด (แจ้งใน Group Line HOSxP)</span>
					<textarea class="input100" name="message_in" id="message_in" placeholder="คัดลอกรายการที่มีการแจ้งปัญหาทาง Line Group HosXp "></textarea>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">แสดงความคิดเห็นของ Admin</span>
					<textarea class="input100" name="message_out" id="message_out" placeholder="ตอบปัญหาที่แจ้งมา หรือ ใส่ link วิธีการแก้ไขปัญหาหรือรายละเอียดการแก้ไข"></textarea>
				</div>
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							ส่งข้อความ
						</button>
					</div>
				</div>
			</form>
		</div>
		<span class="contact100-more">
			Call Notify Line HosXp Group.
		</span>
	</div>
	<div id="dropDownSelect1"></div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>
