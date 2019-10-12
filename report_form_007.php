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
$ward_dropdown   = $_POST['c_ward'];  
$sql_dep = " SELECT name FROM ward WHERE ward = '". $ward_dropdown ."'";
$result_dep = pg_query($sql_dep);
$row_dep = pg_fetch_array($result_dep);
$wardname = $row_dep['name'];

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
											<select class="select2" name="c_ward" id="c_ward" style="width: 20%;" placeholder="คลินิก" title="เลือกคลินิก"></select>
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

				$dep_dropdown   = $_POST['c_ward'];    

				if($dep_dropdown  != "") {
				$sql = " $sql_detail ";
				$sql = str_replace("{ward_dropdown}", "'$dep_dropdown'", $sql);
				$result = pg_query($sql);
				?>
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<?echo "<h3>หอผู้ป่วย  ". $row_dep['name'];?>
									<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
									<!-- <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel()" > Excel </button> -->
								</h3>
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
	//	function export_excel()
	//	{
	//		document.location = "export_excel_f002.php?c_department=<?php// echo $c_department; ?>&c_pttype=<?php //echo $c_pttype; ?>&send_excel=<?php //echo $send_excel; ?>//&datepickers=<?php //echo $datepickers; ?>&datepickert=<?php //echo $datepickert; ?>";
	//	}
	
</script>

</body>
</html>