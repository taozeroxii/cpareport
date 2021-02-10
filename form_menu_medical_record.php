<!DOCTYPE html>
<html>
<?php
session_start();
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/head.class.php";
include('config/my_con.class.php');
$bm = new Timer;
$bm->start();
for ($i = 0; $i < 100000; $i++) {
	$i;
}
$sql 		=  $_GET['sql'];
$send_excel =  $_GET['sql'];
$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '" . $sql . "'";
$res = mysqli_query($con, $topLevelItems);
foreach ($res as $item) {
	$sql_detail = $item['sql_code'];
	$sql_head   = $item['sql_head'];
}
/////////////////// เช็คเก็บข้อมูลผู้เข้าชม sql นั้นๆ เพื่อเก็บ session นับจำนวน view  //////////////////////////////
include "config/timestampviewer.php"; //เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ


$menu = array(
	'1. ให้รหัส icd10 ที่เป็นเพศหญิงเท่านั้นในเพศชาย ', 
	'2. ให้รหัส icd10 ของเพศชายเท่านั้นในเพศหญิง ', 
	'3. ใช้รหัส V,W,X,Y เป็นรหัสโรคหลัก ซึ่งไม่ควรให้เป็นรหัสโรคหลัก	',
	'4. การให้รหัส S และ T ในผู้ป่วยรายใดต้องให้รหัสสาเหตุภายนอกร่วมด้วยเสมอ (หากมี S หรือ T ต้องมี v,w,x,y ร่วม ถ้าไม่มีดึงมา)', 
	'5. ห้ามใช้รหัส T31.0-T31.9 เป็นโรคหลัก pdx หรือ diagtype1 ',
	'6. การให้รหัส Z470-Z479,Z480-Z489 จะต้องไม่ใช้ร่วมกับรหัสกลุ่ม S หรือ T ในการรักษาครั้งนี้', 
	'7. รหัส ICD ที่เป็นรหัสแสดงความด้อยคุณภาพของสถานพยาบาล E14.9, J06.9, D22.9, L02.9, L03.9, R22.9TO7, T14.0 - T14.9, Z34.9'
);

$detailmenu = array(
	'- ให้รหัส icd10 ที่เป็นเพศหญิงเท่านั้นในเพศชาย เช่น 1. รหัส ICD10 ที่เป็นเพศหญิงเท่านั้น ได้แก่รหัส A34, B37.3, C51-C58, C79.6, 
	D06.-, D07.0- D07.3, I D25-D28, D39.-, E28.-, E89.4, F52.5, F53.-, 186.3, L29.2, L70.5, M80.0-M80.1, M81.0-M81.1,
	M83.0, N70-N98, N99.2-N99.3, 000-099, P54.6, Q50-Q52, R87, S31.4-S37.6, T19.2-T19.3, T83.3, Y76.-, 201.4, Z12.4, 
	230.1, Z30.3, Z30.5, Z31.1, Z31.2, 732-236, 239.-, Z43.7, Z87.5, Z97.5
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0317" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>' ,
	'- รหัส ICD ที่ใช้ได้กับผู้ป่วย ชายเท่านั้น ได้แก่รหัส B26.0, C60-63, D07.4-D07.6, D17.6, D29.-,D40.E29.-, E89.5, F52.4, 186.1, L29.1, N40-51, Q53-Q55, R86, S31.2-S31.3, Z12.5
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0318" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>',
	'- ใช้รหัส VW,X,Y เป็นรหัสโรคหลัก
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0321" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>',
	'- การให้รหัส S และ T ในผู้ป่วยรายใดต้องให้รหัสสาเหตุภายนอกร่วมด้วยเสมอ (หากมี S หรือ T ต้องมี v,w,x,y ร่วม ถ้าไม่มีดึงมา) 
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0322" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>',
	'- ห้ามใช้รหัส T31.0-T31.9 ซึ่งเป็นรหัสบอกเปอร์เซ็นต์การเกิดแผลไหม้เป็นโรคหลัก 
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0323" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>',
	'- ห้ามใช้รหัส Z470-Z479,Z480-Z489 ร่วมกับ รหัสกลุ่ม S หรือ T
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0319" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>',
	'- เคสที่มีการลงรหัสตามนี้ E14.9, J06.9, D22.9, L02.9, L03.9, R22.9TO7, T14.0 - T14.9, Z34.9 ด้อยคุณภาพให้ดึงมา
	<br> <br><a href ="./report_form_multipleselect.php?sql=sql_0320" target="_blank"><button class="btn btn-info"> คลิกเปิดหน้าดึงข้อมูล !!</button></a><hr>'
)

?>

<body class="hold-transition skin-blue sidebar-mini">
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
						<div class="box-header">ERROR CODE เวชระเบียน</div>
						<div class="box-body table-responsive"><span class="fcol"> </span>



							<div id="accordion">
								<?php for ($i = 0; $i < 10; $i++) { ?>
									<div class="card">
										<div class="card-header" id="headingTwo<?= $i?>">
											<h5 class="mb-0">
												<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo<?= $i?>" aria-expanded="false" aria-controls="collapseTwo">
													<?php echo $menu[$i]?>
												</button>
											</h5>
										</div>
										<div id="collapseTwo<?= $i?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="margin-left:">
											<div class="card-body">
												<?php echo $detailmenu[$i];?>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>





						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php include "config/footer.class.php"; ?>
	<?php include "config/js.class.php" ?>
</body>

</html>