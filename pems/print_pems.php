<?php session_start();
ob_start();
date_default_timezone_set("Asia/Bangkok");
require_once('mpdf/mpdf.php');
include"config/my_con.class.php";
$fname      = $_POST['fname'];
$lname      = $_POST['lname'];
$adddess    = $_POST['adddess'];
$moo        = $_POST['moo'];
$district   = $_POST['district'];
$amphoe     = $_POST['amphoe'];
$province   = $_POST['province'];
$zipcode    = $_POST['zipcode'];
$phone       = $_POST['phone'];
$file       = $_POST['hn'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/print.css">
</head>
<body>


<div class="div3">
	<table style="border:1px #000000;"  bgcolor="#000000"><tr><td style="height: 70px; width: 150px;border:1px dashed white;" bgcolor="white" align="center">
		<div align="center" style="font-size: 12px"><?php echo "ชำระค่าฝากส่งเป็นรายเดือน" ?></div>
		<div align="center" style="font-size: 12px"><?php echo "ใบอนุญาตเลขที่ 27/2521" ?></div>
		<div align="center" style="font-size: 12px"><?php echo "ปทจ.ปราจีนบุรี" ?></div>
	</td></tr></table>
</div>
<div class="div4">
	<table style="border:1px #000000;"  bgcolor="#000000"><tr><td style="height: 100px; width: 200px; border:1px dashed white;" bgcolor="white" align="center">
		<div align="center" style="font-size: 25px"><?php echo "ยาและเวชภัณฑ์" ?></div>
		<div align="center" style="font-size: 14px"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร" ?></div>
		<div align="center" style="font-size: 14px"><?php echo "(หลีกเลี่ยงแสงแดดและความชื้น) (ระวังการกระแทก)" ?></div>
	</table>
</div>
	<div class="div1">
		<div style="font-size: 12px"><?php echo "ฝ่ายเภสัชกรรม"; ?></div>
		<div style="font-size: 12px"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร"; ?></div>
		<div style="font-size: 12px"><?php echo "เลขที่ 32/7 หมู่ 12 ตำบลท่างาม"; ?></div>
		<div style="font-size: 12px"><?php echo "อำเภอเมือง จังหวัดปราจีนบุรี"; ?></div>
		<div style="font-size: 12px"><?php echo "25000"; ?></div>
	</div>
	<div class="div2" >
		<div style="font-size: 15px"><?php echo "ชื่อที่อยู่ผู้รับ"; ?></div>
		<div style="font-size: 20px"><?php echo "คุณ".$fname." ".$lname." (".$phone.")"; ?></div>
		<div style="font-size: 20px"><?php echo "เลขที่ ".$adddess." หมู่ ".$moo." ตำบล".$district; ?></div>
		<div style="font-size: 20px"><?php echo "อำเภอ".$amphoe." จังหวัด".$province; ?></div>
		<div style="font-size: 20px"><?php echo $zipcode; ?></div>
	</div>
	<div class="div6">
		<div style="font-size: 15px"><?php echo "จำนวน ......... รายการ"; ?></div>
		<div style="font-size: 15px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หมายเลขพัสดุ 13 หลัก"; ?></div>
		<table style="border:1px #000000;"  bgcolor="#000000"><tr><td style="height: 120px; width: 240px; border:1px dashed white;" bgcolor="white" align="center">
		</table>

	</div>
	<div class="div5">
		<div align="center" style="font-size: 12px"><?php echo "รับรองที่อยู่ถูกต้อง"; ?></div>
		<br><br>
		<div style="font-size: 10px"><?php echo "ลงชื่อ ..................................................................."; ?></div>

	</div>



	

</body>
</html>

<?php 


//$filel = date('Y-m-d_His');
$filel = $file;

$save = "pdf/".$filel.".pdf";
$lo   = "Location:pdf/".$filel.".pdf";

$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th','A4','0','THSaraban');
$pdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('css/print.css');
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html,2);
$success = $pdf->Output($save);
header($lo);
die();


?>