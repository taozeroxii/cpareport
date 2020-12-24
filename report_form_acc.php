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
										<form class="" method="POST" action="#">
													<div class="form-row">
											<div class="form-group col-lg-2">
											<label for="inputCity">ช่วงวันที่เริ่ม</label>
											<input type="text" class="form-control" id="datepickers" placeholder="ช่วงวันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off">
											</div>
											<div class="form-group col-lg-2">
											<label for="inputCity">ถึงวันที่</label>
											<input type="text" class="form-control"  id="datepickert" placeholder="ถึงวันที่" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off">
											</div>
											<div class="form-group col-lg-3">
											<label for="inputState">เลือกสิทธิ์</label>
											<select class="select2 form-control" name="i_dropdown[]" id="i_dropdown" multiple="multiple" ></select>
											</div>
											<div class="form-group col-lg-3">
											<label for="inputZip">เลือกสถานพยาบาล</label>
											<select class="select2 form-control" name="host_dropdown[]" id="host_dropdown" multiple="multiple" ></select>
											</div>
											
											<div class="form-group col-lg-2">
											<label for="inputZip">     </label>
											<input button type="submit" class="btn btn-warning form-control" value="ตกลง"> 
											</div>
										</div>
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


				$multiplepttype_dropdown   = $_POST['i_dropdown'];   
				$multiplehost_dropdown   = $_POST['host_dropdown'];   
	

				if($datepickers != "--") {
					$sql = " $sql_detail ";
					$sql = str_replace("{datepickers}", "'$datepickers'", $sql);
                    $sql = str_replace("{datepickert}", "'$datepickert'", $sql);

					if(sizeof($multiplepttype_dropdown )>0){
						$sum_pttypes = "(";
						foreach ($multiplepttype_dropdown as $value) {
							 $sum_pttypes .="'" .$value. "',";
						}
						 $sum_pttypes = rtrim($sum_pttypes,',');
                         $sum_pttypes .= ") ";
                    } 
                    
					else {
						$selectypttype = 'SELECT pttype from pttype';
						$querypttype = pg_query($selectypttype);
						$sum_pttypes = "(";
						while($resultpty = pg_fetch_assoc($querypttype)) 
						{ 
							 $sum_pttypes .="'" .$resultpty['pttype']. "',";
						}
						$sum_pttypes = rtrim($sum_pttypes,',');
						$sum_pttypes .= ") ";
					
                    }
                    
					 $sql = str_replace("{i_dropdown}", "$sum_pttypes", $sql);
					 

					 if(sizeof($multiplehost_dropdown )>0){
						$sum_host = "(";
						foreach ($multiplehost_dropdown as $value) {
							 $sum_host .="'" .$value. "',";
						}
						 $sum_host = rtrim($sum_host,',');
                         $sum_host .= ") ";
                    } 
                    
					else {
						$selectyhost = 'SELECT hospcode from hospcode';
						$queryhost = pg_query($selectyhost);
						$sum_host = "(";
						while($resulthosty = pg_fetch_assoc($queryhost)) 
						{ 
							 $sum_host .="'" .$resulthosty['hospcode']. "',";
						}
						$sum_host = rtrim($sum_host,',');
						$sum_host .= ") ";
					
                    }
                    
			 		$sql = str_replace("{host_dropdown}", "$sum_host", $sql);
				
              
					$result = pg_query($sql);

					$$sql;
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
			document.location = "export_excel_acc.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>&multiplehost_dropdown=<?php echo $sum_host;?>&multiplepttype_dropdown=<?php echo $sum_pttypes;?>";
		}
	</script>

</body>
</html>