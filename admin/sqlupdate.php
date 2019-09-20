<?php
include('../config/my_con.class.php');
$s = $_GET['sql'];
$topLevelItems = " SELECT * FROM cpareport_sql WHERE sql_file = '" . $s . "'  ";
$res = mysqli_query($con, $topLevelItems);
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>s_report.php</title>
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
	<style type="text/css">
		body {
			font-family: 'Kanit', sans-serif;
			/*background: #000;*/
			/*color: #A93226;*/

		}

		.aaa {

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

		.search {
			width: 100%;
			text-align: center;
		}

		.button1 {
			background-color: #1E90FF;
			border: 2px solid #0DE931;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 10px;
			cursor: pointer;
			border-radius: 15px 50px;
		}

		.button1:hover {
			background-color: #0000F1;
			border: 2px solid #0DE931;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 10px;
			cursor: pointer;
			font-weight: bold;
			border-radius: 15px 50px;
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

		.tx {
			color: white;
			background: #000;
			font-size: 100%;
		}

		.aaa {
			color: #C0392B;
			font-weight: bold;
			text-align: center;
		}

		.bbb {
			color: #E40E0E;
			font-size: 1.4em;
			font-weight: bold;
		}

		.hhh {
			text-align: center;
			font-weight: bold;
			font-size: 1.2em;
			color: GRAY;
			/*background:#F8F1F9;*/
		}

		.www {
			background: #F8F1F9;
			text-align: center;
		}

		.c {
			font-weight: bold;
			color: #E40E0E;
		}
	</style>

</head>

<body>
	<?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
		echo "<script>window.location ='../login.php';</script>";
	} ?>
	
	<div class="container">
		<?php
		foreach ($res as $item);
		$code =  $item['sql_code'];
		?>
		<div class="hhh">
			<marquee direction="down"><span>
				</span></marquee>
			<button class="button1" onclick="myFunction()">คัดลอก S Q L</button>
			<?php echo "ชุดคำสั่งที่ " . $item['sql_file'] . " | รายงาน | " . $item['sql_head']; ?>

		</div>
		<hr>
		<div class="www">
			<span class="aaa">* Parameter NOT : </span>
			<span class="c">{datepickers} AND {datepickert} </span>
			<span class="bbb"> | </span>
			<span class="c"> {diag_1} AND {diag_2} </span>
			<span class="bbb"> | </span>
			<span class="c"> {time_in} AND {time_out} </span>
			<span class="bbb"> | </span>
			<span class="c"> {number_start} AND {number_end} </span>
			<span class="bbb"> |</span>
			<span class="c"> {c_ward} </span>
			<span class="bbb"> |</span>
			<span class="c"> {staff} </span>
			<span class="bbb"> |</span>
			<span class="c"> {c_department} </span>
			<span class="bbb"> |</span>
			<span class="c"> {user_k} </span>
			<span class="bbb"> |</span>
			<span class="c"> {icd_dropdown} </span>
			<span class="bbb"> |</span>
			<span class="c"> {c_department[]} </span>
			</span>
		</div>
		<hr>
		<div class="search">
			<form action="" name="s" id="s" method="get">
				<textarea class="tx" rows="25" cols="100" name="sql" id="sql" value=""><?php echo $code; ?></textarea>
				<br>
				<div class="row">
					<div class="col-1"></div>
					<div class="col-10"><button class="btn btn-outline-success btn-block" type="submit">Update</button></div>
					<div class="col-1"></div>
				</div>
			

			</form>
		</div>

		<script>
			function myFunction() {
				var copyText = document.getElementById("sql");
				copyText.select();
				copyText.setSelectionRange(0, 99999)
				document.execCommand("copy");
				alert("Copied the text: " + copyText.value);
			}
		</script>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>