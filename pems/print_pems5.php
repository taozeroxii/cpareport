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
	<link rel="stylesheet" type="text/css" href="css/print5.css">
</head>
<body>


<!-- 	<div class="div1">
		<div><?php// echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร"; ?></div>
		<div><?php// echo "เลขที่ 32/7 หมู่ 12 ตำบลท่างาม"; ?></div>
		<div><?php// echo "อำเภอเมือง จังหวัดปราจีนบุรี"; ?></div>
		<div><?php// echo "25000"; ?></div>
	</div> -->

<!-- 	<br>
	<br>
	<br>
	<div class="div2">
		<div><?php// echo "คุณ".$fname." ".$lname." (".$phone.")"; ?></div>
		<div><?php//echo "เลขที่ ".$adddess." หมู่ ".$moo." ตำบล".$district; ?></div>
		<div><?php// echo "อำเภอ".$amphoe." จังหวัด".$province; ?></div>
		<div><?php// echo $zipcode; ?></div>
	</div>
-->
<div class="1">
<div class="hh">
	 <div class="textAlignVer dd"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร"; ?></div>
	 <div class="textAlignVer cc"><?php echo "เลขที่ 32/7 หมู่ 12 ตำบลท่างาม"; ?></div>
	 <div class="textAlignVer bb"><?php echo "อำเภอเมือง จังหวัดปราจีนบุรี"; ?></div>
	 <div class="textAlignVer aa"><?php echo "25000"; ?></div>
</div>
</div>
<div class="div2">
<div class="hhh">
	 <div class="textAlignVer2 dd"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร"; ?></div>
	 <div class="textAlignVer2 cc"><?php echo "เลขที่ 32/7 หมู่ 12 ตำบลท่างาม"; ?></div>
	 <div class="textAlignVer2 bb"><?php echo "อำเภอเมือง จังหวัดปราจีนบุรี"; ?></div>
	 <div class="textAlignVer2 aa"><?php echo "25000"; ?></div>
</div>
</div>

</body>
</html>

<?php 


/*
$filel = $file;

$save = "pdf/".$filel.".pdf";
$lo   = "Location:pdf/".$filel.".pdf";

$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th','A5','0','THSaraban');
$pdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('css/print5.css');
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html,2);
$success = $pdf->Output($save);
header($lo);
die();
*/

?>