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
			color: black;

		}

		.www {
			text-align: center;
		}
	</style>

</head>

<body>
	<?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
		echo "<script>window.location ='../login.php';</script>";
	}

	if (isset($_POST['submit'])) {
		//echo $_POST['code'];
		$update = "UPDATE  cpareport_sql  SET sql_code = '" . addslashes($_POST['code']) . "' where sql_file =  '" . $_POST['file_sql'] . "' ";
		$Qupdate = mysqli_query($con, $update);
		$Indate = date("Y-m-d H:i:s");
		$insertlog = "INSERT INTO sqlupdate_log (sql_edit_user,sql_file,old_sql,new_sql,update_datetime)
        VALUES ('" . $_SESSION['username'] . "'
        ,'" . $_POST['file_sql'] . "'
        ,'" . addslashes($_POST["old_code"]) . "'
        ,'" . addslashes($_POST["code"]) . "'
        ,'" . $Indate . "'
		)";
		$Qinsertlog = mysqli_query($con, $insertlog);

		if ($Qupdate) {
			//echo "<script>alert('แก้ไขเรียบร้อย');window.close();</script>";
		} else  
            if ($Qupdate) {
			echo "<script>alert('queryInsert ผิดพลาด');window.location=sqlupdate.php;</script>";
		}
	}

	?>


	<div class="container border">
		<?php
		foreach ($res as $item);
		$code =  $item['sql_code'];
		?>

		<div class="hhh">
			<marquee direction="down"><span></span></marquee>
			<?php echo "ชุดคำสั่งที่ " . $item['sql_file'] . " | รายงาน | " . $item['sql_head'];
			$file =  $item['sql_file'] ?>
			<a href='javascript:if(confirm("ต้องการปิดหน้านี้หรือไม่?"))self.close( )' style="float:right"><button class="btn btn-outline-danger">X</button></a>
		</div>
		<hr>

		<div class="www border">
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
		<div class="row">
			<div class="col-12">
				<div class="btnbar" style="float:right">
					<button class="btn btn-primary" onclick="myFunction()">คัดลอก S Q L</button>
					<button class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-xl">log</button>
				</div>
			</div>
		</div>

		<div class="search">
			<form action="#" name="s" id="s" method="POST">
				<textarea style="background: black;color:white" class="input-group" rows="25" cols="100" name="code" id="sql" value=""><?php echo $code; ?></textarea>
				<input type="hidden" name="old_code" value="<? echo $code ?>">
				<input type="hidden" name="file_sql" value="<? echo $file ?>">
				<br>
				<div class="row">
					<div class="col-12"><button name="submit" class="btn btn-success btn-block" type="submit" value="submit">แก้ไข</button></div>
				</div>
			</form>
		</div>


		<!-- Modal -->
		<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">ประวัติการแก้ไข</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table">
							<th>ผู้แก้ไข</th>
							<th>sql-file</th>
							<th>sql เก่า</th>
							<th>sql ใหม่</th>
							<th>วัน-เวลา</th>



						</table>
					</div>
				</div>
			</div>
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