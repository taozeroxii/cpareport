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
          ข้อมูล ลำดับโรคผู้ป่วยนอกแยกตามคลินิก TOP 10 Diag OPD Clinic 
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="top10clinic_opd.php">
                      <input type="text" class="form-control" id="datepickers" placeholder="วันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <input type="text" class="form-control" id="datepickert" placeholder="วันที่สิ้นสุด" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <select class="select2" name="c_department" id="c_department"  style="width: 30%;" >
                        <option value="" selected>-โปรดเลือก คลินิก-</option>
                      </select>
                      <button type="submit" class="btn btn-default">Submit</button>
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
        $dep_dropdown   = $_POST['c_department'];  
        $sql_dep = " SELECT department FROM kskdepartment WHERE depcode = '". $dep_dropdown ."'";
        $result_dep = pg_query($sql_dep);
        $row_dep = pg_fetch_array($result_dep);
        if($datepickers != "--") {
          $sql = " SELECT a.icd10,b.tname,b.name,COUNT(a.*) as cc
          from ovstdiag as a
          INNER JOIN ovst as c on c.vn = a.vn 
          INNER JOIN icd101 as b on b.code = a.icd10
          where a.vstdate between '".$datepickers."' AND '".$datepickert."'
          AND c.main_dep = '".$dep_dropdown."'
          AND a.icd10 not like 'Z%%' 
          AND a.icd10 <> '' 
          AND a.icd10 is not null
          --  AND a.icd10 not like 'U%%'
          GROUP BY a.icd10,b.tname,b.name
          ORDER BY cc DESC
          LIMIT 20 ";
          $result = pg_query($sql);
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title co_dep"><?php echo "คลินิก".$row_dep['department']." ข้อมูลช่วงวันที่ ".thaiDatefull($datepickers)." ถึงวันที่ ".thaiDatefull($datepickert) ?> 
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>#</th>
                     <th>PDX_CODE</th>
                     <th>PDX_NAME_EN</th>
                     <th>PDX_NAME_TH</th>
                     <th>TOTAL</th>
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
                      <td><?php echo $row_result['icd10']; ?></td>
                      <td><?php echo $row_result['name']; ?></td>
                      <td><?php echo $row_result['tname']; ?></td>
                      <td><?php echo number_format($row_result['cc'],0); ?></td>
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
