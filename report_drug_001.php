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
$sql    =  $_GET['sql'];
$topLevelItems = " SELECT * FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
  $sql_detail        = $item['sql_code'];
  $sql_head          = $item['sql_head'];
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
        </a> 
      </nav>
    </header>
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1 class="">
          <?php// echo $sql_head; ?>
        </h1>
      </section>
      <section class="content">        
        <?php 
    
          $sql = " $sql_detail ";
          $result = pg_query($sql);
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title co_dep"> <?php echo $sql_head; ?> 
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
                <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
              </div>

              <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
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