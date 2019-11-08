<?php
date_default_timezone_set("Asia/Bangkok");
function thaiDate($datetime)
{
	if(!is_null($datetime))
	{
		list($date,$time) = split('T',$datetime);
		list($Y,$m,$d) = split('-',$date);
		$Y = $Y+543-2500;
		switch($m)
		{
			case "01":$m = "ม.ค."; break;
			case "02":$m = "ก.พ."; break;
			case "03":$m = "มี.ค."; break;
			case "04":$m = "เม.ย."; break;
			case "05":$m = "พ.ค."; break;
			case "06":$m = "มิ.ย."; break;
			case "07":$m = "ก.ค."; break;
			case "08":$m = "ส.ค."; break;
			case "09":$m = "ก.ย."; break;
			case "10":$m = "ต.ค."; break;
			case "11":$m = "พ.ย."; break;
			case "12":$m = "ธ.ค."; break;
		}
		return $d." ".$m." ".$Y."";
	}
	return "";
}
function thaiDateFULL($datetime)
{
	if(!is_null($datetime))
	{
		list($date,$time) = split('T',$datetime);
		list($Y,$m,$d) = split('-',$date);
		$Y = $Y+543;
		switch($m)
		{
			case "01":$m = "มกราคม"; break;
			case "02":$m = "กุมภาพันธ์"; break;
			case "03":$m = "มีนาคม"; break;
			case "04":$m = "เมษายน"; break;
			case "05":$m = "พฤษภาคม"; break;
			case "06":$m = "มิถุนายน"; break;
			case "07":$m = "กรกฎาคม"; break;
			case "08":$m = "สิงหาคม"; break;
			case "09":$m = "กันยายน"; break;
			case "10":$m = "ตุลาคม"; break;
			case "11":$m = "พฤศจิกายน"; break;
			case "12":$m = "ธันวาคม"; break;
		}
		return $d." ".$m." ".$Y."";
	}
	return "";
}

//$kpi_code = $_GET['kpi_code'];
$kpi_code = "DH0101";
$kpi_name = "อัตราการเสียชีวิตของผู้ป่วยโรคกล้ามเนื้อหัวใจตายเฉียบพลัน";
$conn = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
$sql = " SELECT * FROM cpareport_kpi_data WHERE kpi_code = '$kpi_code' ORDER BY kpi_ym DESC  ";
$result = mysqli_query($conn, $sql);
$row_show = mysqli_query($conn, $sql);

$title = [];
$value = [];
if (mysqli_num_rows($result) > 0) {	
	while($row = mysqli_fetch_assoc($result)) {
		$title[] = thaiDate($row['kpi_ym']);
		$value[] = $row['kpi_cal_c'];
	}
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html style="height: 100%">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/scss.css">
</head>
<body>
	<div class="container">
		<div id="report" style="width:100%;height: 370px"></div>
		<script type="text/javascript" src="js/echarts.min.js"></script>
		<script type="text/javascript">
			var dom = document.getElementById("report");
			var myChart = echarts.init(dom);
			option = {
				title: {
					text: '<?=$kpi_code;?>',
					subtext: '<?=$kpi_name;?>',
					left: 'center'
				},
				color: ['#3398DB'],
				tooltip : {
					trigger: 'axis',
					axisPointer : {           
						type : 'shadow'      
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis: {
					type: 'category',
					data: <?=json_encode($title);?>
				},
				yAxis: {
					type: 'value'
				},
				series: [{
					data:<?=json_encode($value);?>,
					type: 'bar'
				}]
			};
			;
			if (option && typeof option === "object") {
				myChart.setOption(option, true);
			}
		</script>
		<?php
		if (mysqli_num_rows($row_show) > 0) {?>
			<table>
				<tr>
					<th>รายการ</th>
					<th>ค่าตัวชี้วัด</th>
					<th>ตัวตั้ง A</th>
					<th>ตัวตั้ง B</th>
				</tr>
				<tr>
					<?php	while($row = mysqli_fetch_assoc($row_show)) {
						$ym = thaiDateFULL($row['kpi_ym']);
						$kca = $row['kpi_cal_a'];
						$kcb = $row['kpi_cal_b'];
						$kcc = $row['kpi_cal_c'];
						?>
						<td class="ym"><?php echo $ym; ?></td>
						<td class="kcc"><?php echo $kcc; ?></td>
						<td class="kca"><?php echo $kca; ?></td>
						<td class="kcb"><?php echo $kcb; ?></td>
					</tr>
					<?php	
				}
			}
			?>
		</table>
	</body>
	</html>