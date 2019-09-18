<?php
include('../config/my_con.class.php');
$s = $_GET['search_menu'];
$topLevelItems = " SELECT * FROM cpareport_sql  ";
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
		}
/*		#stepsContainer {
			text-align: center;
		}
		.claimSteps {
			width: 30%;
			padding: 0.3%;
			background-color: #D5D8DC;
			color: #FFF;
			text-align: left;
			border-style: solid;
			border-left-width: 340px;
			font-size: 1.6em;
		}
		.claimSteps:hover {
			width: 30%;
			padding: 0.3%;
			text-align: left;
			border-style: solid;
			border-left-width: 340px;
			font-size: 1.6em;
			cursor: pointer;
			background-color: #BFC9CA;
		}
		a:link {
			text-decoration: none;
		}

		a:visited {
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}

		a:active {
			text-decoration: underline;
		}
		.sss{
			font-size: 1.4;
			text-align: center;
			font-weight: bold;
			color: green;
		}	

.search{
	width: 100%;
	text-align: center;
}
.button {
  background-color: #4CAF50; 
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
  border: 2px solid #ccc;
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
}*/
	</style>

</head>



<body>

<!--  <div class="search">
        <form action="" name="s" id="s" method="get">
          <input type="text" placeholder=" ! ค้นหารายงาน... " name="search_menu">
          <button class="button" type="submit">ค้นหารายงาน</button>
        </form>
</div> -->
	<div class="container">
		<div class="claimHead col-md-12">
			<div class="submitHeader" style="margin-top: 60px; margin-bottom: 60px; margin-left: 30px;">
				<!-- <h1 style="font-size: 36px;">EDIT - - >   <span class="sss"><?php //echo $s; ?></span></h1> -->
				<!-- <p style="font-size: 18px;">Report Search...</p> -->
			</div>


			<?php
			foreach($res as $item) {
				// $mk    = $item['menu_link'];
				// $mf    = $item['menu_file'];
				// $ms    = $item['menu_sub'];
				// $title = $item['title'];

				// if ($mf <> "") {
				// 	$link_mk =   " <a href=".$mk."?sql=".$mf." title=".$title.">".$ms."</a> ";
				// }else
				// if($mf == ""){
				// 	$link_mk =   " <a href=".$mk." title=".$title." target='_blank'>".$ms."</a> ";
				// }
				?>
				<table width="100%">
					<tr>
						<td><?php//echo $link_mk; ?></td>
					</tr>
				</table>	

				<div id="stepsContainer">
					<div class="col-md-12 stepsBox">
						<div class="claimSteps" id="stepOne" title="edit"><?php echo $item['sql_code'];; ?>

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