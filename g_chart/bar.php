<?php
 include('../config/pg_con.class.php');
 	if (!$conn) {
 		die("Connection failed: " . mysqli_connect_error());
 	}

	$sql = " SELECT b.name,COUNT(*) AS c_pttype
                FROM ovst as a
                INNER JOIN pttype as b ON b.pttype = a.pttype 
                WHERE a.vstdate = CURRENT_DATE
                GROUP BY b.name  ";
	$result = pg_query($conn, $sql);
	$title = [];
	$value = [];
	if (pg_num_rows($result) > 0) {
		
		while($row = pg_fetch_assoc($result)) {
			$title[] = $row['name'];
			$value[] = $row['c_pttype'];
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
		
       <script type="text/javascript" src="js/echarts.min.js"></script>
	   
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