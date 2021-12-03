<!DOCTYPE html>
<html>
<?php
include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/head.class.php"; 
include('config/my_con.class.php');
session_start();
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
include "config/timestampviewer.php";//เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ

?>
<style type="text/css">
	.diagshowinput{
		color: red;
		font-weight: bold;
	}

</style>
<body class="hold-transition skin-blue sidebar-mini">
		<?php include "config/menuleft.class.php"; ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					<?php echo $sql_head; ?>
					<small><?php echo 'Viewer: '.$countview; ?></small>
				</h1>
			</section>
			<section class="content">

				<div class="row">
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">
									<div class="">
										<form class="form-inline" method="POST" action="#">
											<input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่เริ่มต้น" title="คลิก">
											<input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่สิ้นสุด" title="คลิก">
											<select class="select2" style="width: 14%;"  name="pct_dropdown" id="pct_dropdown" placeholder="แผนก" title="แผนก" >
											<option value="">เลือกแผนก</option>
											</select>
											<input type="text" class="form-control" style="width: 8%;" id="diag_1" name="diag_1" placeholder="ระบุรหัสโรคที่เริ่มต้น" title="ใส่รหัสโรคตัวแรกที่ต้องการค้นหา โดย ตัวอักษรพิมพ์ใหญ่ และไม่มีจุด ตัวอย่าง J450">
											<input type="text" class="form-control" style="width: 8%;" id="diag_2" name="diag_2" placeholder="ระบุรหัสโรคที่สิ้นสุด" title="ใส่รหัสโรคสุดท้าย ที่ต้องการค้นหา โดย ตัวอักษรพิมพ์ใหญ่ และไม่มีจุด ตัวอย่าง J46">
											<select class="select2 form-control" name="dch" id="dch" placeholder="สถานะการจำหน่าย" title="สถานะการจำหน่าย" >
												<option value="('01','02','03','04','05','08','09')">สถานะการจำหน่าย</option>
												<option value="('01','02','03','04','05','08','09')">ทุกสถานะการจำหน่าย</option>
												<option  value="('01')">01 With Approval</option>
												<option  value="('02')">02 Against Advice</option>
												<option  value="('03')">03 By Escape</option>
												<option  value="('04')">04 By Transfer</option>
												<option  value="('05')">05 Other (specify)</option>
												<option  value="('08')">08 Dead Autopsy</option>
												<option  value="('09')">09 Dead Non Autopsy</option>
											</select>

											<button type="submit" class="btn btn-default">ตกลง</button>
										</form>
									</div>
								</h3>
							</div>
						</div>
					</div>
				</div>          
				<?php 
				$datepickers    = $_POST['datepickers'];
				list($m,$d,$Y)  = explode('/',$datepickers); 
				$datepickers    = trim($Y)."-".trim($m)."-".trim($d);

				$datepickert    = $_POST['datepickert'];
				list($m,$d,$Y)  = explode('/',$datepickert); 
				$datepickert    = trim($Y)."-".trim($m)."-".trim($d);

				$diag_1    = $_POST['diag_1'];
				$diag_2    = $_POST['diag_2'];
				$spclty    = $_POST['pct_dropdown'];
				$dch 	   =  $_POST['dch'];

				if($datepickers != "--") {
					$sql = " $sql_detail ";
					$sql = str_replace("{datepickers}", "'$datepickers'", $sql);
					$sql = str_replace("{datepickert}", "'$datepickert'", $sql);
					$sql = str_replace("{diag_1}", "'$diag_1'", $sql);
					$sql = str_replace("{diag_2}", "'$diag_2'", $sql);
					$sql = str_replace("{spclty}", "'$spclty'", $sql);
					$sql = str_replace("{dch}", "$dch", $sql);
					$result = pg_query($sql);
				//	echo $sql
					?>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep">
										<?php echo " ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert);?> 
										<?php echo "<span class='diagshowinput' > | PCT >> ".$spclty."</span>" ;?>
										<?php echo "<span class='diagshowinput' > | DIagCOde >> ".$diag_1." - ".$diag_2."</span>" ;?>
										<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
									</h3>
									<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
									<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel()" > Excel </button>
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
			{
				document.location = "export_excel_ipd.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>&diag_1=<?php echo $diag_1; ?>&diag_2=<?php echo $diag_2; ?>&spclty=<?php echo $spclty; ?>&dch=<?php echo $dch; ?>";
			}
		</script>

	</body>
	</html>