<!DOCTYPE html>
<html>
<?php include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
$bm = new Timer;
$bm->start();
include "config/head.class.php";
for ($i = 0; $i < 100000; $i++) {
  $i;
}
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="#" class="logo">
        <span class="logo-mini"><b>r</b>CPA</span>
        <span class="logo-lg"><b>Re</b>port Hospital</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </nav>
    </header>
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="row-12">
          <h3> DH0103 อัตราผู้ป่วยโรคกล้ามเนื้อหัวใจตายเฉียบพลัน ที่ได้รับ Aspirin เมื่อจำหน่ายออกจาก รพ. <?php if ($_POST['submit'] != "") {
                                                                                                            echo 'วันที่ ' . thaidate($datepickers) . ' ถึง ';
                                                                                                          } ?> <?php if ($_POST['submit'] != "") {
                                                                                                                                                                                                        echo thaidate($datepickert);
                                                                                                                                                                                                      } ?> </h3>
        </div>
        <hr>
      </section>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="querydh0103.php">
                    <input type="text" class="form-control" id="datepickers" placeholder="วันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off">
                    <input type="text" class="form-control" id="datepickert" placeholder="วันที่สิ้นสุด" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off">
                    <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
                  </form>

                </div>
              </h3>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              อัตราเสียชีวิตผู้ป่วย AMI
              <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">SQL</button>
              <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2">นิยาม</button>
            </h3>
          </div>
          <div class="box-body table-responsive">
            <div> สูตรในการคำนวณ (a / b x 100) <sup class="pdx_s"> * Principal Diagnosis (PDX) </sup></div>
            <div> a = จำนวนครั้งของการจำหน่ายด้วยการเสียชีวิตของผู้ป่วย AMI จากทุกหอผู้ป่วย <span class="pdx"> pdx = I21.0,I21.1,I21.2,I21.3,I21.4,I21.9 </span></div>
            <div> b = จำนวนครั้งของการจำหน่ายดทุกสถานะของผู้ป่วยในช่วงเวลาเดียวกัน <span class="pdx"> pdx = I21.0,I21.1,I21.2,I21.3,I21.4,I21.9 </span></div>
          </div>
        </div>
      </div>
      <hr>

      <?php

      $datepickers    = $_POST['datepickers'];
      list($m, $d, $Y)  = split('/', $datepickers);
      $datepickers    = trim($Y) . "-" . trim($m) . "-" . trim($d);
      $datepickert    = $_POST['datepickert'];
      list($m, $d, $Y)  = split('/', $datepickert);
      $datepickert    = trim($Y) . "-" . trim($m) . "-" . trim($d);

      if ($datepickers != "--") {
        $sql = " select distinct op.an,ipt.regdate as regis_date,ipt.dchdate as dischart_date,
                  ans.pdx,ans.dx0,ans.dx1,ans.dx2,ans.dx3,ans.dx4,ans.dx5
                  from opitemrece op
                  inner join ipt ipt on ipt.an = op.an
                  inner join an_stat ans on op.an = ans.an
                  where op.icode in ('1000417','1000101','1001187','1000474','1000110')
                  AND ans.pdx in('I210','I211','I212','I213','I214','I219') 
                  AND ipt.dchtype not in ('08','09')
                  AND ipt.dchdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                  order by ipt.dchdate
                  ";
        $sql2 = " select distinct op.an,ipt.regdate as regis_date,ipt.dchdate as dischart_date,
                  ans.pdx,ans.dx0,ans.dx1,ans.dx2,ans.dx3,ans.dx4,ans.dx5
                  from opitemrece op
                  inner join ipt ipt on ipt.an = op.an
                  inner join an_stat ans on op.an = ans.an
                  where  ans.pdx in('I210','I211','I212','I213','I214','I219') 
                  AND ipt.dchtype not in ('08','09')
                  AND ipt.dchdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                  order by ipt.dchdate
                  ";

        $result = pg_query($sql);
        $result2 = pg_query($sql2);
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title co_dep"><?php echo "ข้อมูลช่วงวันที่ " . thaiDatefull($datepickers) . " ถึงวันที่ " . thaiDatefull($datepickert) ?>
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
                </h3>
              </div>
              <div class="box-body">
                <?php $getdata = array();
                if ($_POST['submit'] != "") { ?>
                  <table class="table table-striped " style='text-align:center'>
                    <thead>
                      <tr>
                        <th style='text-align:center'>AN</th>
                        <th style='text-align:center'>วันเข้า</th>
                        <th style='text-align:center'>วันออก</th>
                        <th style='text-align:center'>PDX</th>
                        <th style='text-align:center'>DX0</th>
                        <th style='text-align:center'>DX1</th>
                        <th style='text-align:center'>DX2</th>
                        <th style='text-align:center'>DX3</th>
                        <th style='text-align:center'>DX4</th>
                        <th style='text-align:center'>DX5</th>
                        <th style='text-align:center'>ได้รับ Aspirin</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      while ($row_result = pg_fetch_array($result)) {
                        $countan += 1;
                        array_push($getdata, $row_result['an']); //เก็บค่า an จากการ fetch sql ลงในarray เพื่อเอาไปเทียบค่า
                      }
                      $length = count($getdata);
                      //echo $getdata[1];
                      ?>
                      <?php while ($row_result2 = pg_fetch_array($result2)) { ?>
                        <tr>
                          <td><?php echo  $row_result2['an'];
                              $countanall += 1; ?> </td>
                          <td><?php echo  $row_result2['regis_date']; ?></td>
                          <td><?php echo  $row_result2['dischart_date']; ?></td>
                          <td><?php echo  $row_result2['pdx']; ?></td>
                          <td><?php echo  $row_result2['dx0']; ?></td>
                          <td><?php echo  $row_result2['dx1']; ?></td>
                          <td><?php echo  $row_result2['dx2']; ?></td>
                          <td><?php echo  $row_result2['dx3']; ?></td>
                          <td><?php echo  $row_result2['dx4']; ?></td>
                          <td><?php echo  $row_result2['dx5']; ?></td>
                          <td><span class="<?php for ($i = 0; $i < $length; $i++) if ($getdata[$i] == $row_result2['an']) {
                                              echo 'glyphicon glyphicon-ok';
                                            } ?>"></span></td>
                        <?php }
                    } ?>
                    </tr>

                  </tbody>
                </table>
              </div>

              <?php if ($_POST['submit'] != "" && $countan != '') { ?>
                <div class="row">
                  <div class="col-4" style='text-align:center'>
                    <h3> ยอดผู้ป่วยได้รับ Aspirin <?php echo $countan; ?> คน </h3>
                  </div>
                  <div class="col-4" style='text-align:center'>
                    <h3> ผู้ป่วยรับบริการทั้งหมด <?php echo $countanall; ?> คน </h3>
                  </div>
                  <div class="col-4" style='text-align:center'>
                    <h3> แปลผล <?php echo number_format(($countan / $countanall) * 100, 2); ?></h3>
                  </div>
                </div>
              <?php } ?>
            </div>



          </div>
        </div>
      </div>
    </div>
  <?php
}
?>

  <!--///////////////////////////////////////////// Modal รับ///////////////////////////////////////////////////////-->
  <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          SQL Query ตามสรุป admit และจับจากข้อมูลค่าใช้จ่ายทั้งหมด ใส่วันที่เริ่มและสิ้นสุดที่ต้องการลงไป
        </div>

        <div class="model-body ml-5 mt-2">
          <p><mark>QUERY ผู้เสียชีวิตของผู้ป่วย AMI ที่อายุมากกว่า 18 ปี PDX(21.0-21.9)</mark></p>
          select * <br>
          from ipt ipt <br>
          inner join iptdiag iptd on ipt.an = iptd.an and iptd.icd10 <br>
          in('I210','I211','I212','I213','I214','I219') <br>
          and iptd.diagtype = '1' <br>
          inner join an_stat ans on ipt.an = ans.an and age_y >= '18'<br>
          where ipt.dchdate BETWEEN '" .<?php echo $datepickers; ?> . "' and '" . <?php echo $datepickert ?>. "'<br>
          and ipt.dchtype in ('08','09') <br>

          <hr>
          <p><mark>QUERY จำนวนผู้ป่วยทุกสถานะ PDX(21.0-21.9)</mark></p>
          select distinct op.an,ipt.regdate as regis_date,ipt.dchdate as dischart_date,ans.age_y,<br>
          ans.pdx,ans.dx0,ans.dx1,ans.dx2,ans.dx3,ans.dx4,ans.dx5<br>
          from opitemrece op<br>
          inner join ipt ipt on ipt.an = op.an<br>
          inner join an_stat ans on op.an = ans.an<br>
          where ans.pdx in('I210','I211','I212','I213','I214','I219')<br>
          AND ipt.dchdate BETWEEN '<?php echo $datepickers; ?>' and '<?php echo  $datepickert; ?>'<br>
          order by ipt.dchdate<br>

        </div>

        <div class="modal-footer">

        </div>
      </div>

    </div>
  </div>
  <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

  <div class="modal fade bd-example-modal-xl" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          นิยาม
        </div>

        <div class="model-body ml-5 mt-2">
          <img src="image/dh0103.jpg" alt="โหลดรูปไม่สำเร็จ" width="95%">
        </div>

        <div class="modal-footer">

        </div>
      </div>

    </div>
  </div>
  </section>
  </div>


  <?php include "config/footer.class.php"; ?>
  <?php include "config/js.class.php" ?>
  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })
    })
  </script>
</body>

</html>