<!DOCTYPE html>
<html>
<?php
include('config/pg_con.class.php');
include('config/func.class.php');
include('config/time.class.php');
include('config/head.class.php'); 
include('config/my_con.class.php');
session_start();
$bm = new Timer; 
$bm->start();
for( $i = 0 ; $i < 100000 ; $i++ )
{
	$i;
}

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

				<?php 

                    $sdate =  $_GET['s'];
                    $edate =  $_GET['e'];

					$sql = " SELECT a.vstdate,a.vn,a.hn,p.pname,p.fname,p.lname,b.name as rightname ,d.name as doctorname
                    ,string_agg(DISTINCT ic.code , ' || ') AS icd10
                    ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '02' ) as ค่าอวัยวะเทียมและอุปกรณ์ในการบำบัดรักษาโรค		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '03' ) as ค่ายาในบัญชียาหลักแห่งชาติ			
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '05' ) as ค่าเวชภัณฑ์ที่มิใช่ยา		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '06' ) as ค่าบริการโลหิตและส่วนประกอบของโลหิต		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '07' ) as ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '08' ) as ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา	
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '09' ) as ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '10' ) as ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์	
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '11' ) as ค่าทำหัตถการ และวิสัญญี		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '12' ) as ค่าบริการทางพยาบาล		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '13' ) as ค่าบริการทางทันตกรรม		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '14' ) as ค่าบริการทางกายภาพบำบัดและทางเวชกรรมฟื้นฟู		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '15' ) as ค่าบำบัดรักษาและฟื้นฟูสมรรถภาพด้วยวิธีการทางแพทย์แผนไทย		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '16' ) as ค่าบริการอื่น ๆ ที่ไม่เกี่ยวกับการรักษาพยาบาลโดยตรง		
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '17' ) as ค่ายานอกบัญชียาหลัก	
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn AND income = '18' ) as ค่าธรรมเนียมทางการแพทย์ ร่วมจ่าย 30 บาท			
                   ,(SELECT ROUND(SUM(gg.sum_price),2) as amont_total 	FROM opitemrece as gg WHERE gg.vn = a.vn 
                       AND income IN ('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20')	 ) as sumprice		          
                    FROM opitemrece as a
                    INNER JOIN ovst as e on e.vn = a.vn
                    INNER JOIN vn_stat as v on v.vn = e.vn
                    left join icd101 as ic on ic.code = v.pdx 
                    INNER JOIN patient as p on p.hn = a.hn
                    INNER JOIN pttype as b ON b.pttype = a.pttype
                    INNER JOIN kskdepartment as c ON c.depcode = a.dep_code
                    INNER JOIN doctor as d ON d.code = e.doctor 
                    WHERE 1 = 1
                    AND a.vstdate BETWEEN '$sdate' and '$edate'
                    AND ic.code BETWEEN  'E100' AND 'E149'
                    GROUP BY a.vstdate,a.vn,a.hn,p.pname,p.fname,p.lname,b.name,d.name
                    ORDER BY a.vstdate ASC ";
					$result = pg_query($sql);
					?>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title co_dep"><?php echo " ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
									<small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
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
</body>
</html>