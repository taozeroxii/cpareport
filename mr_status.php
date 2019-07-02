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
          ข้อมูลผู้ป่วย IPD งานเวชระเบียน
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="mr_status.php">
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
          $sql = " SELECT i.hn,i.an,CONCAT(i.ward,' | ',w.name) as ward,
          i.regdate,i.dchdate,
          CONCAT(d.pname,d.fname,' ',d.lname,' ',d.licenseno) as doctor,
          CONCAT(i.dchstts,' | ',s.name) as dcstatus,CONCAT(i.dchtype,' | ',c.name) dctype,
          i.chart_state,CONCAT(p.pname,p.fname,' ',p.lname) as patinet
          FROM ipt AS i
          INNER JOIN patient p ON p.hn = i.hn
          INNER JOIN ward AS w ON w.ward = i.ward
          LEFT JOIN doctor AS d ON d.code = i.dch_doctor
          LEFT JOIN dchstts AS s ON s.dchstts = i.dchstts 
          LEFT JOIN dchtype AS c ON c.dchtype = i.dchtype
          WHERE i.dchdate BETWEEN '".$datepickers."' AND '".$datepickert."' ";

          $result = pg_query($sql);
          $total = pg_num_rows($result); 
//echo $sql;
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo "จำนวน ".$total." แถว  ข้อมูลช่วงวันที่".thaiDate($datepickers)." วันที่ ".thaiDate($datepickert); ?>
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>#</th>
                     <th>ชื่อ-สกุลผู้ป่วย</th>
                     <th>HN</th>
                     <th>AN</th>
                     <th>Ward จำหน่าย</th>
                     <th>วันแอดมิด</th>
                     <th>วันจำหน่าย</th>                   
                     <th>แพทย์</th>
                     <th>DSC Status</th>
                     <th>DSC Type</th>
                     <th>สถานะ Chart</th>                   

                   </tr>
                 </thead>
                 <tbody>
                  <? $rw=0;
                  while($row_result = pg_fetch_array($result)) 
                  { 
                    $rw++;
                    $sta =  $row_result['chart_state'];
                    ?>
                    <tr>
                      <td><?php echo $rw; ?></td>
                      <td><?php echo $row_result['patinet']; ?></td>                      
                      <td><?php echo $row_result['hn']; ?></td>
                      <td><?php echo $row_result['an']; ?></td>
                      <td><?php echo $row_result['ward']; ?></td>
                      <td><?php echo thaiDate($row_result['regdate']); ?></td>
                      <td><?php echo thaiDate($row_result['dchdate']); ?></td>
                      <td><?php echo $row_result['doctor']; ?></td>
                      <td><?php echo $row_result['dcstatus']; ?></td>
                      <td><?php echo $row_result['dctype']; ?></td>                     
                      <td><?php 

                      if ($sta == "1" ) {
                        $sta = "<span class='f_dsc'> ยังไม่สรุป </span>";
                      } else
                      if ($sta == "2" ) {
                        $sta = "<span class='t_dsc'> สรุปแล้ว </span>";
                      }
                      echo   $sta;
                      ?></td>  
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
