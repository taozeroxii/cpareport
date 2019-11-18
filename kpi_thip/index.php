<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/echarts.min.js"></script>
  <script type="text/javascript" src="js/pdfobject.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
date_default_timezone_set("Asia/Bangkok");
function thaiDate($datetime)
{
  if (!is_null($datetime)) {
    list($date, $time) = split('T', $datetime);
    list($Y, $m, $d) = split('-', $date);
    $Y = $Y + 543 - 2500;
    switch ($m) {
      case "01":
        $m = "ม.ค.";
        break;
      case "02":
        $m = "ก.พ.";
        break;
      case "03":
        $m = "มี.ค.";
        break;
      case "04":
        $m = "เม.ย.";
        break;
      case "05":
        $m = "พ.ค.";
        break;
      case "06":
        $m = "มิ.ย.";
        break;
      case "07":
        $m = "ก.ค.";
        break;
      case "08":
        $m = "ส.ค.";
        break;
      case "09":
        $m = "ก.ย.";
        break;
      case "10":
        $m = "ต.ค.";
        break;
      case "11":
        $m = "พ.ย.";
        break;
      case "12":
        $m = "ธ.ค.";
        break;
    }
    return $d . " " . $m . " " . $Y . "";
  }
  return "";
}
function thaiDateFULL($datetime)
{
  if (!is_null($datetime)) {
    list($date, $time) = split('T', $datetime);
    list($Y, $m, $d) = split('-', $date);
    $Y = $Y + 543;
    switch ($m) {
      case "01":
        $m = "มกราคม";
        break;
      case "02":
        $m = "กุมภาพันธ์";
        break;
      case "03":
        $m = "มีนาคม";
        break;
      case "04":
        $m = "เมษายน";
        break;
      case "05":
        $m = "พฤษภาคม";
        break;
      case "06":
        $m = "มิถุนายน";
        break;
      case "07":
        $m = "กรกฎาคม";
        break;
      case "08":
        $m = "สิงหาคม";
        break;
      case "09":
        $m = "กันยายน";
        break;
      case "10":
        $m = "ตุลาคม";
        break;
      case "11":
        $m = "พฤศจิกายน";
        break;
      case "12":
        $m = "ธันวาคม";
        break;
    }
    return $d . " " . $m . " " . $Y . "";
  }
  return "";
}
$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($con, "utf8");
$sql = "			
SELECT ct.id,ct.kpi_code,kpi_name,kpi_cal_a,kpi_cal_b,kpi_cal_c,kpi_ym,kpi_dateupdate 
FROM cpareport_kpi_thip ct  
left join  cpareport_kpi_data cd on cd.kpi_code = ct.kpi_code and kpi_ym = (SELECT max(kpi_ym) FROM cpareport_kpi_data )
where ct.kpi_event is null
UNION
SELECT ct.id,ct.kpi_code,kpi_name,kpi_cal_a,kpi_cal_b,kpi_cal_c,kpi_ym,kpi_dateupdate 
FROM cpareport_kpi_thip ct  
left join  cpareport_kpi_data cd on cd.kpi_code = ct.kpi_code and kpi_ym = (SELECT max(kpi_ym) FROM cpareport_kpi_data )
where ct.kpi_event = '1'
UNION ALL 
SELECT ct.id ,ct.kpi_code,kpi_name,cd.kpi_cal_a,cd.kpi_cal_b,cd.kpi_cal_c,cd.kpi_ym,cd.kpi_dateupdate 
FROM cpareport_kpi_thip ct  
left join  cpareport_kpi_data cd on cd.kpi_code = ct.kpi_code and kpi_ym = 
(SELECT max(kpi_ym) FROM cpareport_kpi_data cd inner join cpareport_kpi_thip ct on ct.kpi_code = cd.kpi_code where ct.kpi_event = '6')
where ct.kpi_event ='6'
order by id ";
$result = mysqli_query($con, $sql);
?>


    <style>
      .col-lg-2 {
        padding-left: 70px;
      }

      #overlay {
        position: absolute;
        top: 0px;
        left: 0px;
        background: #ccc;
        width: 100%;
        height: 100%;
        opacity: .75;
        filter: alpha(opacity=75);
        -moz-opacity: .75;
        z-index: 999;
        background: #fff url(http://i.imgur.com/KUJoe.gif) 50% 50% no-repeat;
      }

      .main-contain {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        overflow: hidden;
      }
    </style>


    <body style="font-family: 'Prompt', sans-serif;">
      <!-- id ใช้แสดงตัวโหลดหมุนๆบนหน้าจอ -->
      <div id="overlay"></div>
      <!-- --------------------------- -->

      <div class="main-contain">
        <div class="header" style="box-shadow:3px 3px 3px 3px rgba(0,0,0,0.5);background-color: #0B5345">
          KPI THIP ABHAI BHUBAJHR HOSPITAL
          <hr>
          <div class="row">
            <div class="col-lg-1 col-md-2 col-1 " style="margin-top:-30px;">NO. &nbsp;&nbsp;&nbsp;&nbsp; KPICODE</div>
            <div class="col-lg-9 col-md-7 col-10" style="margin-top:-30px;">KPI-NAME.</div>
            <div class="col-lg-2 col-md-3 col-1" style="margin-top:-30px;"> ผล &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; B </div>
          </div>
        </div>
        <div class="main"></div>
      </div>

      <table class="table table-bordered">
        <tbody>
          <?php
          $rw == 0;
          foreach ($result as $item) {
            $kpiname  =  $item['kpi_name'];
            $kpicode  =  $item['kpi_code'];
            $kpi_ym =  $item['kpi_ym'];
            $a = $item['kpi_cal_a'];
            $b = $item['kpi_cal_b'];
            $c = $item['kpi_cal_c'];
            $rw++;
            ?>
        <tbody>
          <tr class='tr-hovers'>
            <th style="color:green"><?= '&nbsp;&nbsp;&nbsp' . $rw ?></th>
            <td style="text-align:center;"><? echo $kpicode ?></td>
            <td><?= $kpiname . '  <span class="badge badge-primary badge-pill">' . $kpi_ym . '</span>'; ?> </td>
            <td style="text-align:center;"><? if ($a && $b != null) echo $c; else echo 'NULL'; ?></td>
            <td><? if ($a != null) echo $a; else echo 'NULL'; ?></td>
            <td><? if ($b != null) echo $b;else echo 'NULL'; ?></td>
            <td data-toggle="modal" data-target="#niyam<?= $kpicode ?>"><button class="btn btn-primary">?</button></td>
            <td data-toggle="modal" data-target="#<?= $kpicode ?>"><button class="btn btn-danger">!</button></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>


      <!-- Modal image-->
      <? foreach ($result as $item) {
        $kpiname  =  $item['kpi_name'];
        $kpicode  =  $item['kpi_code']; ?>
        <div class="modal fade modal-xl" id="niyam<?= $kpicode ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5><?= $kpicode . ' : ' . $kpiname; ?> </h5>
              </div>
              <div class="modal-body">
                <img src="PDF_THIP/imagethip/<?= $kpicode ?>.jpg" alt="" width="100%">
                <img src="PDF_THIP/imagethip/<?= $kpicode ?>-0.jpg" alt="" width="100%">
                <img src="PDF_THIP/imagethip/<?= $kpicode ?>-1.jpg" alt="" width="100%">
              </div>
              <div class="modal-footer">
                <div id="pdfplace<?= $kpicode; ?>"> ไม่ได้ติดตั้งโปรแกรม Adobe Reader หรือบราวเซอร์ไม่รองรับการแสดงผล PDF <a href="PDF_THIP/<?= $kpicode ?>.pdf" target="blank">คลิกที่นี้เพื่อดาวน์โหลดไฟล์ PDF</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <? } ?>

      <!-- Modal chart-->
      <? foreach ($result as $item) {
        $kpiname  =  $item['kpi_name'];
        $kpicode  =  $item['kpi_code']; ?>
        <div class="modal fade modal-xl" id="<?= $kpicode ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5><?= $kpicode . ' : ' . $kpiname; ?> </h5>
              </div>
              <div class="modal-body">
                <center>
                  <div id="report<?= $kpicode ?>" style="width:800px;height: 200px"></div>
                </center>
                <hr>
                <?php
                  $sqlchart = " SELECT * FROM cpareport_kpi_data WHERE kpi_code = '$kpicode' ORDER BY kpi_ym   limit 10";
                  $resultsqlchart = mysqli_query($con, $sqlchart);
                  $title = [];
                  $value = [];
                  if (mysqli_num_rows($resultsqlchart) > 0) {
                    while ($row = mysqli_fetch_assoc($resultsqlchart)) {
                      $title[] = thaiDateFULL($row['kpi_ym']);
                      $value[] = $row['kpi_cal_c'];
                    }
                  }
                  ?>

                <script type="text/javascript">
                  var dom = document.getElementById("report<?= $kpicode ?>");
                  var myChart = echarts.init(dom);
                  option = {
                    title: {
                      text: '<?= $kpicode; ?>',
                      subtext: '<?= $kpiname; ?>',
                      left: 'center'
                    },
                    color: ['#3398DB'],
                    tooltip: {
                      trigger: 'axis',
                      axisPointer: {
                        type: 'shadow'
                      }
                    },
                    grid: {
                      left: '3%',
                      right: '4%',
                      bottom: '3%',
                      containLabel: true
                    },
                    xAxis: {
                      type: 'category',
                      data: <?= json_encode($title); ?>
                    },
                    yAxis: {
                      type: 'value'
                    },
                    series: [{
                      data: <?= json_encode($value); ?>,
                      type: 'bar'
                    }]
                  };;
                  if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                  }
                </script>

                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">รายการ</th>
                      <th scope="col">ค่าตัวชี้วัด</th>
                      <th scope="col">ตัวตั้ง A</th>
                      <th scope="col">ตัวหาร B</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                      $sql = " SELECT * FROM cpareport_kpi_data WHERE kpi_code = '$kpicode' ORDER BY kpi_ym DESC limit 10 ";
                      $result1 = mysqli_query($con, $sql);
                      foreach ($result1 as $resultkpi) {
                        ?>
                      <tr>
                        <th scope="row"><? echo thaiDateFULL($resultkpi['kpi_ym']); ?></th>
                        <td><? echo $resultkpi['kpi_cal_c']; ?></td>
                        <td><? echo $resultkpi['kpi_cal_a']; ?></td>
                        <td><? echo $resultkpi['kpi_cal_b']; ?></td>
                      </tr>
                    <? } ?>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <? } ?>

      <!-- Script ทำการโหลดหนาเพจให้เสร็จก่อนแสดงผล-->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script type="text/javascript">
        $(function() {
          $("#overlay").fadeOut();
          $(".main-contain").removeClass("main-contain");
        });
      </script>
      </div>


    </body>

</html>