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
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">
									<div class="container">
										<form class="form-inline" method="POST" action="#">
											<select class="select2" name="usergroup_dropdown[]" id="usergroup_dropdown" multiple="multiple" style="width: 20%;" placeholder="กลุ่มผู้ใช้งาน" title="เลือกกลุ่มผู้ใช้งาน"></select>
											<button type="submit" class="btn btn-default">Submit</button><small style="color:brown">**หมายเหตุ:หากไม่เลือกสิทธิจะแสดงทั้งหมด*</small>
										</form>
									</div>
								</h3>
							</div>
						</div>
					</div>
				</div>          
				<?php 
				$c_pttype       = $_POST['usergroup_dropdown']; 

				if($datepickers != "--") {
					$sql = " $sql_detail ";
				
					if(sizeof($c_pttype )>0){
						$sum_pttypes = "(";
						foreach ($c_pttype as $value) {
							$sum_pttypes .="'" .$value. "',";
						}
						$sum_pttypes = rtrim($sum_pttypes,',');
						$sum_pttypes .= ") ";
					} 
					else {
						$selectypttype = "SELECT officer_group_id FROM officer_group WHERE officer_group_name like '%%แพทย์%%'";
						$querypttype = pg_query($selectypttype);


						 $sum_pttypes = "(";
						while($resultpty = pg_fetch_assoc($querypttype)) 
						{ 
							 $sum_pttypes .="'" .$resultpty['officer_group_id']. "',";
						}
						$sum_pttypes = rtrim($sum_pttypes,',');
						$sum_pttypes .= ") ";
						$sql = str_replace("{usergroup_dropdown}", "$sum_pttypes", $sql);
					}
			 		$sql = str_replace("{usergroup_dropdown}", "$sum_pttypes", $sql);
				
              
					$result = pg_query($sql);
					?>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep"><?php echo " ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
									<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
								</h3>
								<?if($_SESSION['status'] == 1 ){?>
								<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> SQL </button>
								<?}?>
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
			document.location = "export_excel_f001.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>&usergroup_dropdown=<?php echo $sum_pttypes;?>";
		}
	</script>

</body>
</html>