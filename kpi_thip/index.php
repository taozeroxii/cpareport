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
$sql = "SELECT ct.kpi_code,kpi_name,kpi_cal_a,kpi_cal_b,kpi_ym,kpi_dateupdate FROM cpareport_kpi_thip ct  left join  cpareport_kpi_data cd on cd.kpi_code = ct.kpi_code and kpi_ym = (SELECT max(kpi_ym) FROM cpareport_kpi_data )";
$result = mysqli_query($con, $sql);
?>
<style>
  .col-lg-2 {
    padding-left: 100px;
  }
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
        $kpi_ym =  $item['kpi_ym'];
        $a = $item['kpi_cal_a'];
        $b = $item['kpi_cal_b'];
        $rw++;
        ?>
    <tbody>
      <tr class='tr-hovers'>
        <th style="color:green"><?= '&nbsp;&nbsp;&nbsp' . $rw ?></th>
        <td style="text-align:center;"><?echo $kpicode ?></td>
        <td><?= $kpiname; echo '<sub>  '.$kpi_ym.'</sub>'; ?> </td>
        <td style="text-align:center;"><?if($a && $b!= null) echo number_format(($a/$b)*100,2) ;else echo 'NULL';?></td>
        <td><?if($a != null) echo $a;else echo 'NULL';?></td>
        <td><?if($b != null) echo $b;else echo 'NULL';?></td>
        <td data-toggle="modal" data-target="#<?= $kpicode ?>"><button class="btn btn-danger">!</button></td>
      </tr>


      <!-- Modal -->
      <div class="modal fade modal-xl" id="<?= $kpicode ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"><?= $kpicode ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?
                $sql = " SELECT * FROM cpareport_kpi_data WHERE kpi_code = '$kpicode' ORDER BY kpi_ym DESC  ";
                $result1 = mysqli_query($con, $sql);
                $resultMd = mysqli_fetch_assoc($result1);

                echo 'ปี '.$resultMd['kpi_ym'];
                echo '<br>a '.$resultMd['kpi_cal_a'];
                echo '<br>b '.$resultMd['kpi_cal_b'];
                ?>
                
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