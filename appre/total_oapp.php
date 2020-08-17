<?php
include "../config/pg_con.class.php";
include "../config/func.class.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script src="images/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="images/standalo.css" />
	<link rel="stylesheet" type="text/css" href="images/tabs-acc.css" />
	<meta http-equiv="Content-Type" content="text/html;charset=windows-1252">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

</head>

<body>

<form class="w3-container" action="#" method="GET">
  <h2 class="mmm">รายการนัดตามคลินิก  | Refill | ยาไปรษณีย์ | เติมยา</h2>
  <input class="w3-input " name="sdate" id="sdate" type="date" required="required" type="" style="width:20%" placeholder="" title="เลือกระบุวันที่เริ่มต้น">
  <input class="w3-input " name="edate" id="edate"type="date" required="required" type="" style="width:20%" placeholder="" title="เลือกระบุวันที่สิ้นสุด"><br>
  <button class="button button2" type="submit" value="">ค้นหาข้อมูล</button>
</form>
<hr>
<?php 

$sdate	= $_GET['sdate'];
$edate	= $_GET['edate'];


IF(isset($sdate)) { ?>

<div class="mainh"> ข้อมูลช่วงวันที่&nbsp;&nbsp;<span class="ddd"> <?php echo thaidate($sdate)." -  ".thaidate($edate); ?><span> </div>


			<h2 class="hhh" title="คลิกดูรายการ"><?php echo $clinic; ?></h2>

			<div class="pane">
				<!-- <h3><?php// echo $clinic; ?></h3> -->
				<!-- <hr> -->
				<table>
					<tr >
                        <th class="trh">วันที่</th>	
                        <th class="trh">คลินิก</th>
						<th class="trh">รับยา Refill ครั้งที่ 1</th>
						<th class="trh">รับยา Refill ครั้งที่ 2</th>
						<th class="trh">รับยาไปรษณีย์ครั้งที่ 1</th>
						<th class="trh">รับยาไปรษณีย์ครั้งที่ 2</th>
						<th class="trh">เติมยาครั้งที่ 1</th>
						<th class="trh">เติมยาครั้งที่ 2</th>
						<th class="trh">เติมยาครั้งที่ 3</th>
						<th class="trh">รวม</th>
					</tr>
					<?php
					$sql2 = " SELECT o.nextdate
					,c.name AS clinic
					-- ,count(*) as total
	  ,SUM ( CASE WHEN  p.display_order = '79' THEN 1 ELSE 0 END ) AS  r1
	  ,SUM ( CASE WHEN  p.display_order = '80' THEN 1 ELSE 0 END ) AS  r2
	  ,SUM ( CASE WHEN  p.display_order = '74' THEN 1 ELSE 0 END ) AS  r3
	  ,SUM ( CASE WHEN  p.display_order = '75' THEN 1 ELSE 0 END ) AS  r4
	  ,SUM ( CASE WHEN  p.display_order = '81' THEN 1 ELSE 0 END ) AS  r5
	  ,SUM ( CASE WHEN  p.display_order = '82' THEN 1 ELSE 0 END ) AS  r6
	  ,SUM ( CASE WHEN  p.display_order = '83' THEN 1 ELSE 0 END ) AS  r7
	  ,SUM ( CASE WHEN  p.display_order in ('79','80','74','75','81','82','83') THEN 1 ELSE 0 END ) AS  r8
	  
FROM oapp as o
INNER JOIN clinic as c ON c.clinic = o.clinic
INNER JOIN oapp_cause as p on p.name = o.app_cause
WHERE 1 = 1
AND o.nextdate BETWEEN '$sdate' AND  '$edate'
-- AND c.name = '$clinic'
AND app_cause IN ('รับยา Refill ครั้งที่ 1','รับยา Refill ครั้งที่ 2','รับยาไปรษณีย์ครั้งที่ 1','รับยาไปรษณีย์ครั้งที่ 2','เติมยาครั้งที่ 1','เติมยาครั้งที่ 2','เติมยาครั้งที่ 3')
GROUP BY o.nextdate,c.name
ORDER BY c.name ASC ,o.nextdate DESC ";
					$result2 = pg_query($sql2);
						$rw = 0;
					while ($row_result2 = pg_fetch_array($result2)) {
						$rw++;

					?>
						<tr>
                            <td class="trdate"><?php echo thaidate($row_result2['nextdate']); ?></td>
                            <td class="trdate"><?php echo $row_result2['clinic']; ?></td>
							<td class="trd">
								<?php  $r1 = $row_result2['r1']; 
									   $rr1+=$r1;
									 if($r1 == "0"){
										 $r1 = "<span class='fff'>-</span>";
									 }
									 	$r1 = "<span class='ttt'>".$r1."</span>";
									 echo $r1;
								?>
							</td>
							<td class="trd">
								<?php  $r2 = $row_result2['r2']; 
									   $rr2+=$r2;
									 if($r2 == "0"){
										 $r2 = "<span class='fff'>-</span>";
									 }
									 	$r2 = "<span class='ttt'>".$r2."</span>";
									 echo $r2;
								?>
							</td>
							<td class="trd">
								<?php  $r3 = $row_result2['r3']; 
									   $rr3+=$r3;
									 if($r3 == "0"){
										 $r3 = "<span class='fff'>-</span>";
									 }
									 	$r3 = "<span class='ttt'>".$r3."</span>";
									 echo $r3;
								?>
							</td>
							<td class="trd">
								<?php  $r4 = $row_result2['r4']; 
									   $rr4+=$r4;
									 if($r4 == "0"){
										 $r4 = "<span class='fff'>-</span>";
									 }
									 	$r4 = "<span class='ttt'>".$r4."</span>";
									 echo $r4;
								?>
							</td>
							<td class="trd">
								<?php  $r5 = $row_result2['r5']; 
									   $rr5+=$r5;
									 if($r5 == "0"){
										 $r5 = "<span class='fff'>-</span>";
									 }
									 	$r5 = "<span class='ttt'>".$r5."</span>";
									 echo $r5;
								?>
							</td>
							<td class="trd">
								<?php  $r6 = $row_result2['r6'];
								 	   $rr6+=$r6;
									 if($r6 == "0"){
										 $r6 = "<span class='fff'>-</span>";
									 }
									 	$r6 = "<span class='ttt'>".$r6."</span>";
									 echo $r6;
								?>
							</td>
							<td class="trd">
								<?php  $r7 = $row_result2['r7']; 
									   $rr7+=$r7;
									 if($r7 == "0"){
										 $r7 = "<span class='fff'>-</span>";
									 }
									 	$r7 = "<span class='ttt'>".$r7."</span>";
									 echo $r7;
								?>
							</td>
							
							<td class="trtotal">
								<?php echo $r8 = $row_result2['r8']; 
										   $rr8+=$r8;
							?></td>
						</tr>
						
					<?php
					}

					?>
					<tr >
                        <td class="trhu"><span class="ss"><?php// echo $rw; ?> </span></td>
                        <td class="tru"><?php //echo $name; ?></td>
						<td class="tru"><?php echo $rr1; ?></td>
						<td class="tru"><?php echo $rr2; ?></td>
						<td class="tru"><?php echo $rr3; ?></td>
						<td class="tru"><?php echo $rr4; ?></td>
						<td class="tru"><?php echo $rr5; ?></td>
						<td class="tru"><?php echo $rr6; ?></td>
						<td class="tru"><?php echo $rr7; ?></td>
						<td class="trsum"><?php echo $rr8; ?></td>
					</tr>
				</table>
<br>
			</div>

		<?php
		$rr1=0;
		$rr2=0;
		$rr3=0;
		$rr4=0;
		$rr5=0;
		$rr6=0;
		$rr7=0;
		$rr8=0;
				

		}
		?>
	</div>
	<?php// } ?>


	
	<script>
		// $(function() {
		// 	$("#accordion").tabs("#accordion div.pane", {
		// 		tabs: 'h2',
		// 		effect: 'slide',
		// 		initialIndex: null
		// 	});
		// });
	</script>
</body>

</html>