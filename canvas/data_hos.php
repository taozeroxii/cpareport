<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
 <?php
 include('data_sql.php');
  ?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		// text: "ข้อมูลการบริการในโรงพยาบาล"
	},	
	axisY: {
		// title: "Billions of Barrels",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		// title: "Millions of Barrels/day",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
			type: "column",
			name: "จำนวน visit (ครั้ง)",
			legendText: "visit",
			showInLegend: true, 
			dataPoints: <?php echo json_encode($visit, JSON_NUMERIC_CHECK); ?> 
		   }
		 ,
		  {
			type: "column",
			name: "จำนวน hn (ราย)",
			legendText: "hn",
			showInLegend: true, 
			dataPoints: <?php echo json_encode($hn, JSON_NUMERIC_CHECK); ?> 
		  }
		 ,
		  {
			type: "column",
			name: "จำนวน ยกเลิก visit (ครั้ง)",
			legendText: "ยกเลิก visit",
			showInLegend: true, 
			dataPoints: <?php echo json_encode($cancelvisit, JSON_NUMERIC_CHECK); ?> 
		  }
		  ,
		  {
			type: "column",
			name: "จำนวนการออก visit จาก kiosk (ครั้ง)",
			legendText: "kiosk",
			showInLegend: true, 
			dataPoints: <?php echo json_encode($kiosk_y, JSON_NUMERIC_CHECK); ?> 
		  }
		  ,
		  {
			type: "column",
			name: "จำนวนการออก visit จาก เจ้าหน้าที่เวชระเบียน (ครั้ง)",
			legendText: "user",
			showInLegend: true, 
			dataPoints: <?php echo json_encode($kiosk_n, JSON_NUMERIC_CHECK); ?> 
		  }
		  ]
	
	});
	chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
<link href="https://fonts.googleapis.com/css?family=Kanit|Mitr&display=swap" rel="stylesheet">
<style type="text/css">
	.chartContainer{
		font-family: 'Kanit', sans-serif;
		font-family: 'Mitr', sans-serif;
		height: 30%; 
		max-width: 70%; 
		margin: 10px auto; 
	}
</style>
</head>
<body>
<div class="chartContainer" id="chartContainer"></div>
<script src="js/canvasjs.min.js"></script>
</body>
</html>