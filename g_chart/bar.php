<?php

$conn = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
$conn = pg_connect($conn);
pg_set_client_encoding($con, "utf8");

if (pg_connect_errno($conn))
{
	echo "Failed to connect to DataBase: " . pg_connect_error();
}else
{

	$sql = " SELECT b.name AS bward,count(a.an) AS cc 
		FROM ipt AS a 
		INNER JOIN ward AS b ON b.ward = a.ward
		WHERE  regdate = CURRENT_DATE 
		GROUP BY bward 
		LIMIT 10 ";
	
	$result = pg_query($conn, $sql);
	$title = [];
	$value = [];
	if (pg_num_rows($result) > 0) {
		
		while($row = pg_fetch_assoc($result)) {
			$title[] = $row['bward'];
			$value[] = $row['cc'];
		}
	}

	pg_close($conn);
?>
<!DOCTYPE html>
<html style="height: 100%">
   <head>
       <meta charset="utf-8">
	  
   </head>
   <body>
       <div class="container">

	   <div id="report" style="width:100%;height: 370px"></div>
		
       <script type="text/javascript" src="echarts.min.js"></script>
	   
       <script type="text/javascript">
			var dom = document.getElementById("report");
			var myChart = echarts.init(dom);
			option = {
			    title: {
					text: 'รายงานแสดงยอดขายตามช่วงวัน',
					subtext: 'เวลา 8:00 น  ถึง 16:00 น.',
					left: 'center'
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
   </body>
</html>