<!DOCTYPE html>
<html>
<?php
include"config/iswin_con.class.php";
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
$topLevelItems = " SELECT sql_code,sql_subcode_1,sql_head FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
	$sql_detail 	= $item['sql_code'];
	$sql_head   	= $item['sql_head'];
	$sql_subcode_1	= $item['sql_subcode_1'];
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
											<input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
											<input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
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
				list($m,$d,$Y)  = split('/',$datepickers); 
				$datepickers    = trim($Y)."-".trim($m)."-".trim($d);

				$datepickert    = $_POST['datepickert'];
				list($m,$d,$Y)  = split('/',$datepickert); 
				$datepickert    = trim($Y)."-".trim($m)."-".trim($d);

				if($datepickers != "--") {
					$sql = " $sql_detail ";
					$sql = str_replace("{datepickers}", "'$datepickers'", $sql);
					$sql = str_replace("{datepickert}", "'$datepickert'", $sql);
					$result = mysqli_query($conn,$sql);


					$sqld = " $sql_subcode_1 ";
					$sqld = str_replace("{datepickers}", "'$datepickers'", $sqld);
					$sqld = str_replace("{datepickert}", "'$datepickert'", $sqld);
					$resultd = mysqli_query($conn,$sqld);
					?>

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep">
										<span class="div-1-1"> ข้อมูลทั้งหมดของ </span>
										<?php echo " ช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
									<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
								</h3>
								<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
								<!-- <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="ex_sql()" > Excel </button> -->
							</div>
							<div class="box-body table-responsive"><span class="fcol"> </span>
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>HN</th>
											<th>PNAME</th>										
											<th>ADATE</th>
											<th>PS</th>
											
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_result = mysqli_fetch_array($result)) 
										{ 
											$rw++;

											?>
											<tr>
												<td> <?php echo $row_result['HN']; ?></td>
												<td> <?php echo $row_result['PNAME']." ".$row_result['NAME']." ". $row_result['FNAME']; ?></td>
												<td> <?php echo thaiDatefull($row_result['ADATE']); ?></td>
												<td> <?php echo $row_result['PS']; ?></td>

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

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep">
										<span class="div-1-1"> ข้อมูลที่เสียชีวิตของ </span>
										<?php echo " ช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
									<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
								</h3>
								<!-- <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="ex_sqld()" > Excel </button> -->
							</div>
							<div class="box-body table-responsive"><span class="fcol"> </span>
								<table id="example3" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>HN</th>
											<th>PNAME</th>										
											<th>ADATE</th>
											<th>PS</th>
											
										</tr> 
									</thead>
									<tbody>
										<? $rw=0;
										while($row_resultd = mysqli_fetch_array($resultd)) 
										{ 
											$rw++;

											?>
											<tr>
												<td> <?php echo $row_resultd['HN']; ?></td>
												<td> <?php echo $row_resultd['PNAME']." ".$row_resultd['NAME']." ". $row_resultd['FNAME']; ?></td>
												<td> <?php echo thaiDatefull($row_resultd['ADATE']); ?></td>
												<td> <?php echo $row_resultd['PS']; ?></td>

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
			$('#example3').DataTable()
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
		// function ex_sql()
		// {
		// 	document.location = "export_excel_sp.php?send_excel=<?php// echo $sql; ?>";
		// }
		// function ex_sqld()
		// {
		// 	document.location = "export_excel_sp.php?send_excel=<?php// echo $sqld; ?>";
		// }
	</script>

</body>
</html>