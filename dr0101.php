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
        ตัวชีวัด > อัตราการเสียชีวิตหลังจากเข้ารับการรักษาขแงผู้ป่วยโรคปอด
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="dr0101.php">
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

$sql_a = "  SELECT COUNT(*) as daa
        FROM an_stat a
        INNER JOIN ipt t ON t.an = a.an
        LEFT JOIN dchtype dt ON dt.dchtype = t.dchtype
        LEFT JOIN pttype pt ON pt.pttype = t.pttype
        LEFT OUTER JOIN patient p ON p.hn = a.hn
        LEFT OUTER JOIN ward wd ON wd.ward = t.ward
        INNER JOIN (SELECT a2.an,a2.hn,a2.regdate,a2.dchdate,a2.lastvisit
                    FROM an_stat a2
                    INNER JOIN iptdiag  diag2 ON diag2.an = a2.an
                    WHERE a2.dchdate BETWEEN '".$datepickers."' AND '".$datepickert."'
                    AND (diag2.icd10 IN ('J10.0','J11.0','J85.0','J85.1') 
                    OR diag2.icd10 BETWEEN 'J12' AND 'J16' 
                    OR diag2.icd10 IN ('J17.1','J17.2','J17.3','J17.8')
                    OR diag2.icd10 = 'J18')
                    ) AS av2 ON av2.hn = a.hn
        WHERE t.dchtype in ('08','09') ";
$result_a = pg_query($sql_a);
$row_result_a = pg_fetch_array($result_a);


$sql_b = " SELECT COUNT(*) as dbb
        FROM an_stat a
        INNER JOIN ipt t ON t.an = a.an
        LEFT JOIN dchtype dt ON dt.dchtype = t.dchtype
        LEFT JOIN pttype pt ON pt.pttype = t.pttype
        LEFT OUTER JOIN patient p ON p.hn = a.hn
        LEFT OUTER JOIN ward wd ON wd.ward = t.ward
        INNER JOIN (SELECT a2.an,a2.hn,a2.regdate,a2.dchdate,a2.lastvisit
                    FROM an_stat a2
                    INNER JOIN iptdiag  diag2 ON diag2.an = a2.an
                    WHERE a2.dchdate BETWEEN '".$datepickers."' AND '".$datepickert."'
                    AND (diag2.icd10 IN ('J10.0','J11.0','J85.0','J85.1') 
                    OR diag2.icd10 BETWEEN 'J12' AND 'J16' 
                    OR diag2.icd10 IN ('J17.1','J17.2','J17.3','J17.8')
                    OR diag2.icd10 = 'J18')
                    ) AS av2 ON av2.hn = a.hn ";
$result_b = pg_query($sql_b);
$row_result_b = pg_fetch_array($result_b);

$total_sum = @($row_result_a['daa']/$row_result_b['dbb'])*100;


$sql = " SELECT av2.an AS an2,av2.regdate AS reg2,av2.dchdate AS dch2,
         a.an,a.hn,concat(p.pname,p.fname,'  ',p.lname) AS ptname,
         a.regdate,a.dchdate,a.lastvisit,
         a.pdx,a.age_y,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5,
         a.pttype,
         pt.name as instname,t.dchtype,dt.name as dsc_typename,wd.name as wdname
        FROM an_stat a
        INNER JOIN iptdiag  diag2 ON diag2.an = a.an        
        INNER JOIN ipt t ON t.an = a.an
        LEFT JOIN dchtype dt ON dt.dchtype = t.dchtype
        LEFT JOIN pttype pt ON pt.pttype = t.pttype
        LEFT OUTER JOIN patient p ON p.hn = a.hn
        LEFT OUTER JOIN ward wd ON wd.ward = t.ward
        INNER JOIN (SELECT a2.an,a2.hn,a2.regdate,a2.dchdate,a2.lastvisit
                    FROM an_stat a2
                    ) AS av2 ON av2.hn = a.hn 
        WHERE a.dchdate BETWEEN '".$datepickers."' AND '".$datepickert."'
        AND (diag2.icd10 IN ('J10.0','J11.0','J85.0','J85.1') 
        OR diag2.icd10 BETWEEN 'J12' AND 'J16' 
        OR diag2.icd10 IN ('J17.1','J17.2','J17.3','J17.8')
        OR diag2.icd10 = 'J18') ";
$result_detail = pg_query($sql);

