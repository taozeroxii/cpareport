<!DOCTYPE html>
<html>
<?php
include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/head.class.php"; 
include('config/my_con.class.php');
session_start();
$bm = new Timer; 
$bm->start();
for( $i = 0 ; $i < 100000 ; $i++ )
{
  $i;
}
$sql    =  $_GET['sql'];
$topLevelItems = " SELECT * FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
  $sql_detail        = $item['sql_code'];
  $sql_head          = $item['sql_head'];
}
include "config/timestampviewer.php";//เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ
?>
<body class="hold-transition skin-blue sidebar-mini">
 
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <?php echo $sql_head; ?>
          <small><?php echo 'Viewer: '.$countview; ?></small>
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
        list($m,$d,$Y)  = explode('/',$datepickers); 
        $datepickers    = trim($Y)."-".trim($m)."-".trim($d);
        $datepickert    = $_POST['datepickert'];
        list($m,$d,$Y)  = explode('/',$datepickert); 
        $datepickert    = trim($Y)."-".trim($m)."-".trim($d);
        if($datepickers != "--") {
          $sql = " $sql_detail ";
          $sql = str_replace("{datepickers}", "'$datepickers'", $sql);
          $sql = str_replace("{datepickert}", "'$datepickert'", $sql);
          $result = pg_query($sql);
          
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title co_dep"><?php echo " ข้อมูลระหว่างวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
                <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
              </div>
            </div>
          </div>
        </div>
  <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-body">
              <table class="table" id="datatable">
               <thead>
                <tr>
                  <?php
                  $i = pg_num_fields($result);
                  for ($j = 0 ; $j < $i ; $j++) {
                    $fieldname = pg_field_name($result, $j);
                    echo '<th>' . $fieldname . '</th>';
                  }
                  ?>
                </tr> 
              </thead>
              <tbody>
                <? $rw=0;
                while($row_result = pg_fetch_array($result)) 
                { 
                  $rw++;
                  ?>
                  <tr>
                    <?php
                    for ($j = 0 ; $j < $i ; $j++) {
                      $fieldname = pg_field_name($result, $j);
                      echo '<td>' . $row_result[$fieldname] . '</td>';
                    } 
                    ?>
                  </tr>
                  <?php  
                }
                ?>                                   
              </tbody>
            </table>              
          </div>
        </div>
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