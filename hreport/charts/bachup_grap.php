<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(pie_chart);
    google.charts.setOnLoadCallback(column_chart);
    google.charts.setOnLoadCallback(bar_chart);
    google.charts.setOnLoadCallback(line_chart);
      
    function pie_chart() {
      var jsonData = $.ajax({
          url: "pie_chart.php",
          dataType: "json",
          async: false
          }).responseText;
      var data = new google.visualization.DataTable(jsonData);
      var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
      chart.draw(data, {width: 400, height: 240});
    }

    function column_chart() {	
		var jsonData = $.ajax({
			url: 'charts_death.php',
    		dataType:"json",
    		async: false,
			success: function(jsonData)
				{
					var data = new google.visualization.arrayToDataTable(jsonData);	
        			var chart = new google.visualization.ColumnChart(document.getElementById('charts_death'));
					chart.draw(data);
					
				}	
			}).responseText;
  }
    </script>
 
   </head>
   
  <body>
   <div style="font: 21px arial; padding: 10px 0 0 100px;">Column Chart</div>
	<div id="charts_death" style="width: 900px; height: 300px;"></div>
  </body>
</html> 