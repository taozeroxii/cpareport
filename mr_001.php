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
        รายงานการส่งตรวจคนไข้ งานเวชระเบียน
        <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="mr_001.php">
                  <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่เริ่ม" >
                  <input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่สิ้นสุด">
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
$sql = " SELECT opduser.name,count(*) as pp 
         FROM ovst
         INNER JOIN opduser on ovst.staff = opduser.loginname
         WHERE ovst.vstdate  BETWEEN '".$datepickers."' AND '".$datepickert."' 
         AND  opduser.name NOT LIKE 'BMS%%'
         GROUP BY opduser.name
         ORDER BY count(*) DESC ";

$result = pg_query($sql);
$row_main = pg_fetch_array($result);
$total = pg_num_rows($result); 
//echo $sql;
?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ข้อมูลระหว่างวันที่ <?php echo thaiDate($datepickers)." - ".thaiDate($datepickert); ?></h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>#</th>
                   <th>ผู้ส่งตรวจ</th>
                   <th>จำนวน</th>
                </tr>
                </thead>
                <tbody>
                            <? $rw=0;
                                while($row_result = pg_fetch_array($result)) 
                                { 
                                $rw++;
                            ?>
                                        <tr>
                                          <td><?php echo $rw; ?></td>
                                          <td><?php echo $row_result['name']; ?></td>
                                          <td><?php echo $row_result['pp']; ?></td>

 
                                        </tr>
                                     <?php  
                                        }
                                     ?>                                   
                </tbody>
                <tfoot>
                          <tr>
                                      <th>#</th>
                                      <th>ผู้ส่งตรวจ</th>
                                      <th>จำนวน</th>
                          </tr>
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
