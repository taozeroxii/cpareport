<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(pie_chart);
    google.charts.setOnLoadCallback(column_chart);
    google.charts.setOnLoadCallback(charts_admit);
    google.charts.setOnLoadCallback(charts_dsc);
    google.charts.setOnLoadCallback(bar_chart);
    google.charts.setOnLoadCallback(line_chart);

    function column_chart() { 
      var jsonData = $.ajax({
        url: 'charts/charts_death.php',
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

    function charts_admit() { 
      var jsonData = $.ajax({
        url: 'charts/charts_admit.php',
        dataType:"json",
        async: false,
        success: function(jsonData)
        {
          var data = new google.visualization.arrayToDataTable(jsonData); 
          var chart = new google.visualization.ColumnChart(document.getElementById('charts_admit'));
          chart.draw(data);
          
        } 
      }).responseText;
    }

    function charts_dsc() { 
      var jsonData = $.ajax({
        url: 'charts/charts_dsc.php',
        dataType:"json",
        async: false,
        success: function(jsonData)
        {
          var data = new google.visualization.arrayToDataTable(jsonData); 
          var chart = new google.visualization.ColumnChart(document.getElementById('charts_dsc'));
          chart.draw(data);
          
        } 
      }).responseText;
    }

  </script>
</head>
<?php 

$todate2 = date('m');
$todate3 = date('Y')+543;
$todate4 = date('Y')+1+543;
$todate5 = date('Y')-1+543;

if ($todate2 > '10') {
$betweentodate =   "ระหว่างเดือน ตุลาคม ".$todate3." ถึง กันยายน ".$todate4;
} else {
$betweentodate =   "ระหว่างเดือน ตุลาคม ".$todate5." ถึง กันยายน ".$todate3;
}
 $yd = $betweentodate;
 ?> 

<div class="modal fade" id="myModal_rt_death" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">จำนวนผู้ป่วยเสียชีวิต <?php echo $yd;?> <sup class="sutt"></sup></h4>
      </div>
      <div class="modal-body">
        <center><div id="charts_death"></div></center>
        <hr>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal_rt_admit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">จำนวนผู้ป่วยAdmit <?php echo $yd;?> <sup class="sutt"></sup></h4>
      </div>
      <div class="modal-body">
        <center><div id="charts_admit"></div></center>
        <hr>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal_rt_dsc" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">จำนวนผู้ป่วยจำหน่าย <?php echo $yd;?> <sup class="sutt"></sup></h4>
      </div>
      <div class="modal-body">
        <center><div id="charts_dsc"></div></center>
        <hr>
      </div>
    </div>
  </div>
</div>