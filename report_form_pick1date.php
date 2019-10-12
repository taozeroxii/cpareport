<!DOCTYPE html>
<html>
<?php
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/head.class.php";
include('config/my_con.class.php');
session_start();
$bm = new Timer;
$bm->start();
for ($i = 0; $i < 100000; $i++) {
  $i;
}
$sql            =  $_GET['sql'];
$sql1            =  $_GET['sql'];
$send_excel     =  $_GET['sql'];
$topLevelItems  = " SELECT *  FROM cpareport_sql WHERE sql_file = '" . $sql . "'";
$res = mysqli_query($con, $topLevelItems);
foreach ($res as $item) {
  $sql_detail   = $item['sql_code'];
  $sql_detail_1 = $item['sql_subcode_1'];
  $sql_detail_2 = $item['sql_subcode_2'];
  $sql_head     = $item['sql_head'];
  $menu_sub     = $item['menu_sub'];
}
include "config/timestampviewer.php";//เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ

?>

<body class="hold-transition skin-blue sidebar-mini">
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <?php echo $sql_head; ?>
          <?php echo '<small>Viewer: '.$countview.'</small>';//แสดงยอดผู้เข้า sql นั้นๆ ?>
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="#">
                      <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off">
                      <button type="submit" class="btn btn-default">ตกลง</button>
                    </form>

                  </div>
                </h3>
              </div>
            </div>
          </div>
        </div>
        <?php
        $datepickers    = $_POST['datepickers'];
        list($m, $d, $Y)  = split('/', $datepickers);
        $datepickers    = trim($Y) . "-" . trim($m) . "-" . trim($d);



        if ($datepickers != "--") {
          $sql_a = " $sql_detail ";
          $sql_a = str_replace("{datepickers}", "'$datepickers'", $sql_a);
          $result_a = pg_query($sql_a);
          $result_a = pg_query($sql_a);
          $row_result_a = pg_num_rows($result_a);

          $sql = " $sql_detail_1 ";
          $sql = str_replace("{datepickers}", "'$datepickers'", $sql);
          $result = pg_query($sql);
          $total = pg_num_rows($result);
          ?>

          <div class="row">
            <div class="col-xs-9">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    <?php echo $menu_sub; ?>
                    <?php echo "ข้อมูลวันที่ " . thaidate($datepickers); ?>&nbsp;
                    <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>&nbsp;&nbsp;
                  </h3>
                  &nbsp;&nbsp;
                  ผู้ป่วยในโรค <span class="pdx_s"><?php echo $row_result_a . " คน  "; ?></span>&nbsp;&nbsp;
                  ผู้ป่วยทั้งหมด <span class="pdx"><?php echo $total . " คน  "; ?></span>
                </div>
              </div>
            </div>

            <div class="col-xs-3">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                  </h3>
                  <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> SQL </button>&nbsp;&nbsp;
                  <button type="" class="btn btn-default pull-right" onclick="export_excel()">  Excel </button>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered  table-hover table-striped ">
                    <thead>
                      <tr>
                        <?php
                          $i = pg_num_fields($result_a);
                          for ($j = 0; $j < $i; $j++) {
                            $fieldname = pg_field_name($result_a, $j);
                            echo '<th>' . $fieldname . '</th>';
                          }
                          ?>
                      </tr>
                    </thead>
                    <tbody>
                      <? $rw = 0;
                        while ($row_result = pg_fetch_array($result_a)) {
                          $rw++;
                          ?>
                        <tr>
                          <?php
                              for ($j = 0; $j < $i; $j++) {
                                $fieldname = pg_field_name($result_a, $j);
                                echo '<td>' . $row_result[$fieldname] . '</td>';
                              }
                              ?>
                        </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
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

    <script type="text/javascript">
      function export_excel() {
        document.location = "export_excel_k22.php?send_excel=<?php echo $send_excel; ?>
        &datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>
        &diag_1=<?php echo $diag_1; ?>&diag_2=<?php echo $diag_2; ?>";
      }
    </script>
</body>

</html>