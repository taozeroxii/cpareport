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
mysqli_set_charset($con, "utf8");
$sql = " SELECT * FROM cpareport_kpi_thip ";
$result = mysqli_query($con, $sql);
?>
<style>
.col-lg-2{padding-left:100px;}
</style>
<body>
  <table class="table  table-bordered  table-hover">
    <div class="header" style=' background-color: #0B5345;font:blod;'>
      <small>KPI THIP ABHAI BHUBAJHR HOSPITAL</small>
      <hr>
      <div class="row">
        <div class="col-lg-1 col-md-2 col-1 " style="margin-top:-30px;">NO. &nbsp;&nbsp;&nbsp;&nbsp; KPICODE</div>
        <div class="col-lg-9 col-md-7 col-10" style="margin-top:-30px;">KPI-NAME.</div>
        <div class="col-lg-2 col-md-3 col-1" style="margin-top:-30px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผล &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; B </div>
      </div>
    </div>
    <div class="main"></div>
    <tbody>
      <?php
      $rw == 0;
      foreach ($result as $item) {
        $kpiname  =  $item['kpi_name'];
        $kpicode  =  $item['kpi_code'];
        $rw++;
        ?>
    <tbody>
      <tr class='tr-hovers'>
        <th style="color:green"><?= '&nbsp;&nbsp;&nbsp' . $rw ?></th>
        <td style="text-align:center;"><?= $kpicode ?></td>
        <td><?= $kpiname  ?></td>
        <td style="text-align:center;">100.0</td>
        <td>100.0</td>
        <td>100.0</td>
        <td data-toggle="modal" data-target="#<?= $kpicode ?>"><button class="btn btn-danger">!</button></td>
      </tr>


      <!-- Modal -->
      <div class="modal fade" id="<?= $kpicode ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"><?= $kpicode ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </tbody>
  </table>






</body>

</html>