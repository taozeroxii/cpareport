<?php
include('../config/my_con.class.php');
$s = $_GET['search_menu'];
$topLevelItems = " SELECT * FROM cpareport_menu WHERE menu_status = '1' AND menu_sub LIKE '%%$s%%'  ";
$res=mysqli_query($con,$topLevelItems);
?>

<!DOCTYPE html>
<html>

<head>
	<title>s_report.php</title>
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
	<style type="text/css">
		body{
			font-family: 'Kanit', sans-serif;
			background: #0B5345;
		}
		.aaa{
			width: 100%;
			padding: 1%;
			color: #fff;
			padding: 0.8%;
		}

		a:link {
			text-decoration: none;
			color: #fff;
		}

		a:visited {
			text-decoration: none;
			color: #fff;
		}

		a:hover {
			text-decoration: underline;
			color: #fff;
		}
		a:active {
			text-decoration: underline;
			color: #fff;
		}
		.search{
			width: 100%;
			text-align: center;
		}
		.button {
			background-color: #D35400; /* Green */
			border: 2px solid #000;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
		}
		input[type=text] {
			width:40%;
			box-sizing: border-box;
			border: 2px solid #000;
			border-radius: 4px;
			font-size: 16px;
			background-color: white;
			background-image: url('searchicon.png');
			background-position: 10px 10px; 
			background-repeat: no-repeat;
			padding: 12px 20px 12px 40px;
			-webkit-transition: width 0.s ease-in-out;
			transition: width 0.4s ease-in-out;
		}

		input[type=text]:focus {
			width: 20%;
		}
		.rw{
			color: #D35400;
		</style>
	</head>
	<body>

		<div class="search">
			<form action="" name="s" id="s" method="get">
				<input type="text" placeholder=" ! ค้นหารายงาน... " name="search_menu">
				<button class="button" type="submit">ค้นหารายงานที่ต้องการแก้ไข</button>
			</form>
		</div>
		<hr>
		<div class="container">
			<div class="claimHead col-md-12">
				<div class="submitHeader">
					<!-- <h1 style="font-size: 36px;">รายการคำที่ค้นหารายงานของคุณคือ - - >   <span class="sss"><?php //echo $s; ?></span></h1> -->
					<!-- <p style="font-size: 18px;">Report Search...</p> -->
				</div>


				<?php
				$rw==0;
				foreach($res as $item) {
					$rw++;	
					$mk    = $item['menu_link'];
					$mf    = $item['menu_file'];
					$ms    = $item['menu_sub'];
					$title = "Edit SQL Report";
					$sqlup = "sqlupdate.php";
					$link_mk =   " <a href=".$sqlup."?sql=".$mf." title=".$title.">".$ms."</a> ";
					?>

					<div id="aaa">
						<div class="bbb">
							<div class="ccc" id="stepOne" title="<?php echo $title ;?>"><?php echo "<span class='rw'> ".$rw.". </span> ".$link_mk; ?>

						</div>
					</div>
				</div>
			</div>
		</div>















		<?php 
	}
	?>

















</body>
</html>