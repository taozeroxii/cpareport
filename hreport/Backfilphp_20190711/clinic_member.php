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
          ข้อมูลทะเบียนผู้ป่วยรายใหม่ 
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="clinic_member.php">
                      <input type="text" class="form-control" id="datepickers" placeholder="ช่วงวันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <input type="text" class="form-control" id="datepickert" placeholder="ถึงวันที่" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <select class="select2" name="cli_dropdown" id="cli_dropdown" style="width: 20%;" placeholder="คลินิก" title="เลือกคลินิก"></select>
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

        $c_department   = $_POST['cli_dropdown']; 

        if($datepickers != "--") {
          $sql = " SELECT CONCAT(a.clinic,' | ',c.name) as clinic,a.regdate, a.hn,
          CONCAT(p.pname,p.fname,'  ',p.lname) as patientname,p.birthday,age(p.birthday) as age,
          CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',ta.full_name) as addess,a.note
          FROM clinicmember as a
          INNER JOIN patient as p ON p.hn = a.hn
          LEFT JOIN patient_relation_address AS pa ON pa.hn = p.hn AND pa.patient_relation_type_id = '9'
          LEFT JOIN thaiaddress AS ta ON ta.chwpart = p.chwpart AND ta.tmbpart = p.tmbpart AND ta.amppart = p.amppart
          LEFT JOIN clinic as c ON c.clinic = a.clinic
          WHERE a.regdate BETWEEN '".$datepickers."' AND '".$datepickert."'
          AND a.clinic = '".$c_department."' ";

          $result = pg_query($sql);
          $total = pg_num_rows($result); 
//echo $sql;
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">ข้อมูลจำนวน <?php echo " ".$total." แถว ช่วงวันที่ ".thaiDate($datepickers)." ถึง ".thaiDate($datepickert); ?>        
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>#</th>
                     <th>คลินิก</th>
                     <th>วันที่ลงทะเบียน</th>
                     <th>HN</th>
                     <th>ชื่อ-สกุล</th>
                     <th>เพศ</th>
                     <th>วันเกิด</th>
                     <th>อายุ</th>
                     <th>ที่อยู่</th>
                     <th>หมายเหตุ</th>
                   </tr>
                 </thead>
                 <tbody>
                  <? $rw=0;
                  while($row_result = pg_fetch_array($result)) 
                  { 
                    $rw++;
                    $retVal = ($row_result['sex'] = '1') ? 'ชาย' : 'หญิง' ;
                    ?>
                    <tr>
                      <td><?php echo $rw; ?></td>
                      <td><?php echo $row_result['clinic']; ?></td>
                      <td><?php echo thaiDate($row_result['regdate']); ?></td>
                      <td><?php echo $row_result['hn']; ?></td>
                      <td><?php echo $row_result['patientname']; ?></td>
                      <td><?php echo $retVal  ?></td>    
                      <td><?php echo thaiDate($row_result['birthday']); ?></td>
                      <td><?php echo $row_result['age']; ?></td>
                      <td><?php echo $row_result['addess']; ?></td>    
                      <td><?php echo $row_result['note']; ?></td>
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
