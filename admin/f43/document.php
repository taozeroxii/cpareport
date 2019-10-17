<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.ttd{
			text-align: center;
		}
	</style>
</head>
<body>
	<?php 
	$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
	mysqli_set_charset($con,"utf8");
	$sql = " SELECT * FROM f43_imgdoc ";
	$res = mysqli_query($con, $sql);
	?>
	<div></div>
<hr>
	<table id="table" class="table table-bordered table-striped">
		<tbody>
			<?php
			$rw == 0;
			foreach ($res as $item) {
				$rw++;
				?>
				<tr>
					<td class="ttd"><img src="uploadimg/fileupload/<?php echo $item['file_name']; ?>"></td>
				</tr>
				<?php
			} ?>
		</tbody>
	</table>
</div>

</body>
</html>