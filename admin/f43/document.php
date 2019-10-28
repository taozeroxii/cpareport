<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.ttd{
			text-align: center;
		}
		/* Flaired edges, by Tomas Theunissen */

		hr.style18 { 
			height: 30px; 
			border-style: solid; 
			border-color: #aaddaa; 
			border-width: 1px 0 0 0; 
			border-radius: 20px; 
		} 
		hr.style18:before { 
			display: block; 
			content: ""; 
			height: 30px; 
			margin-top: -31px; 
			border-style: solid; 
			border-color: #aaddaa; 
			border-width: 0 3 4px 0; 
			border-radius: 20px; 
		}
		.ddddddd{
			text-align: center;	
			width: 1000px;
			height: 700px;
		}
		.ddddddd:hover{
			text-align: center;	
			width: 1000px;
			height: 700px;
			cursor: pointer;
		}
		.cen{
			text-align: center;
		}
		.con{
			color: #146052;
			font-weight: bold;
			font-size: 1.4em;
			text-align: center;
		}
		.sss{
			font-size: 1.4em;
			font-weight: bold;
			color: #744AC3; 
			cursor: pointer;
		}

	</style>
</head>
<body>
	<?php 
	$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
	mysqli_set_charset($con,"utf8");
	$sql = " SELECT * FROM f43_imgdoc WHERE status_id = '1' ORDER BY id DESC ";
	$res = mysqli_query($con, $sql);
	?>
	<div class="con">DOCUMENT F43</div>
	<hr class="style18">
	<!-- <hr class="style18"> -->
	<!-- <table id="table" class="table table-bordered table-striped"> -->
		<!-- <tbody> -->
			<?php
			$rw == 0;
			foreach ($res as $item) {
				$file =  $item['file_name'];
				$rw++;
				?>
				<!-- <tr> -->
					<!-- <td class="ttd"> -->
						<span class="sss" title="<?php echo $file; ?> "><?php echo "No.".$rw."";?></span>
						<div class="cen" ><img class="ddddddd" src="uploadimg/fileupload/<?php echo $item['file_name']; ?>" title="<?php echo $file ?>"></div>
						<!-- </td> -->

						<!-- </tr> -->
						
						<hr class="style18">
						<?php
					}
					?>

					<!-- </tbody> -->

					<!-- </table> -->

				</div>

			</body>
			</html>