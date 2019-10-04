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
  $sql_detail_2 = $item['sql_subcode_2'];
  $sql_head     = $item['sql_head'];
  $menu_sub     = $item['menu_sub'];
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

      if($datepickers != "--") {
        $sql_a = " $sql_detail ";
        $sql_a = str_replace("{datepickers}", "'$datepickers'", $sql_a);
        $sql_a = str_replace("{datepickert}", "'$datepickert'", $sql_a);
        $result_a = pg_query($sql_a);
        $row_result_a = pg_num_rows($result_a);

        $sql_b = " $sql_detail_1 ";
        $sql_b = str_replace("{datepickers}", "'$datepickers'", $sql_b);
        $sql_b = str_replace("{datepickert}", "'$datepickert'", $sql_b);
        $result_b = pg_query($sql_b);


        ?>

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <?php echo $menu_sub; ?>
                  <?php echo "ข้อมูลวันที่ ".thaidate($datepickers)." - ".thaidate($datepickert); ?>
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
                <!--<button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> SQL </button> -->
                <!-- <a href="config/excel.class.php?sql=<?php //echo $sql; ?>" class="btn btn-default pull-right" class="btn btn-info btn-lg" > Excel </a> -->
              </div>  
            </div>
          </div>
    </div>



    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
         <div class="box-body table-responsive ">   <?php if($sql   == 'sql_0121'){ echo '<span class="fcol">เบิกโลหิต</span>'; }else echo '<span class="fcol">สรุปสถิติ</span>';?> 
            <table id="example3" class="table table-bordered  table-hover table-striped ">
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
    

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
         <div class="box-body table-responsive "> <?php if($sql  == 'sql_0121'){ echo '<span class="fcol">จ่ายโลหิต</span>'; }else echo '<span class="fcol">ข้อมูลแบบละเอียด</span>';?>  
            <table id="example3" class="table table-bordered  table-hover table-striped ">
              <thead>
                <tr>
                  <?php
                  $i = pg_num_fields($result_b);
                  for ($j = 0 ; $j < $i ; $j++) {
                    $fieldname = pg_field_name($result_b, $j);
                    echo '<th>' . $fieldname . '</th>';
                  }
                  ?>
                </tr> 
              </thead>
              <tbody>
                <? $rw=0;
                while($row_result = pg_fetch_array($result_b)) 
                { 
                  $rw++;
                  ?>
                  <tr>
                    <?php
                    for ($j = 0 ; $j < $i ; $j++) {
                      $fieldname = pg_field_name($result_b, $j);
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
    $('#example3').DataTable()
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