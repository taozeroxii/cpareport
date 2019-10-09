<!DOCTYPE html>
<html>
<?php 
include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/head.class.php"; 
include('config/my_con.class.php');
$bm = new Timer; 
$bm->start();
for( $i = 0 ; $i < 100000 ; $i++ )
{
 $i;
}
$sql            =  $_GET['sql'];
$send_excel     =  $_GET['sql'];
$topLevelItems  = " SELECT *  FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
  $sql_detail   = $item['sql_code'];
  $sql_detail_1 = $item['sql_subcode_1'];
  $sql_head     = $item['sql_head'];
  $menu_sub     = $item['menu_sub'];
}


$hdetail  = " SELECT * FROM cpareport_detail_list WHERE sql_id = '".$sql."' ";
$row=mysqli_query($con,$hdetail);
foreach($row as $item) {
  $text_0   = $item['sql_text_0'];
  $text_1   = $item['sql_text_1'];
  $text_2   = $item['sql_text_2'];
  $text_3   = $item['sql_text_3'];
  $text_4   = $item['sql_text_4'];
  $text_5   = $item['sql_text_5'];

}


?>
<body class="hold-transition skin-blue sidebar-mini">
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
         <?php echo $sql_head; ?>
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
                    <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                    <input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
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
        list($m,$d,$Y)  = split('/',$datepickers); 
        $datepickers    = trim($Y)."-".trim($m)."-".trim($d);

        $datepickert    = $_POST['datepickert'];
        list($m,$d,$Y)  = split('/',$datepickert); 
        $datepickert    = trim($Y)."-".trim($m)."-".trim($d);

        if($datepickers != "--" && $datepickert != "--") {
          $sql_a = " $sql_detail ";
          $sql_a = str_replace("{datepickers}", "'$datepickers'", $sql_a);
          $sql_a = str_replace("{datepickert}", "'$datepickert'", $sql_a);
          $result_a = pg_query($sql_a);
          $result_a = pg_query($sql_a);
          $row_result_a = pg_num_rows($result_a);
//echo $sql_a;
          $sql_b = " $sql_detail_1 ";
          $sql_b = str_replace("{datepickers}", "'$datepickers'", $sql_b);
          $sql_b = str_replace("{datepickert}", "'$datepickert'", $sql_b);
          $result_b = pg_query($sql_b);
          $row_result_b = pg_num_rows($result_b);
//echo $sql_b;
        //$total_sum = @($row_result_a['daa']/$row_result_b['dbb'])*100;
          ?>
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <div class="form-inline">
                    <?php echo $menu_sub; ?>
                    <?php echo "ข้อมูลวันที่ ".thaidate($datepickers)." - ".thaidate($datepickert); ?>&nbsp;
                    <small><?php echo " เวลาในการประมวลผล ".$bm->stop()." วินาที "; ?></small>&nbsp;&nbsp;
                    &nbsp;&nbsp;
                    <span class="pdx_s"><?php echo $text_0." ".$row_result_a ." คน  ";?></span>&nbsp;&nbsp; | | &nbsp;&nbsp;
                    <span class="pdx_s"><?php echo $text_1." ".$row_result_b ." คน  "; ?></span>
                    </div>
                  </div>
                </h3>
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
                      for ($j = 0 ; $j < $i ; $j++) {
                        $fieldname = pg_field_name($result_a, $j);
                        echo '<th>' . $fieldname . '</th>';
                      }
                      ?>
                    </tr> 
                  </thead>
                  <tbody>
                    <? $rw=0;
                    while($row_result = pg_fetch_array($result_a)) 
                    { 
                      $rw++;
                      ?>
                      <tr>
                        <?php
                        for ($j = 0 ; $j < $i ; $j++) {
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

<?php include"config/footer.class.php"; ?>
<?php include"config/js.class.php" ?>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>