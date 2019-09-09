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
  </script>
  <style type="text/css">


  </style>
</head>


<div class="modal fade" id="myModal_rt_death" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">จำนวนผู้ป่วยเสียชีวิต แยกตามเดือน ตุลาคม 2561 - ปัจจุบัน <sup class="sutt"></sup></h4>
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
        <h4 class="modal-title text-center">จำนวนผู้ป่วย ADMIT แยกตามหอผู้ป่วย <sup class="sutt"></sup></h4>
      </div>
      <div class="modal-body">
        <center>
         <!--  <div id="charts_admit"></div> -->
         
        </center>
        <hr>
      </div>
    </div>
  </div>
</div>