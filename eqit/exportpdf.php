<?php session_start();
ob_start();
require_once('mpdf/mpdf.php');
date_default_timezone_set('asia/bangkok');
$connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($connect, "utf8");
$verprinter   = DATE('Y-m-d H:i:s');
$flien   = MD5(DATE('Y-m-d H:i:s'));
function DateThai($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strMonthCut = array("", ",มกราคม", "กุมภาพันธ์", "มีนาคม", "้มษายน", "พฤษภาคม", "มิถุนายน.", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$strMonthThai = $strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}
$mini_name     = $_GET['mini_name'];
$todateth   = DATE('Y-m-d');
$selectaddresspt = " SELECT * FROM eqit_mini_data WHERE 1=1 AND mini_name = '$mini_name' AND end_date IS NULL ORDER BY id DESC Limit 1";
$qq = mysqli_query($connect, $selectaddresspt);
$row = mysqli_fetch_array($qq);

$sqlup = " UPDATE eqit_mini_data  SET eq_file = '$flien' WHERE mini_name = '$mini_name' ";
$que = mysqli_query($connect, $sqlup);

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<!-- <link rel="stylesheet" type="text/css" href="css/spdf.css"> -->
</head>

<body>
	<center>
		<h3>แบบฟอร์มยืมใช้เครื่อง MiniKiosk <sup><?php echo "PrintFormTime:" . $verprinter."(JobID : ".$row['id'].")"; ?></sup></h3>
	</center>
	<hr>


	<span>วันที่ <?php echo DateThai($row['eq_datestart']); ?></span>

	<hr>


	<table style="width:100%">
		<tr>
			<td style="width:50%">ข้าพเจ้า (ผู้ยืม)&nbsp;&nbsp;&nbsp;<u><?php echo $row['eq_fname']; ?> <?php echo $row['eq_lname']; ?></u></td>
			<td style="width:50%">ตำแหน่ง&nbsp;&nbsp;&nbsp;<u><?php echo $row['eq_position']; ?></u></td>

		</tr>
		<tr>
			<td style="width:50%">กลุ่มงาน&nbsp;&nbsp;&nbsp;<u><?php echo $row['eq_position']; ?></u></td>
			<td style="width:50%">เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;<u><?php echo $row['eq_tel']; ?></u></td>

		</tr>
		<tr>
			<td style="width:50%">ได้ยืม Mini Kiosk&nbsp;&nbsp;&nbsp;<u>จำนวน 1 ชุด</u></td>
			<td style="width:50%">ชื่อเครื่อง&nbsp;&nbsp;&nbsp;<u><?php echo $row['mini_name']; ?></u></td>

		</tr>
		<tr>
			<td>เพื่อ&nbsp;&nbsp;&nbsp;<u><?php echo $row['eq_note']; ?></u></td>
			<td>ตั้งแต่วันที่&nbsp;&nbsp;&nbsp;<u><?php echo DateThai($row['eq_datestart']); ?></u></td>

		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>
				<center>ลงชื่อ...........................................ผู้ยืม</center>
			</td>
			<td>
				<center>ลงชื่อ..............................................เจ้าหน้าที่</center>
			</td>
		</tr>

		<tr>
			<td>
				<center><?php echo $row['eq_fname'] . " " . $row['eq_lname']; ?></center>
			</td>
			<td>
				<center><?php echo $row['eq_fsend']; ?></center>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;<center>ลงชื่อ.........................................ผู้ส่งคืน/ผู้ยืม</center>
			</td>
			<td>&nbsp;ความเห็นของเจ้าหน้าที่</td>
		</tr>
		<tr>
			<td>&nbsp;<center>..........................................</center>
			</td>
			<td>&nbsp;[ / ] ควรอนุมัติให้ยืม</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;[   ] ไม่สามารถให้ยืมได้ เนื่องจาก...........................</td>
		</tr>

	</table>
	<br><br>

	<hr>

</body>

</html>
<?php



$save = "pdf/" . $flien . ".pdf";
$lo   = "Location:" . $save;

$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetDisplayMode('fullpage');
// $stylesheet = file_get_contents('css/spdf.css');
$pdf->WriteHTML($stylesheet, 1);
$pdf->WriteHTML($html, 2);
$success = $pdf->Output($save);
header($lo);
die();



?>