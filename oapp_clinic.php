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
/*
$sql 		=  $_GET['sql'];
$send_excel =  $_GET['sql'];
$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
	$sql_detail = $item['sql_code'];
	$sql_head   = $item['sql_head'];
}
*/
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
											<input type="text" class="form-control" id="datepickers" placeholder="ช่วงวันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
											<input type="text" class="form-control" id="datepickert" placeholder="ถึงวันที่" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
											<!-- <select class="select2" name="cli_dropdown" id="cli_dropdown" style="width: 20%;" placeholder="คลินิก" title="เลือกคลินิก"></select> -->
											<button type="submit" class="btn btn-default">ค้นหาข้อมูล</button>
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

			//	$cli_dropdown   = $_POST['cli_dropdown'];    

				if($datepickers != "--") {
					$sql = " SELECT o.vstdate :: DATE as vdate,
                    SUM ( CASE WHEN  ap.clinic IS NOT NULL  THEN 1 ELSE 0 END ) AS  รวม,
                    SUM ( CASE WHEN  ap.clinic = '036' THEN 1 ELSE 0 END ) AS  คลินิกนรีเวชกรรม,
                    SUM ( CASE WHEN  ap.clinic = '061' THEN 1 ELSE 0 END ) AS  คลินิกอายุรกรรมโรคติดเชื้อ,
                    SUM ( CASE WHEN  ap.clinic = '022' THEN 1 ELSE 0 END ) AS  คลินิกโรคข้ออายุรกรรม,
                    SUM ( CASE WHEN  ap.clinic = '066' THEN 1 ELSE 0 END ) AS  คลินิกโรคพาร์กินสัน,
                    SUM ( CASE WHEN  ap.clinic = '050' THEN 1 ELSE 0 END ) AS  คลินิกโรคพาร์กินสัน TTM,
                    SUM ( CASE WHEN  ap.clinic = '023' THEN 1 ELSE 0 END ) AS  คลินิกโรคทางเดินอาหาร,
                    SUM ( CASE WHEN  ap.clinic = '001' THEN 1 ELSE 0 END ) AS  คลินิกเบาหวาน,
                    SUM ( CASE WHEN  ap.clinic = '003' THEN 1 ELSE 0 END ) AS  คลินิกมะเร็ง,
                    SUM ( CASE WHEN  ap.clinic = '025' THEN 1 ELSE 0 END ) AS  คลินิกโรคเลือด,
                    SUM ( CASE WHEN  ap.clinic = '084' THEN 1 ELSE 0 END ) AS  คลินิกโรคเลือด ธาลัสซีเมีย,
                    SUM ( CASE WHEN  ap.clinic = '020' THEN 1 ELSE 0 END ) AS  คลินิกโรคหัวใจ,
                    SUM ( CASE WHEN  ap.clinic = '052' THEN 1 ELSE 0 END ) AS  คลินิกเลิกบุหรี่,
                    SUM ( CASE WHEN  ap.clinic = '094' THEN 1 ELSE 0 END ) AS  ห้องตรวจคลินิกระบบทางเดินหายใจ ARI Clinic,
                    SUM ( CASE WHEN  ap.clinic = '056' THEN 1 ELSE 0 END ) AS  คลินิกเลิกสุรา,
                    SUM ( CASE WHEN  ap.clinic = '088' THEN 1 ELSE 0 END ) AS  คลินิกส่องกล้องหลอดลม,
                    SUM ( CASE WHEN  ap.clinic = '005' THEN 1 ELSE 0 END ) AS  คลินิกหอบหืด Ashma,
                    SUM ( CASE WHEN  ap.clinic = '079' THEN 1 ELSE 0 END ) AS  คลินิกพยาบาลชุมชน,
                    SUM ( CASE WHEN  ap.clinic = '075' THEN 1 ELSE 0 END ) AS  คลินิกอาชีวเวชกรรม,
                    SUM ( CASE WHEN  ap.clinic = '021' THEN 1 ELSE 0 END ) AS  คลินิกอายุรกรรม,
                    SUM ( CASE WHEN  ap.clinic = '047' THEN 1 ELSE 0 END ) AS  คลินิกเวชกรรมฟื้นฟู,
                    SUM ( CASE WHEN  ap.clinic = '086' THEN 1 ELSE 0 END ) AS  คลินิกอายุรกรรม ธาลัสซีเมีย,
                    SUM ( CASE WHEN  ap.clinic = '060' THEN 1 ELSE 0 END ) AS  คลินิกอายุรกรรม14,
                    SUM ( CASE WHEN  ap.clinic = '009' THEN 1 ELSE 0 END ) AS  คลินิกไตเทียม HD,
                    SUM ( CASE WHEN  ap.clinic = '085' THEN 1 ELSE 0 END ) AS  ตรวจทั่วไป GP,
                    SUM ( CASE WHEN  ap.clinic = '058' THEN 1 ELSE 0 END ) AS  ตรวจพิเศษหัวใจและหลอดเลือด,
                    SUM ( CASE WHEN  ap.clinic = '032' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรมหลอดเลือด,
                    SUM ( CASE WHEN  ap.clinic = '077' THEN 1 ELSE 0 END ) AS  คลินิกโรคปอด,
                    SUM ( CASE WHEN  ap.clinic = '042' THEN 1 ELSE 0 END ) AS  คลินิกเด็กโรคเลือด,
                    SUM ( CASE WHEN  ap.clinic = '083' THEN 1 ELSE 0 END ) AS  คลินิกระงับปวด,
                    SUM ( CASE WHEN  ap.clinic = '049' THEN 1 ELSE 0 END ) AS  คลินิกโรคสะเก็ดเงิน,
                    SUM ( CASE WHEN  ap.clinic = '073' THEN 1 ELSE 0 END ) AS  SMC กุมารเวชกรรมทั่วไป,
                    SUM ( CASE WHEN  ap.clinic = '037' THEN 1 ELSE 0 END ) AS  คลินิกตรวจครรภ์,
                    SUM ( CASE WHEN  ap.clinic = '038' THEN 1 ELSE 0 END ) AS  คลินิกนมแม่,
                    SUM ( CASE WHEN  ap.clinic = '041' THEN 1 ELSE 0 END ) AS  คลินิกสูติกรรม,
                    SUM ( CASE WHEN  ap.clinic = '063' THEN 1 ELSE 0 END ) AS  คลินิกหลังคลอด,
                    SUM ( CASE WHEN  ap.clinic = '057' THEN 1 ELSE 0 END ) AS  คลินิก MMT,
                    SUM ( CASE WHEN  ap.clinic = '090' THEN 1 ELSE 0 END ) AS  คลินิกโครงการโรคหัวใจเด็ก,
                    SUM ( CASE WHEN  ap.clinic = '092' THEN 1 ELSE 0 END ) AS  คลินิกตรวจการนอนหลับ PSG,
                    SUM ( CASE WHEN  ap.clinic = '026' THEN 1 ELSE 0 END ) AS  คลินิกเท้าเบาหวาน,
                    SUM ( CASE WHEN  ap.clinic = '013' THEN 1 ELSE 0 END ) AS  คลินิกเบาหวานจอตา,
                    SUM ( CASE WHEN  ap.clinic = '044' THEN 1 ELSE 0 END ) AS  คลินิกภูมิแพ้เด็ก,
                    SUM ( CASE WHEN  ap.clinic = '059' THEN 1 ELSE 0 END ) AS  คลินิกโรคตับ,
                    SUM ( CASE WHEN  ap.clinic = '007' THEN 1 ELSE 0 END ) AS  คลินิกโรคไต CKD,
                    SUM ( CASE WHEN  ap.clinic = '093' THEN 1 ELSE 0 END ) AS  คลินิกสังคมสงเคราะห์,
                    SUM ( CASE WHEN  ap.clinic = '033' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรมกระดูก,
                    SUM ( CASE WHEN  ap.clinic = '076' THEN 1 ELSE 0 END ) AS  คลินิกทันตกรรม,
                    SUM ( CASE WHEN  ap.clinic = '034' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรมกระดูกข้อเข่าและสะโพก,
                    SUM ( CASE WHEN  ap.clinic = '067' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมโรคทางเดินอาหารและทั่วไป,
                    SUM ( CASE WHEN  ap.clinic = '055' THEN 1 ELSE 0 END ) AS  คลินิกยาเสพติด,
                    SUM ( CASE WHEN  ap.clinic = '019' THEN 1 ELSE 0 END ) AS  คลินิกลานสายตา,
                    SUM ( CASE WHEN  ap.clinic = '006' THEN 1 ELSE 0 END ) AS  คลินิกวัณโรค TB,
                    SUM ( CASE WHEN  ap.clinic = '016' THEN 1 ELSE 0 END ) AS  คลินิกวัดแว่น,
                    SUM ( CASE WHEN  ap.clinic = '027' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรม,
                    SUM ( CASE WHEN  ap.clinic = '087' THEN 1 ELSE 0 END ) AS  คลินิกส่องกล้องทางเดินอาหาร,
                    SUM ( CASE WHEN  ap.clinic = '046' THEN 1 ELSE 0 END ) AS  คลินิกหู คอ จมูก,
                    SUM ( CASE WHEN  ap.clinic = '070' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมโรคสมองและประสาท,
                    SUM ( CASE WHEN  ap.clinic = '074' THEN 1 ELSE 0 END ) AS  คลินิกประกันสังคม 304,
                    SUM ( CASE WHEN  ap.clinic = '068' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมโรคหัวใจและทั่วไป,
                    SUM ( CASE WHEN  ap.clinic = '035' THEN 1 ELSE 0 END ) AS  คลินิกข้อไหล่และเวชศาสตร์การกีฬา,
                    SUM ( CASE WHEN  ap.clinic = '081' THEN 1 ELSE 0 END ) AS  คลินิกประกันสังคม,
                    SUM ( CASE WHEN  ap.clinic = '051' THEN 1 ELSE 0 END ) AS  คลินิกฝังเข็ม,
                    SUM ( CASE WHEN  ap.clinic = '002' THEN 1 ELSE 0 END ) AS  คลินิกความดันโลหิตสูง,
                    SUM ( CASE WHEN  ap.clinic = '004' THEN 1 ELSE 0 END ) AS  คลินิกปอดอุดกั้นเรื้อรัง COPD,
                    SUM ( CASE WHEN  ap.clinic = '053' THEN 1 ELSE 0 END ) AS  คลินิกจิตเวช ฝึกพูด,
                    SUM ( CASE WHEN  ap.clinic = '010' THEN 1 ELSE 0 END ) AS  คลินิกจิตเวชเด็ก,
                    SUM ( CASE WHEN  ap.clinic = '011' THEN 1 ELSE 0 END ) AS  คลินิกจิตเวชผู้ใหญ่,
                    SUM ( CASE WHEN  ap.clinic = '024' THEN 1 ELSE 0 END ) AS  คลินิกประสาทอายุรศาสตร์,
                    SUM ( CASE WHEN  ap.clinic = '080' THEN 1 ELSE 0 END ) AS  คลินิกศาลาไทย,
                    SUM ( CASE WHEN  ap.clinic = '028' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรมตกแต่ง,
                    SUM ( CASE WHEN  ap.clinic = '030' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรมทางเดินปัสสาวะ,
                    SUM ( CASE WHEN  ap.clinic = '029' THEN 1 ELSE 0 END ) AS  คลินิกศัลยกรรมประสาท,
                    SUM ( CASE WHEN  ap.clinic = '048' THEN 1 ELSE 0 END ) AS  คลินิกการแพทย์แผนไทย,
                    SUM ( CASE WHEN  ap.clinic = '054' THEN 1 ELSE 0 END ) AS  คลินิก Harm Reduction,
                    SUM ( CASE WHEN  ap.clinic = '078' THEN 1 ELSE 0 END ) AS  คลินิกรังสีวิทยา,
                    SUM ( CASE WHEN  ap.clinic = '045' THEN 1 ELSE 0 END ) AS  คลินิกพัฒนาการและพฤติกรรมเด็ก,
                    SUM ( CASE WHEN  ap.clinic = '008' THEN 1 ELSE 0 END ) AS  คลินิกล้างไตทางช่องท้อง CAPD,
                    SUM ( CASE WHEN  ap.clinic = '043' THEN 1 ELSE 0 END ) AS  คลินิกกุมารเวชกรรม,
                    SUM ( CASE WHEN  ap.clinic = '039' THEN 1 ELSE 0 END ) AS  คลินิกก่อนสมรส,
                    SUM ( CASE WHEN  ap.clinic = '040' THEN 1 ELSE 0 END ) AS  คลินิกรักษาผู้มีบุตรยากและผ่าตัดเพื่อเจริญพันธุ์,
                    SUM ( CASE WHEN  ap.clinic = '062' THEN 1 ELSE 0 END ) AS  คลินิกวัยทอง,
                    SUM ( CASE WHEN  ap.clinic = '064' THEN 1 ELSE 0 END ) AS  คลินิกวางแผนครอบครัว,
                    SUM ( CASE WHEN  ap.clinic = '065' THEN 1 ELSE 0 END ) AS  คลินิกส่องกล้องขยายปากมดลูก,
                    SUM ( CASE WHEN  ap.clinic = '069' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมทั่วไป,
                    SUM ( CASE WHEN  ap.clinic = '072' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมโรคติดเชื้อและทั่วไป,
                    SUM ( CASE WHEN  ap.clinic = '014' AND ap.an = ''  THEN 1 ELSE 0 END ) AS  คลินิกROP OPD,
                    SUM ( CASE WHEN  ap.clinic = '014' AND ap.an <> '' THEN 1 ELSE 0 END ) AS  คลินิกROP IPD,
                    SUM ( CASE WHEN  ap.clinic = '017' THEN 1 ELSE 0 END ) AS  คลินิกกระจกตา,
                    SUM ( CASE WHEN  ap.clinic = '091' THEN 1 ELSE 0 END ) AS  คลินิกกัญชาทางการแพทย์,
                    SUM ( CASE WHEN  ap.clinic = '015' THEN 1 ELSE 0 END ) AS  คลินิกจอประสาทตา,
                    SUM ( CASE WHEN  ap.clinic = '012' THEN 1 ELSE 0 END ) AS  คลินิกจักษุ,
                    SUM ( CASE WHEN  ap.clinic = '089' THEN 1 ELSE 0 END ) AS  คลินิกตรวจสมรรถภาพทางปอด,
                    SUM ( CASE WHEN  ap.clinic = '018' THEN 1 ELSE 0 END ) AS  คลินิกต้อหิน,
                    SUM ( CASE WHEN  ap.clinic = '082' THEN 1 ELSE 0 END ) AS  คลินิกนอกเวลา,
                    SUM ( CASE WHEN  ap.clinic = '095' THEN 1 ELSE 0 END ) AS  หน่วยเคมีบำบัด,
                    SUM ( CASE WHEN  ap.clinic = '096' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมโรคเลือด,
                    SUM ( CASE WHEN  ap.clinic = '071' THEN 1 ELSE 0 END ) AS  SMC อายุรกรรมโรคไต





       FROM oapp AS ap
       INNER JOIN patient as p ON p.hn = ap.hn 
       INNER JOIN ovst AS o ON o.hn = ap.hn AND ap.nextdate = o.vstdate
       INNER JOIN clinic AS c ON c.clinic = ap.clinic
       INNER JOIN kskdepartment AS k ON k.depcode = ap.depcode
       WHERE o.vstdate BETWEEN '$datepickers' AND '$datepickert'
       GROUP BY vdate 
       ORDER BY vdate ASC  ";
					$result = pg_query($sql);
					?>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep"><?php echo " ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert)." || ".$cccc; ?> 
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
			document.location = "export_excel_c.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>&cli_dropdown=<?php echo $cli_dropdown; ?>";
		}
	</script>


</body>
</html>