<!DOCTYPE html>
<html>
<?php include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
$bm = new Timer; 
$bm->start();
include"config/head.class.php"; 
for( $i = 0 ; $i < 100000 ; $i++ )
{
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
        <h1>
         รายงานการให้รหัสโรคและหัตถการผู้ป่วยใน จำนวนตามบุคคล
       </h1>
     </section>
     <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="mr_ipt_oper_diag.php">
                    <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่เริ่ม" >
                    <input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่สิ้นสุด">
                    <label class="radio-inline">
                      <input type="radio" name="staff" id="staff" value="9" checked > : 9
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="staff" id="staff" value="mo" > : mo
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="staff" id="staff" value="toey" > : toey
                    </label>
                    &nbsp;
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

      $staff          = $_POST['staff'];

      if($datepickers != "--") {
        $sql_m = "      SELECT staff,DATE(modify_datetime)  as kdate ,count(*) as count_total
        FROM iptoprt
        WHERE staff = '".$staff."' AND modify_datetime BETWEEN '".$datepickers."' AND '".$datepickert."' 
        AND  concat( EXTRACT(HOUR FROM modify_datetime),EXTRACT(MINUTE FROM modify_datetime) ) BETWEEN '0830' AND '1630'
        GROUP BY  staff,DATE(modify_datetime)
        order by DATE(modify_datetime) DESC ";
        $result_m = pg_query($sql_m);


        $sql_o = " SELECT staff,DATE(modify_datetime)  as kdate ,count(*) as count_total
        FROM iptoprt
        WHERE staff = '".$staff."' AND modify_datetime BETWEEN '".$datepickers."' AND '".$datepickert."' 
        AND  concat( EXTRACT(HOUR FROM modify_datetime),EXTRACT(MINUTE FROM modify_datetime) ) BETWEEN '1630' AND '2359'
        GROUP BY  staff,DATE(modify_datetime)
        order by DATE(modify_datetime) DESC  ";
       $result_o = pg_query($sql_o);

        $sql_d = "      SELECT staff,DATE(modify_datetime)  as kdate ,count(*) as count_total
        FROM iptdiag
        WHERE staff = '".$staff."' AND modify_datetime BETWEEN '".$datepickers."' AND '".$datepickert."' 
        AND  concat( EXTRACT(HOUR FROM modify_datetime),EXTRACT(MINUTE FROM modify_datetime) ) BETWEEN '0830' AND '1630'
        GROUP BY  staff,DATE(modify_datetime)
        order by DATE(modify_datetime) DESC ";
        $result_d = pg_query($sql_d);


        $sql_e = " SELECT staff,DATE(modify_datetime)  as kdate ,count(*) as count_total
        FROM iptdiag
        WHERE staff = '".$staff."' AND modify_datetime BETWEEN '".$datepickers."' AND '".$datepickert."' 
        AND  concat( EXTRACT(HOUR FROM modify_datetime),EXTRACT(MINUTE FROM modify_datetime) ) BETWEEN '1630' AND '2359'
        GROUP BY  staff,DATE(modify_datetime)
        order by DATE(modify_datetime) DESC  ";
       $result_e = pg_query($sql_e);




           ?>
           <div class="row">
             <div class="box-header">
              <h3 class="box-title"><?php echo "ข้อมูลของ <span class='staff'> USER :: <U>".$staff."</U></span>  ช่วงวันที่ ".thaiDate($datepickers)." วันที่ ".thaiDate($datepickert); ?>
              <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
            </h3>
          </div>
          <div class="col-xs-3">
            <div class="box">
              <div class="box-body">
                <h5 class="box-title box-t">Code หัตถการผู้ป่วยใน ในเวลา</h5>
                <table id="example" class="table table-bordered">
                  <thead>
                    <tr>
                     <th class="">วันที่</th>
                     <th class="cen">จำนวน</th>
                   </tr>
                 </thead>
                 <tbody>
                   <? $rw=0;
                   while($row_result_m = pg_fetch_array($result_m)) 
                   { 
                    $rw++;
                    ?>
                    <tr>            
                      <td><?php echo thaiDate($row_result_m['kdate']); ?></td>
                      <td class="cen"><?php echo $row_result_m['count_total']; ?></td>
                    </tr>
                    <?php  
                  }
                  ?>                                   
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-xs-3">
          <div class="box">
            <div class="box-body">
              <h5 class="box-title box-t">Code หัตถการผู้ป่วยใน นอกเวลา</h5>
              <table id="example" class="table table-bordered">
                <thead>
                  <tr>
                   <th class="">วันที่</th>
                   <th class="cen">จำนวน</th>
                 </tr>
               </thead>
               <tbody>
                 <?
                 while($row_result_o = pg_fetch_array($result_o)) 
                 { 
                  ?>
                  <tr>            
                    <td><?php echo thaiDate($row_result_o['kdate']); ?></td>
                    <td class="cen"><?php echo $row_result_o['count_total']; ?></td>
                  </tr>
                  <?php  
                }
                ?>                                   
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="box">
          <div class="box-body">
            <h5 class="box-title box-t">Code โรคผู้ป่วยใน นอกเวลา</h5>
            <table id="example" class="table table-bordered">
              <thead>
                <tr>
                 <th class="">วันที่</th>
                 <th class="cen">จำนวน</th>
               </tr>
             </thead>
             <tbody>
               <? $rw=0;
               while($row_result_d = pg_fetch_array($result_d)) 
               { 
                $rw++;
                ?>
                <tr>            
                  <td><?php echo thaiDate($row_result_d['kdate']); ?></td>
                  <td class="cen"><?php echo $row_result_d['count_total']; ?></td>
                </tr>
                <?php  
              }
              ?>                                   
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-xs-3">
      <div class="box">
        <div class="box-body">
          <h5 class="box-title box-t">Code โรคผู้ป่วยใน นอกเวลา</h5>
          <table id="example" class="table table-bordered">
            <thead>
              <tr>
               <th class="">วันที่</th>
               <th class="cen">จำนวน</th>
             </tr>
           </thead>
           <tbody>
             <? $rw=0;
             while($row_result_e = pg_fetch_array($result_e)) 
             { 
              $rw++;
              ?>
              <tr>            
                <td><?php echo thaiDate($row_result_e['kdate']); ?></td>
                <td class="cen"><?php echo $row_result_e['count_total']; ?></td>
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
