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
          ข้อมูล ผู้ป่วยใน แยกหอ ที่ยังไม่จำหน่าย
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="ipd_ward_patient.php">
                      <!-- <input type="text" class="form-control" id="datepickers" placeholder="วันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" > -->
                      <!-- <input type="text" class="form-control" id="datepickert" placeholder="วันที่สิ้นสุด" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" > -->
                      <select class="select2" name="c_ward" id="c_ward"  style="width: 30%;" data-placeholder="เลือก WARD" >
                        <!-- <option value="" selected>-โปรดเลือก Ward-</option> -->
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

/*
        $datepickers    = $_POST['datepickers'];
        list($m,$d,$Y)  = split('/',$datepickers); 
        $datepickers    = trim($Y)."-".trim($m)."-".trim($d);
        $datepickert    = $_POST['datepickert'];
        list($m,$d,$Y)  = split('/',$datepickert); 
        $datepickert    = trim($Y)."-".trim($m)."-".trim($d);
*/

        $ward_dropdown   = $_POST['c_ward'];  
        $sql_dep = " SELECT name FROM ward WHERE ward = '". $ward_dropdown ."'";
        $result_dep = pg_query($sql_dep);
        $row_dep = pg_fetch_array($result_dep);
        $wardname = $row_dep['name'];
        if($ward_dropdown != "") {

          $sql = " SELECT ipt.hn as  hn,
                    ipt.an,
                    CAST (concat ( patient.pname, patient.fname, ' ', patient.lname ) AS VARCHAR ( 250 )) AS ชื่อผู้ป่วย,
                    ipt.regdate AS วันที่รับเข้า,
                    ipt.regtime AS เวลารับเข้า,
                    w.name AS หอผู้ป่วย,
                    pcs.pttype_check_status_name AS สถานะสิทธิ์,
                    ptt.NAME AS สิทธิ,
                    roomno.NAME AS ประเภทห้อง,
                    iptadm.bedno AS เลขที่เตียง
     FROM	ipt	
     LEFT OUTER JOIN spclty ON spclty.spclty = ipt.spclty
       LEFT OUTER JOIN iptadm ON iptadm.an = ipt.an
       LEFT OUTER JOIN bedno bn ON bn.bedno = iptadm.bedno
       LEFT OUTER JOIN patient ON patient.hn = ipt.hn
        LEFT OUTER JOIN roomno ON roomno.roomno = iptadm.roomno
       LEFT OUTER JOIN ipt_pttype_check ic ON ic.an = ipt.an
       LEFT OUTER JOIN pttype_check_status pcs ON pcs.pttype_check_status_id = ic.pttype_check_status_id
       LEFT OUTER JOIN ward w ON w.ward = ipt.ward
       LEFT OUTER JOIN ipt_pttype ip1 ON ip1.an = ipt.an 	AND ip1.pttype_number = 1
       LEFT OUTER JOIN pttype ptt ON ptt.pttype = ip1.pttype
     WHERE	1 = 1 
       AND ipt.dchdate IS NULL
       AND ipt.ward = '".$ward_dropdown ."'
       ORDER BY	ipt.regdate,	ipt.regtime ";
          $result = pg_query($sql);
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title co_dep"><?php echo "หอผู้ป่วย".$row_dep['name']; ?> 
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
                  <a href="expoer_excel_ipd_ward_patient.php?ward=<?php echo $ward_dropdown;?>&&wardname=<?php echo $wardname;?>" target="_blank" title="ส่งออก excel"><button type="" class="btn btn-default pull-right" class="btn btn-success btn-lg">
                    <!-- <img src="image/excel_iocn.png" width="80px" height="20px"> -->Excel
                  </button>
                </a>
              </div>
              <div class="box-body">
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
<!-- test -->
</body>
</html>
