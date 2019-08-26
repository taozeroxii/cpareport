<?php
 
        $connstring = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
        $conn = pg_connect($connstring);
        pg_set_client_encoding($conn, "utf8");
{
    $data_points = array();
    
    $result = pg_query($conn, " SELECT b.name,COUNT(*) AS c_pttype
                FROM ovst as a
                INNER JOIN pttype as b ON b.pttype = a.pttype 
                WHERE a.vstdate = CURRENT_DATE
                GROUP BY b.name
                 ");
    
    while($row = pg_fetch_array($result))
    {        
        $point = array("label" => $row['name'] , "y" => $row['c_pttype']);
        
        array_push($data_points, $point);        
    }
    
    $sss =  json_encode($data_points, JSON_NUMERIC_CHECK);
};
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "ทดสอบ กราฟ"
	},
	subtitles: [{
		text: "test"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "",
		dataPoints: <?php echo $sss; ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 600px; width: 100%;"></div>
<script src="js/canvasjs.min.js"></script>
</body>
</html>          