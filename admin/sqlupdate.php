<?php
include('../config/my_con.class.php');
$s = $_GET['sql'];
$topLevelItems = " SELECT * FROM cpareport_sql WHERE sql_file = '".$s."'  ";
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
			/*background: #000;*/
			/*color: #A93226;*/
			background-image: url("img/giphy.gif");
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
		.button1 {
			background-color: #0519C1;
			border: 2px solid #0DE931;
			border: none;
			color: #0DE931;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			cursor: pointer;
			border-radius: 2px;
			font-weight: bold;

		}
		.button1:hover {
			background-color: #5DADE2; 
			border: 2px solid #000;
			border: none;
			color: #E40E0E;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			cursor: pointer;
			font-weight: bold;
			border-radius: 2px;
			font-weight: bold;
		}
		.button {
			background-color: #A006AA; 
			border: 2px solid #E40E0E;
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
		.tx{
			font-weight: bold;
			color: #1D8348;
			background: #000;
			font-size: 1.8em;
		}
		.aaa{
			color: #C0392B;
			font-weight: bold;
			text-align: center;
		}
		.bbb{
			color: #E40E0E;
			font-size: 1.4em;
			font-weight: bold;
		}
		.hhh{
			text-align: center;
			font-weight: bold;
			font-size: 1.2em;
			color: #E40E0E;
			/*background:#F8F1F9;*/
		}
		.www{
			background:#F8F1F9;
			text-align: center;
		}
		.c{
			font-weight: bold;
			color: #E40E0E;
		}
	</style>

</head>
<body>
	<?php
	foreach($res as $item);
	$code =  $item['sql_code'];
	?>
	<div class="hhh">
		<marquee direction="down"><span>
		</span></marquee>
		<button class="button1" onclick="myFunction()">คัดลอก S Q L</button>
		<?php echo "ชุดคำสั่งที่ ".$item['sql_file']." | รายงาย | ".$item['sql_head']; ?>  

	</div>
	<hr>
	<div class="www">
		<span class="aaa" >* Parameter NOT : </span>
		<span class="c">{datepickers} AND {datepickert} </span>
		<span class="bbb" >	| </span>
		<span class="c" >	{diag_1} AND {diag_2} </span>
		<span class="bbb" >	| </span>
		<span class="c" >	{time_in} AND {time_out} </span>
		<span class="bbb" >	| </span>
		<span class="c" >	{number_start} AND {number_end} </span>
		<span class="bbb" >	|</span>
		<span class="c" >	{c_ward} </span>
		<span class="bbb" >	|</span>
		<span class="c" >	{staff} </span>
		<span class="bbb" >	|</span>
		<span class="c" >	{c_department} </span>
		<span class="bbb" >	|</span>
		<span class="c" >	{user_k} </span>
		<span class="bbb" >	|</span>
		<span class="c" >	{icd_dropdown} </span>
		<span class="bbb" >	|</span>
		<span class="c" >	{c_department[]} </span>
	</span>
</div>
<hr>
<div class="search">
	<form action="" name="s" id="s" method="get">
		<textarea class="tx" rows="25" cols="100" name="sql" id="sql" value=""><?php echo $code; ?></textarea>
		<br>
		<button class="button" type="submit">Update</button>

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

</body>
</html>