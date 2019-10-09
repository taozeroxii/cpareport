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

$topLevelItems1 = " SELECT sql_subcode_1 FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res1 =mysqli_query($con,$topLevelItems1);
foreach($res1 as $item1) {
	$sql_detail1 = $item1['sql_subcode_1'];
}
$topLevelItems2 = " SELECT sql_subcode_2 FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res2 =mysqli_query($con,$topLevelItems2);
foreach($res2 as $item2) {
	$sql_detail2 = $item2['sql_subcode_2'];
}
$topLevelItems3 = " SELECT sql_subcode_3 FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res3 =mysqli_query($con,$topLevelItems3);
foreach($res3 as $item3) {
	$sql_detail3 = $item3['sql_subcode_3'];

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
											<input type="text" class="form-control" id="datepickers" placeholder="ช่วงวันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
											<input type="text" class="form-control" id="datepickert" placeholder="ถึงวันที่" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
											<label class="radio-inline">
												<input type="radio" name="staff" id="staff" value="9" checked > : 9
											</label>
											<label class="radio-inline">
												<input type="radio" name="staff" id="staff" value="mo" > : mo
											</label>
											<label class="radio-inline">
												<input type="radio" name="staff" id="staff" value="toey" > : toey
											</label>
											&nbsp;

											<button type="submit" class="btn btn-default">Submit</button>
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

				$staff   = $_POST['staff'];    

				if($datepickers != "--") {

					$sql = " $sql_detail ";
					$sql = str_replace("{datepickers}", "'$datepickers'", $sql);
					$sql = str_replace("{datepickert}", "'$datepickert'", $sql);
					$sql = str_replace("{staff}", "'$staff'", $sql);
					$result = pg_query($sql);


					$sql1 = " $sql_detail1 ";
					$sql1 = str_replace("{datepickers}", "'$datepickers'", $sql1);
					$sql1 = str_replace("{datepickert}", "'$datepickert'", $sql1);
					$sql1 = str_replace("{staff}", "'$staff'", $sql1);
					$result1 = pg_query($sql1);

					$sql2 = " $sql_detail2 ";
					$sql2 = str_replace("{datepickers}", "'$datepickers'", $sql2);
					$sql2 = str_replace("{datepickert}", "'$datepickert'", $sql2);
					$sql2 = str_replace("{staff}", "'$staff'", $sql2);
					$result2 = pg_query($sql2);


					$sql3 = " $sql_detail3 ";
					$sql3 = str_replace("{datepickers}", "'$datepickers'", $sql3);
					$sql3 = str_replace("{datepickert}", "'$datepickert'", $sql3);
					$sql3 = str_replace("{staff}", "'$staff'", $sql3);
					$result3 = pg_query($sql3);

					?>

					<div class="row">
						<div class="col-xs-12">
							<?php echo "<h4> ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert)."  ของ USER ".$staff?> 
							<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
							<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button></h4>
							
							<!-- <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel()" > Excel </button> -->
						</div>
						<div class="col-xs-3">
							<div class="box">
								<div class="box-body">
									<h5 class="box-title box-t">Code หัตถการผู้ป่วยใน ในเวลา</h5>
									<table id="example" class="table table-bordered">
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


						<div class="col-xs-3">
							<div class="box">
								<div class="box-body">
									<h5 class="box-title box-t">Code หัตถการผู้ป่วยใน นอกเวลา</h5>
									<table id="example" class="table table-bordered">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result1);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result, $j);
													echo '<th>' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result1 = pg_fetch_array($result1)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result1, $j);
														echo '<td>' . $row_result1[$fieldname] . '</td>';
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

						<div class="col-xs-3">
							<div class="box">
								<div class="box-body">
									<h5 class="box-title box-t">Code โรคผู้ป่วยใน </h5>
									<table id="example" class="table table-bordered">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result2);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result, $j);
													echo '<th>' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result2 = pg_fetch_array($result2)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result2, $j);
														echo '<td>' . $row_result2[$fieldname] . '</td>';
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


						<div class="col-xs-3">
							<div class="box">
								<div class="box-body">
									<h5 class="box-title box-t">Code โรคผู้ป่วยใน นอกเวลา</h5>
									<table id="example" class="table table-bordered">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result3);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result, $j);
													echo '<th>' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result = pg_fetch_array($result3)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result3, $j);
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
	//	function export_excel()
	//	{
	//		document.location = "export_excel_f002.php?c_department=<?php// echo $c_department; ?>&c_pttype=<?php //echo $c_pttype; ?>&send_excel=<?php //echo $send_excel; ?>//&datepickers=<?php //echo $datepickers; ?>&datepickert=<?php //echo $datepickert; ?>";
	//	}
	
</script>

</body>
</html>