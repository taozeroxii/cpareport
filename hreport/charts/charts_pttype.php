<?php
include('db.php');
?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title> </title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="js/loader.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([ ['pttype_name ','c_pttype'],
 <?php 
			$query = "SELECT CONCAT(a.pttype,' | ',b.name ) pttype_name,COUNT(*) AS c_pttype
                FROM ovst as a
                INNER JOIN pttype as b ON b.pttype = a.pttype 
                WHERE a.vstdate = CURRENT_DATE
                GROUP BY pttype_name 
                ORDER BY c_pttype DESC ";

			 $exec = pg_query($conn,$query);
			 while($row = pg_fetch_array($exec)){

			 echo "['".$row['pttype_name']."',".$row['c_pttype']."],";
			 }
			 ?> 
 
 ]);

 var options = {
// title: 'Number of Students according to their class',
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.PieChart(document.getElementById("pttype_cur"));
 chart.draw(data,options);
 }
	
    </script>

</head>
<!-- 
<body>
 <div class="container-fluid">
 <div id="pttype_cur" style="width: 100%; height: 500px;"></div>
 </div>

</body> -->

</html>