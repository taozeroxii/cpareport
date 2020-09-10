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
  <h2 class="mmm">รายการข้อมูลผู้รับบริการที่ชำระเงิน</h2>
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
                        <th class="trh">ลำดับรายการ</th>
                        <th class="trh">วันที่รับบริการ</th>	
                        <th class="trh">วันที่admit</th>
						<th class="trh">วันที่จำหน่าย</th>
						<th class="trh">vn</th>
						<th class="trh">hn</th>
						<th class="trh">an</th>
						<th class="trh">ประเภท</th>
						<th class="trh">ชื่อ สกุล</th>
						<th class="trh">สิทธิ</th>
						<th class="trh">จำนวนเงิน</th>
                        <th class="trh">เลขที่ใบเสร็จ</th>
                        <th class="trh">วันที่ออกใบเสร็จ</th>
                        <th class="trh">เวลาที่ออกใบเสร็จ</th>
					</tr>
					<?php
					$sql2 = " SELECT (CASE
                    WHEN r.department = 'OPD' THEN o.vstdate
                    ELSE i.vstdate
                END) AS วันที่รับบริการ,
             s.regdate AS วันที่admit,
               s.dchdate AS วันที่จำหน่าย,
                 (CASE
                    WHEN r.department = 'OPD' THEN o.vn
                    ELSE i.vn
                END) AS vn,
                  (CASE
                    WHEN r.department = 'OPD' THEN o.hn
                    ELSE i.hn
                END) AS hn,
                 s.an			 AS an,
           r.department AS ประเภท,
           CONCAT(p.pname,p.fname,'  ',p.lname) AS ชื่อ สกุล ,
           CONCAT(r.pttype,' | ',t.name) AS สิทธิ,
           r.total_amount AS จำนวนเงิน,
           CONCAT(r.book_number,' / ',r.bill_number) AS เลขที่ใบเสร็จ,
           r.bill_date AS วันที่ออกใบเสร็จ,
           r.bill_time AS เวลาที่ออกใบเสร็จ
    FROM rcpt_print AS r 
    LEFT JOIN ovst AS o ON o.vn = r.vn
    LEFT JOIN an_stat AS s ON s.an = r.vn
    LEFT JOIN ovst AS i ON i.an = s.an
    INNER JOIN pttype AS t ON t.pttype = r.pttype
    INNER JOIN patient AS p ON p.hn = r.hn
    WHERE 1 = 1
    AND DATE(r.bill_date_time) BETWEEN '$sdate' AND  '$edate'
    ORDER BY  r.department DESC ,r.bill_date_time DESC ";
					$result2 = pg_query($sql2);
                        $rw = 0;
                      //  echo $sql2;
					while ($row_result2 = pg_fetch_array($result2)) {
						$rw++;
					?>
						<tr>
                            <td class="trdate"><?php echo $rw; ?></td>
                            <td class="trdate"><?php echo thaidate($row_result2['วันที่รับบริการ']); ?></td>
                            <td class="trdate"><?php echo thaidate($row_result2['วันที่admit']); ?></td>
                            <td class="trdate"><?php echo thaidate($row_result2['วันที่จำหน่าย']); ?></td>
                            <td class="trdate"><?php echo $row_result2['vn']; ?></td>
                            <td class="trdate"><?php echo $row_result2['hn']; ?></td>
                            <td class="trdate"><?php echo $row_result2['an']; ?></td>
                            <td class="trdate"><?php echo $row_result2['ประเภท']; ?></td>
                            <td class="trdate"><?php echo $row_result2['ชื่อ สกุล']; ?></td>
                            <td class="trdate"><?php echo $row_result2['สิทธิ']; ?></td>
                            <td class="trdate"><?php echo $row_result2['จำนวนเงิน']; ?></td>
                            <td class="trdate"><?php echo $row_result2['เลขที่ใบเสร็จ']; ?></td>
                            <td class="trdate"><?php echo thaidate($row_result2['วันที่ออกใบเสร็จ']); ?></td>
                            <td class="trdate"><?php echo $row_result2['เวลาที่ออกใบเสร็จ']; ?></td>
                        <tr>
      
						
					<?php
                    }
                }
                    ?>

	
</body>
</html>