?>
      <div class="row">
        <div class="col-xs-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                     DR0101
                  <?php echo "ข้อมูลวันที่ ".thaidate($datepickers)." - ".thaidate($datepickert); ?>
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
              </h3>
            </div>  
                <div class="box-body table-responsive">
                  <div> สูตรมในการคำนวณ (a / b x 100)     <sup class="pdx_s"> * Principal Diagnosis (PDX) หรือ SDX </sup></div>
                  <div> a = จำนวนครั้งของการจำหน่ายด้วยการเสียชีวิตของผู้ป่วย โรคปอดบวม จากทุกหอ <br><span class="pdx"> PDX or SDX = J10.0 , J11.0 , J12-J16 , J17.0* , J17.1* , J17.2* , J17.3* , J17.8* , J18 , J85.0 , J85.1 </span></div>
                  <div> b = จำนวนครั้งของการจำหน่ายทุกสถานะของผู้ป่วย Stroke จากทุกหอผู้ป่วย ในช่วงเวลาเดียวกัน <br><span class="pdx"> PDX or SDX = J10.0 , J11.0 , J12-J16 , J17.0* , J17.1* , J17.2* , J17.3* , J17.8* , J18 , J85.0 , J85.1 </span></div>
                </div>
           </div>
         </div>

        <div class="col-xs-4">
          <div class="box">
            <div class="box-header">
               <h3 class="box-title">
                        <div> <?php echo "a =  ".$row_result_a['daa']." , b =  ".$row_result_b['dbb']; ?></div>
              </h3>
              <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalpdf_dr0101"> นิยาม </button>
              <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> SQL </button>
                            <!-- <a href="config/excel.class.php?sql=<?php// echo $sql; ?>" class="btn btn-default pull-right" class="btn btn-info btn-lg" > Excel </a>  -->

            </div>  
                <div class="box-body table-responsive">
                  <div> <?php echo  "( ".$row_result_a['daa']." / ".$row_result_b['dbb']." ) X 100 "." = <span class='total_p'>ร้อยละ  </span>
                  <span class='total_s'>".number_format($total_sum,2)."</span>" ; ?></div>
                  <p>&nbsp;</p>
                </div>

           </div>
         </div>
      </div>


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered  table-hover table-striped ">
                <thead>
                <tr>
                                        <th class="cen">#</th>
                                        <th class="cen">hn</th>
                                        <th class="cen">an</th>
                                        <th class="cen">ชื่อ-สกุล</th>
                                        <th class="cen">regdate</th>
                                        <th class="cen">dchdate</th>
                                        <th class="cen pdx_1">PDX</th>
                                        <th class="cen">dx0</th>
                                        <th class="cen">dx1</th>
                                        <th class="cen">dx2</th>
                                        <th class="cen">dx3</th>
                                        <th class="cen">dx4</th>
                                        <th class="cen">dx5</th>
                                        <th class="cen">สถานะการจำหน่าย</th>
                                        <th class="cen">สิทธิ์การรักษา</th>
                                        <th class="cen">Ward</th>
                </tr>
                </thead>
                <tbody>
                <?            $rw=0;
                                while($row_result = pg_fetch_array($result_detail)) 
                                { 
                                $rw++;
                            ?>
                                        <tr class="ho" >
                                          <td><?php echo $rw; ?></td>
                                          <td><?php echo $row_result['hn']; ?></td>
                                          <td><?php echo $row_result['an']; ?></td>
                                          <td><?php echo $row_result['ptname']; ?></td>
                                          <td><?php echo thaidate($row_result['regdate']); ?></td>
                                          <td><?php echo thaidate($row_result['dchdate']); ?></td>
                                          <td class="pdx"><?php echo $row_result['pdx']; ?></td>
                                          <td><?php echo $row_result['dx0']; ?></td>
                                          <td><?php echo $row_result['dx1']; ?></td>
                                          <td><?php echo $row_result['dx2']; ?></td>
                                          <td><?php echo $row_result['dx3']; ?></td>
                                          <td><?php echo $row_result['dx4']; ?></td>
                                          <td><?php echo $row_result['dx5']; ?></td>
                                          <td>
                                            <?php  $dct =  $row_result['dchtype']; 
                                                  if ($dct == '09') {
                                                    echo $dct =  "<span class='dis'>".$row_result['dsc_typename']."</span>"; 
                                                  } else {
                                                    echo $dct =  $row_result['dsc_typename']; 
                                                  }
                                            ?>
                                            
                                          </td>
                                          <td><?php echo $row_result['instname']; ?></td>
                                          <td><?php echo $row_result['wdname']; ?></td>
                                        </tr>
                                     <?php  
                                        }
                                     ?>                                   
                </tbody>
                <tfoot>
                <tr>
                                        <th class="cen">#</th>
                                        <th class="cen">hn</th>
                                        <th class="cen">an</th>
                                        <th class="cen">ชื่อ-สกุล</th>
                                        <th class="cen">regdate</th>
                                        <th class="cen">dchdate</th>
                                        <th class="cen pdx_1">PDX</th>
                                        <th class="cen">dx0</th>
                                        <th class="cen">dx1</th>
                                        <th class="cen">dx2</th>
                                        <th class="cen">dx3</th>
                                        <th class="cen">dx4</th>
                                        <th class="cen">dx5</th>
                                        <th class="cen">สถานะการจำหน่าย</th>
                                        <th class="cen">สิทธิ์การรักษา</th>
                                        <th class="cen">Ward</th>
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