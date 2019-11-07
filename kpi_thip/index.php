<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php 
date_default_timezone_set("Asia/Bangkok");
$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($con,"utf8");
$sql = " SELECT * FROM cpareport_kpi_thip ";
$result = mysqli_query($con, $sql);
?>
<body>

  <div class="header">KPI THIP ABHAI BHUBAJHR HOSPITAL</div>
<div class="main">
  <div class="row">
    <div class="col-12 menu">
      <ul>
        <?php
        $rw == 0;
        foreach ($result as $item) {
          $kpiname  =  $item['kpi_name'];
          $kpicode  =  $item['kpi_code'];
          $rw++;
          ?>

          <li><span class=""  data-toggle="modal" data-target="#<?php echo $kpicode;?>"><?php echo $kpicode."  ".$kpiname;?></span></li>

<div class="modal fade" id="<?php echo $kpicode;?>" role="dialog">
    <div class="modal-dialog modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="modal_kpi_code"><?php echo $kpicode;?></span> <sup><span class="modal_kpi_name"><?php echo $kpiname;?></span></sup></h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

        <?php } ?>
      </ul>
    </div>

    <div class="col-9">
      <h1>kpi</h1>
      <p>test</p>
      <p>test</p>
    </div>
  </div>
  </div>



</body>
</html>
