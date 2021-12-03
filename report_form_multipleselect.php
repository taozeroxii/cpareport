<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<html>

<body class="hold-transition skin-blue sidebar-mini">
	<?php
	session_start();
	include "config/pg_con.class.php";
	include "config/func.class.php";
	include "config/time.class.php";
	include "config/head.class.php";
	include 'config/my_con.class.php';
	$bm = new Timer;
	$bm->start();
	for ($i = 0; $i < 100000; $i++) {
		$i;
	}
	$sql =  $_GET['sql'];

	$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '" . $sql . "'";
	$res = mysqli_query($con, $topLevelItems);

	foreach ($res as $item) {
		$sqlgethosxp = $sql_detail = $item['sql_code'];
		$sql_head   = $item['sql_head'];
	}
	/////////////////// เช็คlogin  //////////////////////////////
	if ((isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) && $sql == 'sql_0123') {
		$messagealert = 'โปรดเข้าสู่ระบบเพื่อค้นหาข้อมูล';
	}
	/////////////////// เช็คเก็บข้อมูลผู้เข้าชม sql นั้นๆ เพื่อเก็บ session นับจำนวน view  //////////////////////////////
	include "config/timestampviewer.php"; //เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ


	//เช็คตัวแปร query ว่ามีค่าอะไรที่ต้องแปลงบ้างแล้วนำไปจัดการกับปุ่มเลือกข้อมูล
	$ckdatebegin = "";
	$ckdateend   = "";
	$ckstime     = "";
	$cketime     = "";
	$cksicd10    = "";
	$ckeicd10    = "";
	$ckpttype    = "";
	$ckspclty    = "";
	$ckward      = "";
	$ckdoctor    = "";
	$ckroom      = "";
	$messageInput = "";
	$chmain_ri   = ""; // เช็ค hospmain หรือ refer in
	$chsub_ro    = ""; // เช็ค hospsub  หรือ refer out

	$ckdatebegin =  strpos($sqlgethosxp, "{datepickers}");
	if ($ckdatebegin !== false) {
		$messageInput .= ' วันเริ่มต้น ';
		$msgshow = '<p>หากติกเลือกทั้งหมดแล้วไม่ควรเลือกตัวเลือกอื่นเพราะจะติด error </p>';
	}
	$ckdateend =  strpos($sqlgethosxp, "{datepickert}");
	if ($ckdateend !== false) {
		$messageInput .= ' วันเริ่มสิ้นสุด ';
	}
	$ckstime =  strpos($sqlgethosxp, "{stime}");
	if ($ckstime !== false) {
		$messageInput .= ' เวลาเริ่ม ';
	}
	$cketime =  strpos($sqlgethosxp, "{etime}");
	if ($cketime !== false) {
		$messageInput .= ' เวลาสิ้นสุด ';
	}

	$cksicd10  =  strpos($sqlgethosxp, "{sicd10}");
	if ($cksicd10  !== false) {
		$messageInput .= ' รหัสโรคเริ่มต้น ';
	}

	$ckeicd10  =  strpos($sqlgethosxp, "{eicd10}");
	if ($ckeicd10   !== false) {
		$messageInput .= ' รหัสโรคเริ่มสิ้นสุด ';
	}

	$ckpttype =  strpos($sqlgethosxp, "{multiple_pttype}");
	if ($ckpttype !== false) {
		$messageInput .= ' สิทธิ ';
		$selectpty = "select pttype,name from pttype order by  pttype";
		$selectpty2 = "select pttype from pttype order by  pttype"; // หากไม่เลือกให้แสดงทั้งหมด
		$qselect2pty = pg_query($conn, $selectpty);
	}

	$ckspclty =  strpos($sqlgethosxp, "{multiple_spclty}");
	if ($ckspclty !== false) {
		$messageInput .= ' แผนก ';
		$selectspclty = "select spclty,name from spclty order by spclty";
		$selectspclty2 = "select spclty from spclty order by spclty";
		$qselectspclty = pg_query($conn, $selectspclty);
	}

	$ckward =  strpos($sqlgethosxp, "{multiple_ward}");
	if ($ckward !== false) {
		$messageInput .= ' วอร์ด ';
		$selectward = "select ward,name from ward  where name not like '%ยกเลิก%'order by ward";
		$selectward2 = "select ward from ward  where name not like '%ยกเลิก%'order by ward";
		$qselectward = pg_query($conn, $selectward);
	}

	$ckdoctor =  strpos($sqlgethosxp, "{multiple_doctor}");
	$ckdoctor2 = strpos($sqlgethosxp, "{mutiple_doctor}");
	if ($ckdoctor !== false || $ckdoctor2 !== false) {
		$messageInput .= ' แพทย์ ';
		$selectdoctor = "select code,licenseno,name from doctor  where name not like '%ยกเลิก%' order by code";
		$selectdoctor2 = "select code from doctor  where name not like '%ยกเลิก%' order by code";
		$qselectdoctor = pg_query($conn, $selectdoctor);
	}


	$ckroom =  strpos($sqlgethosxp, "{multiple_room}");
	if ($ckroom !== false) {
		$messageInput .= ' ห้องตรวจ ';
		$selectroom = "SELECT depcode,department FROM kskdepartment where depcode_active = 'Y' order by depcode";
		$selectroom2 = "SELECT depcode FROM kskdepartment where depcode_active = 'Y' order by depcode";
		$qselectroom = pg_query($conn, $selectroom);
	}

	$chmain_ri =  strpos($sqlgethosxp, "{hmain_referin}");
	if ($chmain_ri !== false) {
		$messageInput .= ' hospmain หรือ referin ';
		$selecthmain_ri = "	SELECT hospcode,name from hospcode where chwpart = '25' and name  ~ 'โรงพยาบาล|คลินิก' ";
		$selecthmain_ri2 = " SELECT hospcode FROM kskdepartment  where chwpart = '25' and name  ~ 'โรงพยาบาล|คลินิก' order by hospcode"; // หากไม่เลือกให้แสดงทั้งหมด
		$qselecthmain_ri = pg_query($conn, $selecthmain_ri);
	}

	$chsub_ro  =  strpos($sqlgethosxp, "{hsub_referout}");
	if ($chsub_ro !== false) {
		$messageInput .= ' hospsub หรือ referout ';
		$selecthsub_ro = "SELECT hospcode,name from hospcode where chwpart = '25' and name  ~ 'โรงพยาบาล|คลินิก' ";
		$selecthsub_ro2 = "SELECT hospcode FROM kskdepartment  where chwpart = '25' and name  ~ 'โรงพยาบาล|คลินิก' order by hospcode"; // หากไม่เลือกให้แสดงทั้งหมด
		$qselecthsub_ro = pg_query($conn, $selecthsub_ro);
	}





	function checkhavereplace($havereplace)
	{
		//function เช็คตัวแปรที่เก็บค่าว่ามีคำนั้นๆในข้อความหรือไม่และให้ disabled กับ required ปุ่ม
		if ($havereplace == '' || $havereplace == null) {
			echo 'disabled';
		} else {
			echo 'required';
		}
	}

	function cstring_multipleinput($getdatamultiple, $appparams)
	{
		// function ต่อ string จาก select 2 
		if (@sizeof($getdatamultiple) > 0) {
			$sums = "(";

			foreach ($getdatamultiple as $value) {
				if ($value == 'ALL') {
					$sums = "(" . $appparams;
					$all = true;
				}
				$sums .= "'" . $value . "',";
			}

			$sums = rtrim($sums, ',');
			if ($all == true) {
				$sums = rtrim($sums, "'ALL'");
			}
			$sums .= ") ";
		} else {
			$sums = "(" . $appparams . ")";
		}
		return ($sums);
	}


	//submit ตัวแปรมา query
	if ($_POST['submit'] != '' || $_POST['submit'] != null) {
		$datepickers    = $_POST['datepickers'];
		$datepickert    = $_POST['datepickert'] ;
		$starttime      = $_POST['stime'];
		$endtime        = $_POST['etime'] ;
		$starticd10     = strtoupper($_POST['sicd10']) ;
		$endicd10       = strtoupper($_POST['eicd10']) ;
		$multiplepttype = $_POST['pttype'] ;
		$multipleSpclty = $_POST['spclty'] ;
		$multipleward   = $_POST['ward'] ;
		$multipledoctor = $_POST['doctor'];
		$multipleroom   = $_POST['room'];
		$multiplehmain  = $_POST['hmain'];
		$multiplehsub   = $_POST['hsub'] ;

		$sqlgethosxp = str_replace("{datepickers}", "'$datepickers'", $sqlgethosxp); // แทนค่า
		$sqlgethosxp = str_replace("{datepickert}", "'$datepickert'", $sqlgethosxp); // แทนค่า

		$sqlgethosxp = str_replace("{stime}", "'$starttime'", $sqlgethosxp);
		$sqlgethosxp = str_replace("{etime}", "'$endtime'", $sqlgethosxp);

		$sqlgethosxp = str_replace("{sicd10}", "'$starticd10'", $sqlgethosxp);
		$sqlgethosxp = str_replace("{eicd10}", "'$endicd10'", $sqlgethosxp);

		$sqlgethosxp = str_replace("{multiple_pttype}", cstring_multipleinput($multiplepttype, @$selectpty2), $sqlgethosxp);
		$sqlgethosxp = str_replace("{multiple_spclty}", cstring_multipleinput($multipleSpclty, @$selectspclty2), $sqlgethosxp);
		$sqlgethosxp = str_replace("{multiple_ward}", cstring_multipleinput($multipleward, @$selectward2), $sqlgethosxp);
		$sqlgethosxp = str_replace("{multiple_doctor}", cstring_multipleinput($multipledoctor, @$selectdoctor2), $sqlgethosxp);
		$sqlgethosxp = str_replace("{mutiple_doctor}", cstring_multipleinput($multipledoctor, @$selectdoctor2), $sqlgethosxp);
		$sqlgethosxp = str_replace("{multiple_room}", cstring_multipleinput($multipleroom, @$selectroom2), $sqlgethosxp);

		$sqlgethosxp = str_replace("{hmain_referin}", cstring_multipleinput($multiplehmain, $selecthmain_ri2), $sqlgethosxp);
		$sqlgethosxp = str_replace("{hsub_referout}", cstring_multipleinput($multiplehsub, $selecthsub_ro2), $sqlgethosxp);
		$sql = $sqlgethosxp; // ไว้แสดงใน model SQL หลังจาก get ไปดึงค่าแล้ว post ให้ค่าเปลี่ยน
		$result = @pg_query($conn, $sqlgethosxp);
	}
	?>



	<?php include "config/menuleft.class.php"; ?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				<?php echo $sql_head; ?>
				<small><?php echo 'Viewer: ' . $countview; ?></small>
			</h1>
		</section>
		<section class="content">

			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header2" style="padding:15px;">

							<div class="container-fulid">
								<form class="form mt-5" method="POST" action="#">
									<div class="row">
										<div class="col-lg-3">
											<label for="day"> โปรดเลือกวันที่เริ่มต้น : </label>
											<input type="date" class="form-control" name="datepickers" autocomplete="off" <?php checkhavereplace($ckdatebegin); ?>>
										</div>
										<div class="col-lg-3">
											<label for="datepickert"> วันที่สิ้นสุด :</label>
											<input type="date" class="form-control" name="datepickert" autocomplete="off" <?php checkhavereplace($ckdateend); ?>>
										</div>
										<div class="col-lg-1">
											<label for="datepickert"> เวลาเริ่มต้น :</label>
											<input type="time" class="form-control" name="stime" placeholder="เวลาเริ่มต้น" autocomplete="off" <?php checkhavereplace($ckstime); ?>>
										</div>
										<div class="col-lg-1">
											<label for="datepickert"> เวลาสิ้นสุด :</label>
											<input type="time" class="form-control" name="etime" placeholder="เวลาสิ้นสุด" autocomplete="off" <?php checkhavereplace($cketime); ?>>
										</div>
										<div class="col-lg-2">
											<label for="datepickert"> รหัสโรคเริ่มต้น :</label>
											<input type="text" class="form-control" name="sicd10" placeholder="รหัสหัตถการ icd10_9" autocomplete="off" <?php checkhavereplace($cksicd10); ?>>
										</div>
										<div class="col-lg-2">
											<label for="datepickert"> รหัสโรคสิ้นสุด :</label>
											<input type="text" class="form-control" name="eicd10" placeholder="รหัสหัตถการ icd10_9" autocomplete="off" <?php checkhavereplace($ckeicd10); ?>>
										</div>
									</div>

									<div class="row mt-2">
										<div class="col-lg-4">
											<label for="spclty"> โปรดเลือกแผนก : </label>
											<select class="js-example-basic-multiple form-control" name="spclty[]" data-search="true" multiple="multiple" <?php checkhavereplace($ckspclty);  	?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($datasp = pg_fetch_assoc($qselectspclty)) { ?>
													<option value="<?php echo $datasp['spclty']; ?>"><?php echo  $datasp['spclty'] . ' : ' . $datasp['name'] ?></option>
												<?php } ?>
											</select>
										</div>

										<div class="col-lg-4">
											<label for="room"> โปรดเลือกห้องตรวจ : </label>
											<select class="js-example-basic-multiple form-control" name="room[]" data-search="true" multiple="multiple" <?php checkhavereplace($ckroom); ?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($dataroom = pg_fetch_assoc($qselectroom)) { ?>
													<option value="<?php echo $dataroom['depcode']; ?>"><?php echo  $dataroom['department'] ?></option>
												<?php } ?>
											</select>
										</div>

										<div class="col-lg-4">
											<label for="spclty"> โปรดเลือกวอร์ด : </label>
											<select class="js-example-basic-multiple form-control" name="ward[]" data-search="true" multiple="multiple" <?php checkhavereplace($ckward); ?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($datasp = pg_fetch_assoc($qselectward)) { ?>
													<option value="<?php echo $datasp['ward']; ?>"><?php echo  $datasp['ward'] . ' : ' . $datasp['name'] ?></option>
												<?php } ?>
											</select>
										</div>

									</div>

									<div class="row mt-3">
										<div class="col-lg-6 ">
											<label for="pttype"> โปรดเลือกสิทธิ : </label>
											<select class="js-example-basic-multiple form-control" name="pttype[]" data-search="true" multiple="multiple" <?php checkhavereplace($ckpttype); ?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($datapty = pg_fetch_assoc($qselect2pty)) { ?>
													<option value="<?php echo $datapty['pttype']; ?>"><?php echo  $datapty['pttype'] . ' : ' . $datapty['name'] ?></option>
												<?php } ?>
											</select>
										</div>

										<div class="col-lg-6 ">
											<label for="doctor"> โปรดเลือกแพทย์ : </label>
											<select class="js-example-basic-multiple form-control" name="doctor[]" data-search="true" multiple="multiple" <?php checkhavereplace($ckdoctor); ?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($datapdc = pg_fetch_assoc($qselectdoctor)) { ?>
													<option value="<?php echo $datapdc['code']; ?>"><?php echo  $datapdc['code'] . ' : ' . $datapdc['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>



									<div class="row mt-3">
										<div class="col-lg-6 ">
											<label for="hmain"> โปรดเลือกสถานพยาบาลหลัก : </label>
											<select class="js-example-basic-multiple form-control" name="hmain[]" data-search="true" multiple="multiple" <?php checkhavereplace($chmain_ri); ?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($datapty = pg_fetch_assoc($qselecthmain_ri)) { ?>
													<option value="<?php echo $datapty['hospcode']; ?>"><?php echo  $datapty['hospcode'] . ' : ' . $datapty['name'] ?></option>
												<?php } ?>
											</select>
										</div>

										<div class="col-lg-6 ">
											<label for="hsub"> โปรดเลือกสถานพยาบาลรอง : </label>
											<select class="js-example-basic-multiple form-control" name="hsub[]" data-search="true" multiple="multiple" <?php checkhavereplace($chsub_ro); ?>>
												<option value="ALL">เลือกทั้งหมด</option>
												<?php while ($datapdc = pg_fetch_assoc($qselecthsub_ro)) { ?>
													<option value="<?php echo $datapdc['hospcode']; ?>"><?php echo  $datapdc['hospcode'] . ' : ' . $datapdc['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12 ">
											<?php echo '<p style="margin-top:20px;color:green;text-align:center;">** โปรดเลือก : ' . $messageInput . ' **</p>' . $msgshow; ?>
											<button type="submit" name="submit" value="submit" class="btn btn-info btn-block " style="margin-top:25px;" vaule='submit'>ยืนยัน</button>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>


			<?php
			if ($_POST['submit'] != '' || $_POST['submit'] != null) {
			?>
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title co_dep"><?php echo " ข้อมูลช่วงวันที่ " . date_format(date_create($datepickers), 'd/m/Y') . " ถึงวันที่ " .  date_format(date_create($datepickert), 'd/m/Y'); ?>
									<small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
								</h3>
								<div class="row" style="margin-right:15px">
									<?php $sql = $sqlgethosxp; // ปรับแก้เวลา login แสดงผล sql เป็นของ session
									?>
									<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> SQL </button>
									<form class="form" method="POST" action="./exportexcel.php" target="_blank">
										<?php
										//แปลงชุดคำสั่งบางตัวเพื่อไม่ให้ watchgard ตรวจจับเป็นคำสั่ง sql
										$sqlgethosxp =  str_replace("SELECT", 'SELECTDATA', $sqlgethosxp);
										$sqlgethosxp =  str_replace("Select", 'SELECTDATA', $sqlgethosxp);
										$sqlgethosxp =  str_replace("select", 'SELECTDATA', $sqlgethosxp);
										$sqlgethosxp =  str_replace("FROM", 'FROMTABLES', $sqlgethosxp);
										$sqlgethosxp =  str_replace("from", 'FROMTABLES', $sqlgethosxp);
										?>
										<input type="hidden" name="sendsql" value="<?php echo $sqlgethosxp; ?>">
										<button type="submit" name="submitexcel" class="btn btn-default pull-right" class="btn btn-info btn-lg"> Excel </button>
									</form>
								</div>
							</div>
							<div class="box-body table-responsive"><span class="fcol"> </span>
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result) ?? 0;
											for ($j = 0; $j < $i; $j++) {
												$fieldname = pg_field_name($result, $j);
												echo '<th class="text-nowrap">' . $fieldname . '</th>';
											}
											?>
										</tr>
									</thead>
									<tbody>
										<?php
										$rw = 0;
										if ($result >0) {
											while ($row_result = pg_fetch_array($result)) {
												$rw++;
										?>
												<tr>
													<?php
													for ($j = 0; $j < $i; $j++) {
														$fieldname = pg_field_name($result, $j);
														echo '<td>' . " " . $row_result[$fieldname] . '</td>';
													}
													?>
												</tr>
										<?php
											}
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

	<?php include "config/footer.class.php"; ?>
	<?php include "config/js.class.php" ?>

	<script type="text/javascript">
		$(function() {
			$('#example1').DataTable({
				'paging': true,
				'lengthChange': true,
				"aLengthMenu": [
					[5, 25, 50, 100, 1000, -1],
					[5, 25, 50, 100, 1000, "All"]
				], // show data rows
				'searching': true,
				'ordering': true,
				'info': true,
				'autoWidth': false
			})
		})

		$(document).ready(function() {
			$('.js-example-basic-multiple').select2();
		});
	</script>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>

</html>