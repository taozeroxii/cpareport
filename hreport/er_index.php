<!DOCTYPE html>
<html>
<?php include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/sql.class.php";
include"config/head.class.php"; 

$bm = new Timer; 
$bm->start();
for( $i = 0 ; $i < 100000 ; $i++ )
{
	$i;
}
?>
<style type="text/css">
	.h-div{
		text-align: left;
	}
	.d-div{
		text-align: left;
	}
</style>


<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="#" class="logo">
				<span class="logo-mini"><b>r</b>CPA</span>
				<span class="logo-lg"><b>Re</b>port Hospital</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			</nav>
		</header>
		<?php include "config/menuleft.class.php"; ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					ข้อมูลฉุกเฉิน ข้อมูล ณ วันที่ <?php echo thaidatefull(date('Y-m-d'))." เวลา ".date('H:i:s')." น. ";?>
					<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
				</h1>
			</section>

			<section class="content">
				<div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">ประเภทผู้มารับบริการ <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
							</div>
							<div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result_1);
											for ($j = 0 ; $j < $i ; $j++) {
												$fieldname = pg_field_name($result_1, $j);
												echo '<th class="h-div">' . $fieldname . '</th>';
											}
											?>
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_result = pg_fetch_array($result_1)) 
										{ 
											$rw++;
											?>
											<tr>
												<?php
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_1, $j);
													echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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

					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">ประเภมการน้ำส่ง </h3>
							</div>
							<div class="box-body">
								<div id="">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result_2);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_2, $j);
													echo '<th class="h-div">' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result = pg_fetch_array($result_2)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result_2, $j);
														echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">สถานะการจำหน่าย <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
							</div>
							<div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result_3);
											for ($j = 0 ; $j < $i ; $j++) {
												$fieldname = pg_field_name($result_3, $j);
												echo '<th class="h-div">' . $fieldname . '</th>';
											}
											?>
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_result = pg_fetch_array($result_3)) 
										{ 
											$rw++;
											?>
											<tr>
												<?php
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_3, $j);
													echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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

					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">แยกตามเวร </h3>
							</div>
							<div class="box-body">
								<div id="">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result_4);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_4, $j);
													echo '<th class="h-div">' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result = pg_fetch_array($result_4)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result_4, $j);
														echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Refer มาจาก <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
							</div>
							<div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result_5);
											for ($j = 0 ; $j < $i ; $j++) {
												$fieldname = pg_field_name($result_5, $j);
												echo '<th class="h-div">' . $fieldname . '</th>';
											}
											?>
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_result = pg_fetch_array($result_5)) 
										{ 
											$rw++;
											?>
											<tr>
												<?php
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_5, $j);
													echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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

					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Admit ward  </h3>
							</div>
							<div class="box-body">
								<div id="">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result_6);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_6, $j);
													echo '<th class="h-div">' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result = pg_fetch_array($result_6)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result_6, $j);
														echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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
				</div>
	<div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">แยกช่วงอายุ<small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
							</div>
							<div class="box-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result_7);
											for ($j = 0 ; $j < $i ; $j++) {
												$fieldname = pg_field_name($result_7, $j);
												echo '<th class="h-div">' . $fieldname . '</th>';
											}
											?>
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_result = pg_fetch_array($result_7)) 
										{ 
											$rw++;
											?>
											<tr>
												<?php
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_7, $j);
													echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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

					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">แยกช่วงเวลา</h3>
							</div>
							<div class="box-body">
								<div id="">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<?php
												$i = pg_num_fields($result_8);
												for ($j = 0 ; $j < $i ; $j++) {
													$fieldname = pg_field_name($result_8, $j);
													echo '<th class="h-div">' . $fieldname . '</th>';
												}
												?>
											</tr> 
										</thead>
										<tbody>
											<? $rw=0;
											while($row_result = pg_fetch_array($result_8)) 
											{ 
												$rw++;
												?>
												<tr>
													<?php
													for ($j = 0 ; $j < $i ; $j++) {
														$fieldname = pg_field_name($result_8, $j);
														echo '<td class="d-div">' . $row_result[$fieldname] . '</td>';
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
				</div>
			</section>
		</div>

		<?php include"config/footer.class.php"; ?>
		<?php include"config/js.class.php" ?>
		<?php include"modal/modal.class.php" ?>
		<script src="hchart/js/highcharts.js"></script>
		<script src="hchart/js/data.js"></script>
		<script src="hchart/js/exporting.js"></script>  

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
	</body>
	</html>
