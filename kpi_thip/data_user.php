<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="js/echarts.min.js"></script> -->
  <!-- <script type="text/javascript" src="js/pdfobject.js"></script> -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>

<?php
date_default_timezone_set("Asia/Bangkok");
$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($con, "utf8");
$sql = "			
SELECT id,kpi_code,kpi_name FROM cpareport_kpi_thip   WHERE kpi_data_send = 'user' ";
$result = mysqli_query($con, $sql);
?>
<style>
  .col-lg-2 {
    padding-left: 70px;
  }

  #overlay {
    position: fixed;
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
  .dow{
    color: red;
  }
  .ddt{
    color: #99A3A4;
  }
  .hh-hh{
    color: #515A5A;
    font-size: 1.4em;
  }
</style>

<body style="font-family: 'Prompt', sans-serif;">
  <!-- id ใช้แสดงตัวโหลดหมุนๆบนหน้าจอ -->
  <!-- <div id="overlay"></div> -->
  <!-- --------------------------- -->

  <div class="main-contain">
    <div class="header" style="box-shadow:3px 3px 3px 3px rgba(0,0,0,0.5);background-color: #0B5345">
      เพิ่มข้อมูลตัวชี้วัด
      <hr>
      <div class="row">
        <!-- <div class="col-lg-1 col-md-2 col-1 " style="margin-top:-30px;">NO. &nbsp;&nbsp;&nbsp;&nbsp; KPICODE</div> -->
        <!-- <div class="col-lg-9 col-md-7 col-10" style="margin-top:-30px;">KPI-NAME.</div> -->
        <!-- <div class="col-lg-2 col-md-3 col-1" style="margin-top:-30px;"> ผล &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; B </div> -->
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
        $kpi_ym   =  $item['kpi_ym'];
        $a        = $item['kpi_cal_a'];
        $b        = $item['kpi_cal_b'];
        $c        = $item['kpi_cal_c'];
        $rw++;
        ?>
        <tbody>
          <tr class='tr-hovers'>
            <th style="color:green"><?= '&nbsp;&nbsp;&nbsp' . $rw ?></th>
            <td style="text-align:center;"><? echo $kpicode ?></td>
            <td><?= $kpiname . '  <span class="badge badge-primary badge-pill">' . $kpi_ym . '</span>'; ?> </td>
            <td data-toggle="modal" data-target="#<?= $kpicode ?>"><button class="btn btn-danger">เพิ่มข้อมูล</button></td>
            <td data-toggle="modal" data-target="#niyam<?= $kpicode ?>"><button class="btn btn-primary">นิยาม</button></td>

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
        $kpicode  =  $item['kpi_code'];

        ?>
        <div class="modal fade modal-xl" id="<?= $kpicode ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <center><h5 class="hh-hh"><?= $kpicode . ' : ' . $kpiname; ?> </h5></center>
                </div>
                <div class="modal-body">
                 <form action="" name="frmMain" id="frmMain" method="POST">
                  <label for="usr">Year<span class="dow"> * </span><span class="ddt">เลือก ปี ที่นำเข้าข้อมูล</span></label>
                  <?php
                  $currently_selected = date('Y'); 
                  $earliest_year = 2018; 
                  $latest_year = date('Y'); 
                  print '<select  class="form-control" id="kpi_year" name="kpi_year" >';
                  foreach ( range( $latest_year, $earliest_year ) as $i ) {
                    print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                  }
                  print '</select>';
                  ?>
                  <br>
                  <label for="usr" >Month<span class="dow"> * </span><span class="ddt"> เลือก เดือน ที่นำเข้าข้อมูล </span></label>
                  <select class="form-control" id="kpi_month" name="kpi_month">
                    <option value="01">มกราคม</option>
                    <option value="02">กุมภาพันธ์</option>
                    <option value="03">มีนาคม</option>
                    <option value="04">เมษายน</option>
                    <option value="05">พฤษภาคม</option>
                    <option value="06">มิถุนายน</option>
                    <option value="07">กรกฎาคม</option>
                    <option value="08">สิงหาคม</option>
                    <option value="09">กันยายน</option>
                    <option value="10">ตุลาคม</option>
                    <option value="11">พฤศจิกายน</option>
                    <option value="12">ธันวาคม</option>
                  </select> 

                  <br>

                  <input type="hidden" class="form-control" id="kpi_code" name="kpi_code" value="<?=$kpicode;?>">
                  <div class="form-group">
                    <label for="usr">A: <span class="dow"> * </span><span class="ddt"> ดูรายละเอียดได้จาก นิยาม</span></label>
                    <input type="number" class="form-control" id="kpi_a" placeholder="ระบุค่าตัวเลข a ">
                    <br>
                    <label for="usr">B: <span class="dow"> * </span><span class="ddt"> ดูรายละเอียดได้จาก นิยาม</span></label>
                    <input type="number" class="form-control" id="kpi_b" placeholder="ระบุค่าตัวเลข b ">
                    <br>
                    <center><button type="submit" id="btnSend" class="btn btn-info" data-dismiss="modal">เพิ่มข้อมูล</button></center>
                  </div>

                </form>

              </div>
           <!--    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div> -->
            </div>
          </div>
        </div>
      <? } ?>

      <!-- Script ทำการโหลดหนาเพจให้เสร็จก่อนแสดงผล-->
      <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
      <script type="text/javascript">
    /*    $(function() {
          $("#overlay").fadeOut();
          $(".main-contain").removeClass("main-contain");
        });
        */
      </script>
    </div>


    <script type="text/javascript">
    // $(document).ready(function() {      
    //   $("#btnSend").click(function() {
    //       $.ajax({
    //          type: "POST",
    //          url: "data_user_add.php",
    //          data: $("#frmMain").serialize(),
    //          success: function(result) {
    //           //console.log(data);
    //           if(result.status == 1) 
    //           {
    //             alert(result.message); 
    //               console.log(result);
    //           }
    //           else 
    //           {
    //             alert(result.message);
    //               console.log(result);
    //           }
    //          }
    //        });
    //   });

    // });


    $(document).ready(function(){
      $("#btnSend").click(function(){
        var kpi_year    =$("#kpi_year").val();
        var kpi_month   =$("#kpi_month").val();
        var kpi_code    =$("#kpi_code").val();
        var kpi_a       =$("#kpi_a").val();
        var kpi_b       =$("#kpi_b").val();
        $.ajax({
          url:'data_user_add.php',
          method:'POST',
          data:{
            kpi_year:kpi_year,
            kpi_month:kpi_month,
            kpi_code:kpi_code,
            kpi_a:kpi_a,
            kpi_b:kpi_b
          },
          success:function(data){
           alert(data);
         }
       });
      });
    });


  </script>

</body>
</html>