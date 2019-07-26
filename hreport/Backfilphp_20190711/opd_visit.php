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
          สถิติข้อมูลการรับบริการนับจำนวนครั้งของการมารับบริการ
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="opd_visit.php">
                      <input type="text" class="form-control" id="datepickers" placeholder="ช่วงวันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <input type="text" class="form-control" id="datepickert" placeholder="ถึงวันที่" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <select class="select2" name="c_department[]" id="c_department" multiple="multiple" style="width: 20%;" placeholder="คลินิก" title="เลือกคลินิก"></select>
                      <select class="select2" name="i_dropdown[]" id="i_dropdown" multiple="multiple" style="width: 20%;" placeholder="สิทธิ" title="เลือกสิทธิ์"></select>
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

        $c_department   = $_POST['c_department'];    
        $c_pttype       = $_POST['i_dropdown'];  
        
        if($datepickers != "--") {
          $sql = " SELECT o.hn,o.vstdate,o.vsttime,o.doctor,o.spclty,o.main_dep,o.vn,
          CONCAT(p.pname,p.fname,' ',p.lname) as patient_name,p.birthday,
          CONCAT(i.pttype, '| ',i.name) as n_ins,
          k.department,
          CONCAT(d.pname,d.fname,' ',d.lname) as doctor_name,
          v.age_y,v.age_m,v.age_d,v.sex
          FROM ovst as o 
          INNER JOIN vn_stat as v ON v.vn = o.vn
          INNER JOIN patient as p ON o.hn = p.hn
          INNER JOIN pttype as i ON i.pttype = o.pttype
          INNER JOIN kskdepartment as k ON k.depcode = o.main_dep
          LEFT JOIN doctor as d ON d.code = o.doctor
          WHERE o.vstdate BETWEEN '".$datepickers."' AND '".$datepickert."' ";
          $sql .= " AND o.vsttime BETWEEN '08:30:00' AND '16:30:00'";
          if(sizeof($c_department)>0){
            $sql .= " AND o.main_dep in (";
            foreach ($c_department as $value) {
              $sql .="'" .$value. "',";
            }
            $sql = rtrim($sql,',');
            $sql .= ") ";
          }
          if(sizeof($c_pttype )>0){
            $sql .= " AND o.pttype in (";
            foreach ($c_pttype as $value) {
              $sql .="'" .$value. "',";
            }
            $sql = rtrim($sql,',');
            $sql .= ") ";
          }
          $sql .= " ORDER BY  o.vsttime ASC ";
          $result = pg_query($sql);
          $total = pg_num_rows($result); 
//echo $sql;
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">ข้อมูลจำนวน <?php echo " ".$total." แถว ช่วงวันที่ ".thaiDate($datepickers)." ถึง ".thaiDate($datepickert)."  ในเวลาราชการ ระหว่าง 08:30:00 - 16:30:00 น."; ?>        
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>#</th>
                     <th>เวลา</th>
                     <th>hn</th>
                     <th>vn</th>
                     <th>ชื่อ-สกุลผู้รับบริการ</th>
                     <th>วันเกิด</th>
                     <th>อายุ</th>
                     <th>เพศ</th>
                     <th>จุดให้บริการ/คลินิก</th>
                     <th>สิทธิ์</th>
                     <th>แพทย์</th>
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
                      <td><?php echo $row_result['vsttime']; ?></td>
                      <td><?php echo $row_result['hn']; ?></td>
                      <td><?php echo $row_result['vn']; ?></td>
                      <td><?php echo $row_result['patient_name']; ?></td>
                      <td><?php echo thaiDate($row_result['birthday']); ?></td>
                      <td><?php echo $row_result['age_y']." ปี ".$row_result['age_m']." เดือน ".$row_result['age_d']." วัน"; ?></td>
                       <td><?php echo $retVal  ?></td>                     
                      <td><?php echo $row_result['department']; ?></td>
                      <td><?php echo $row_result['n_ins']; ?></td>
                      <td><?php echo $row_result['doctor_name']; ?></td>
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
