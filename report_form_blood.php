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
                    <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                    <input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                    <?php if($_GET['sql']== 'sql_0214'){?>
                    <label>&nbsp; กลุ่ม lab</label>
                    <select class="select2" name="l_dropdown[]" id="l_dropdown" multiple="multiple" style="width: 20%;"></select>
                    <?php }?>
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

      $l_dropdown         = $_POST['l_dropdown'];//กลุ่ม lab


      if($datepickers != "--") {
        $sql_a = " $sql_detail ";
        $sql_a = str_replace("{datepickers}", "'$datepickers'", $sql_a);
        $sql_a = str_replace("{datepickert}", "'$datepickert'", $sql_a);

        $sql_b = " $sql_detail_1 ";
        $sql_b = str_replace("{datepickers}", "'$datepickers'", $sql_b);
        $sql_b = str_replace("{datepickert}", "'$datepickert'", $sql_b);

          // วนค่าเพิ่อแทนที่ตัวแปร  
          if (sizeof($l_dropdown) > 0) {
            $sum_r = "(";
            foreach ($l_dropdown as $value) {
                $sum_r .= "'" . $value . "',";
            }
            $sum_r = rtrim($sum_r, ',');
            $sum_r .= ") ";
         } else {
           if(  $l_dropdown  != '' ||   $l_dropdown   != null){
            $selectLabgroup = 'SELECT lab_id FROM lab_items_group';
            $querylabGroup= pg_query($selectLabgroup);
           
            $sum_r = "(";
            while ($resultksk = pg_fetch_assoc($querylabGroup)) {
                $sum_r .= "'" . $resultksk['lab_id'] . "',";
            }
            $sum_r = rtrim($sum_r, ',');
            $sum_r .= ")";
          }
            $sql_a = str_replace("{lab_group}", "$sum_r", $sql_a);
            $sql_b = str_replace("{lab_group}", "$sum_r", $sql_b);
          }
           $sql_a = str_replace("{lab_group}", "$sum_r", $sql_a);
           $sql_b = str_replace("{lab_group}", "$sum_r", $sql_b);
           $result_a = pg_query($sql_a);
           $result_b = pg_query($sql_b);
           $row_result_a = pg_num_rows($result_a);
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
         <div class="box-body table-responsive ">   
           <?php 
            if($_GET['sql']  == 'sql_0121'){ echo '<span class="fcol">เบิกโลหิต</span>'; }
            if($_GET['sql']  == 'sql_0214'){ echo '<span class="fcol">นับจำนวนสั่ง lab แต่ละ item เป็นจำนวนครั้ง</span>'; }
            if($_GET['sql']  == 'sql_0251'){ echo '<span class="fcol">OPD</span>'; }
            else echo '<span class="fcol">สรุปสถิติ</span>';
          ?> 
         <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel()" > Excel </button>
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
         <div class="box-body table-responsive "> 
         <?php
          if($_GET['sql']  == 'sql_0121'){ echo '<span class="fcol">จ่ายโลหิต</span>'; }
          else if($_GET['sql']  == 'sql_0214'){echo '<span class="fcol">group visitตามแบบฟอร์มที่ถูกสั่ง</span>';}
          else if($_GET['sql']  == 'sql_0251'){ echo '<span class="fcol">IPD</span>'; }
          else{echo '<span class="fcol">ข้อมูลแบบละเอียด</span>';} 
        ?>  
         <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel1()" > Excel </button>
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

<script type="text/javascript">
		function export_excel()
		{
			document.location = "export_excel_f001.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>";
		}
  </script>
  
  <script type="text/javascript">
		function export_excel1()
		{
			document.location = "export_excel_f001_sql2.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>";
		}
	</script>
</body>
</html>