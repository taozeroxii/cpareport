<!DOCTYPE html>
<html>
<?php
include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/head.class.php"; 
include('config/my_con.class.php');
$bm = new Timer; 
$bm->start();
for( $i = 0 ; $i < 100000 ; $i++ )
{
	$i;
}

$sql 		=  $_GET['sql'];
$send_excel =  $_GET['sql'];
$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
	$sql_detail = $item['sql_code'];
	$sql_head   = $item['sql_head'];
}
?>
<body class="hold-transition skin-blue sidebar-mini">
		<?php include "config/menuleft.class.php"; ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					<?php echo $sql_head; ?>
				</h1>
			</section>
			<section class="content">

				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">
									<div class="container">
										<form class="form-inline" method="POST" action="#">
											<input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่เริ่มต้น" title="คลิก">
											<input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่สิ้นสุด" title="คลิก">
											<select class="form-control" id="user_k" name="user_k">
												<option value="" disabled selected>เลือกรายการ</option>
												<option value="1">ผู้บันทึกรายการ</option>
												<option value="4">ผู้จ่ายยา</option>
											</select>
											&nbsp;&nbsp;

											<select class="form-control" id="time_in" name="time_in">
												<?php for($hours=0; $hours<24; $hours++) 
												for($mins=0; $mins<60; $mins+=30)
													echo '<option value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
												.str_pad($mins,2,'0',STR_PAD_LEFT).'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
												.str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
												?>
											</select>

											<select class="form-control" id="time_out" name="time_out">
												<?php for($hours=0; $hours<24; $hours++) 
												for($mins=0; $mins<60; $mins+=30)
													echo '<option value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
												.str_pad($mins,2,'0',STR_PAD_LEFT).'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
												.str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
												?>
											</select>
											<button type="submit" class="btn btn-default" title="อย่าลืมเลือกเวลาด้วยนะครับ">ตกลง</button>
										</form>
									</div>
								</h3>
							</div>
						</div>
					</div>
				</div>          
				<?php 
				$datepickers    = $_POST['datepickers'];
				list($m,$d,$Y)  = split('/',$datepickers); 
				$datepickers    = trim($Y)."-".trim($m)."-".trim($d);

				$datepickert    = $_POST['datepickert'];
				list($m,$d,$Y)  = split('/',$datepickert); 
				$datepickert    = trim($Y)."-".trim($m)."-".trim($d);

				$user_k 		= $_POST['user_k'];
				$time_in    = $_POST['time_in'].":00";
				$time_out   = $_POST['time_out'].":00";


				if($datepickers != "--") {
					$sql = " $sql_detail ";
					$sql = str_replace("{datepickers}", "'$datepickers'", $sql);
					$sql = str_replace("{datepickert}", "'$datepickert'", $sql);
					$sql = str_replace("{user_k}", "'$user_k'", $sql);
					$sql = str_replace("{time_in}", "'$time_in'", $sql);
					$sql = str_replace("{time_out}", "'$time_out'", $sql);
					$result = pg_query($sql);
					//echo "dsdsdsd".$sql;
					?>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep"><?php echo " ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
									<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
								</h3>
								<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
								<!-- <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel()" > Excel </button> -->
							</div>
							<div class="box-body table-responsive"><span class="fcol"> </span>
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result);
											for ($j = 0 ; $j < $i ; $j++) {
												$fieldname = pg_field_name($result, $j);
												echo '<th>' . $fieldname . '</th>';
											}
											?>
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_result = pg_fetch_array($result)) 
										{ 
											$rw++;
											?>
											<tr>
												<?php
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result, $j);
													echo '<td>' . $row_result[$fieldname] . '</td>';
												} 
												?>
											</tr>
											<?php  
										}
										?>                                   
									</tbody>
								</table>			
							</div>
						</div>
					</div>
				</div>  
				<?php 
			}
			?>
		</section>
	</div>
	<?php include"config/footer.class.php"; ?>
	<?php include"config/js.class.php" ?>
	<script>
		$(function () {
			$('#example1').DataTable()
			$('#example2').DataTable({
				'paging'      : true,
				'lengthChange': false,
				'searching'   : false,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : false
			})
		})
	</script>
	<script type="text/javascript">
		function export_excel()
		// {
		// 	document.location = "export_excel_f001.php?send_excel=<?php //echo $send_excel; ?>&datepickers=<?php //echo $datepickers; ?>&datepickert=<?php //echo $datepickert; ?>";
		// }
	</script>

</body>
</html>