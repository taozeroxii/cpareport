<?php
include('../config/my_con.class.php');
$s = "" ??   $_GET['search_menu'];
$topLevelItems = " SELECT * FROM cpareport_menu WHERE menu_status in ('1','2') and menu_sub LIKE '%%$s%%'  ";
$res = mysqli_query($con, $topLevelItems);
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/DT_bst.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bst.min.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<script src="js/j182.js"></script>
	<script src="js/j-dtb.js"></script>
	<script src="js/DT_bst.js"></script>
	<title>s_report.php</title>
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
	<style type="text/css">
		body {
			background: #0B5345;
		}

		@media screen and (min-width: 320px),
		print and (min-width: 320px) {
			.aaa {
				margin-left: 3%;
				margin-right: -32px;
				width: 100%;
				color: #fff;
				display: inline-block;
			}
		}

		@media screen and (min-width: 568px),
		print and (min-width: 568px) {
			.aaa {
				margin-left: 3%;
				margin-right: -32px;
				width: 50%;
				color: #fff;
				display: inline-block;
			}
		}


		@media screen and (min-width: 1000px),
		print and (min-width: 1000px) {
			.aaa {
				margin-left: 3%;
				margin-right: -25px;
				width: 30%;
				color: #fff;
				display: inline-block;
			}

		}


		@media screen and (min-width: 1200px),
		print and (min-width: 1200px) {
			.aaa {
				margin-left: 3%;
				margin-right: -32px;
				width: 15%;
				color: #fff;
				display: inline-block;
			}
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

		.search {
			width: 100%;
			text-align: center;
		}

		.button {
			background-color: #D35400;
			/* Green */
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin-top: -10px;
			border-radius: 8px;
			box-shadow: 5px 7px black;
		}


		input[type=text] {
			width: 40%;
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

		.rw {
			color: #D35400;
		}

		a.statuscolor1 {
			color: white;
		}

		a.statuscolor2 {
			color: red;
		}
	</style>

</head>

<body>
	<?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
		echo "<script>window.location ='../login.php';</script>";
	} ?>

	<?php include "menu.php"; ?>
	<div class="search">
		<form action="" name="s" id="s" method="get">
			<input type="text" placeholder=" ! ค้นหารายงาน... " name="search_menu">
			<button class="button" type="submit">ค้นหารายงานที่ต้องการแก้ไข</button>
		</form>
	</div>
	<hr>

	<div class="container-fulid">
		<?php
		$rw = "" ?? $rw  == 0;

		foreach ($res as $item) {
			$rw++;
			$mk    = $item['menu_link'];
			$mf    = $item['menu_file'];
			$ms    = $item['menu_sub'];
			$menustatus  = $item['menu_status'];
			$title = "Edit SQL Report";
			$sqlup = "sqlupdate.php";
			if ($menustatus == '1') {
				$statuscolor = 'statuscolor1';
			} else $statuscolor = 'statuscolor2';
			$link_mk =   " <a class = '$statuscolor' target='_blank'  href=" . $sqlup . "?sql=" . $mf . " title=" . $title . ">" . $ms . "</a> ";
		?>
			<div class="aaa">

				<div title="<?php echo $title; ?>"><?php echo "<span class='rw'> " . $rw . ". </span> " . $link_mk; ?></div>
			</div>
		<?php }
		?>
	</div>
	<hr>
</body>

</html>