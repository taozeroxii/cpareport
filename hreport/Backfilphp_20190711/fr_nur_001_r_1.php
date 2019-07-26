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
          รายงานผู้ป่วยใน > แบบเก็บรายงานกิจกรรม
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="fr_nur_001_r_1.php">
                      <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker"  data-date-language="th" autocomplete="off" >
                      <SELECT type="text" class="select2  " id="c_ward" name="c_ward" >

                      </SELECT>
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

        $c_ward   = $_POST['c_ward'];

        if($datepickers != "--") {

          $sql_ward    = " SELECT name FROM ward WHERE ward = '".$c_ward."' ";
          $result_ward = pg_query($sql_ward);
          $row_ward    = pg_fetch_array($result_ward);
          $wardname = $row_ward['name'];

          $sql_op = " SELECT  name,count(DISTINCT a.an) as rname,count(*) as kname
          from ipt_nurse_oper as a
          inner join ipt_oper_code as b ON a.ipt_oper_code = b.ipt_oper_code 
          where an in (SELECT an FROM ward_admit_snapshot WHERE snap_date BETWEEN '".$datepickers."' AND '".$datepickert."' AND ward = '".$c_ward."' GROUP BY an )
          group by b.name,a.ipt_oper_code
          ORDER BY kname DESC ";
          $result = pg_query($sql_op);
//echo  $sql;

          $sql_lab = " SELECT c.lab_items_name_ref,count(DISTINCT b.an) as Rname,count(*) as Kname
          FROM lab_head AS a
          INNER JOIN ipt AS b ON a.hn = b.hn
          INNER JOIN lab_order c ON c.lab_order_number = a.lab_order_number
          INNER JOIN lab_items d ON d.lab_items_code = c.lab_items_code
          WHERE b.an IN (SELECT an FROM ward_admit_snapshot WHERE snap_date BETWEEN '".$datepickers."' AND '".$datepickert."' AND ward = '".$c_ward."' GROUP BY an )
          GROUP BY c.lab_items_name_ref
          ORDER BY kname DESC ";
          $result_lab = pg_query($sql_lab);



          $sql_xray = " SELECT a.xray_list,count(DISTINCT b.an) as Rname,count(*) as Kname
          FROM xray_head AS a
          INNER JOIN ipt AS b ON a.hn = b.hn
          INNER JOIN xray_report AS r ON r.hn = a.hn
          WHERE b.an IN (SELECT an FROM ward_admit_snapshot WHERE snap_date  BETWEEN '".$datepickers."' AND '".$datepickert."' AND ward = '".$c_ward."' GROUP BY an )
          AND a.xray_list <> ''
          GROUP BY a.xray_list
          ORDER BY Kname DESC ";
          $result_xray = pg_query($sql_xray);

        $sql  =  "".$sql_op."".$sql_lab."".$sql_xray;

          ?>

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    แบบเก็บรายงานกิจกรรม  <?php echo " ข้อมูลวันที่ ".thaidate($datepickers)." ถึง ".thaidate($datepickert)." หอผู้ป่วย ".$wardname; ?>
                    <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                  </h3>
                  <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Operation</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Lab</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Xray</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                   <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered  table-hover table-striped ">
                      <thead>
                        <tr>
                          <th class="cen">#</th>
                          <th class="cen">รายการ</th>
                          <th class="cen">ราย</th>
                          <th class="cen">ครั้ง</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?    $rw=0;
                        while($row_result = pg_fetch_array($result)) 
                        { 
                          $rw++;
                          ?>
                          <tr class="ho" >
                            <td class="cen"><?php echo $rw; ?></td>
                            <td><?php echo $row_result['name']; ?></td>
                            <td class="cen"><?php echo $row_result['rname']; ?></td>                                          
                            <td class="cen"><?php echo $row_result['kname']; ?></td>
                          </tr>
                          <?php  
                        }
                        ?>                                   
                      </tbody>
                    </table>
                  </div>

                </div>
                <div class="tab-pane" id="tab_2">
                   <div class="box-body table-responsive">
                    <table id="example3" class="table table-bordered  table-hover table-striped ">
                      <thead>
                        <tr>
                          <th class="cen">#</th>
                          <th class="cen">รายการ</th>
                          <!-- <th class="cen">ราย</th> -->
                          <th class="cen">ครั้ง</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?    $rw=0;
                        while($row_result = pg_fetch_array($result_lab)) 
                        { 
                          $rw++;
                          ?>
                          <tr class="ho" >
                            <td class="cen"><?php echo $rw; ?></td>
                            <td><?php echo $row_result['lab_items_name_ref']; ?></td>
<!--                             <td class="cen"><?php //echo $row_result['rname']; ?></td>                                          
 -->                            <td class="cen"><?php echo $row_result['kname']; ?></td>
                          </tr>
                          <?php  
                        }
                        ?>                                   
                      </tbody>
                    </table>
                  </div>

                </div>
                <div class="tab-pane" id="tab_3">
                   <div class="box-body table-responsive">
                    <table id="example4" class="table table-bordered  table-hover table-striped ">
                      <thead>
                        <tr>
                          <th class="cen">#</th>
                          <th class="cen">รายการ</th>
                          <!-- <th class="cen">ราย</th> -->
                          <th class="cen">ครั้ง</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?    $rw=0;
                        while($row_result = pg_fetch_array($result_xray)) 
                        { 
                          $rw++;
                          ?>
                          <tr class="ho" >
                            <td class="cen"><?php echo $rw; ?></td>
                            <td><?php echo $row_result['xray_list']; ?></td>
                            <!-- <td class="cen"><?php echo $row_result['rname']; ?></td>                                           -->
                            <td class="cen"><?php echo $row_result['kname']; ?></td>
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
          </div>
        </div>








        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  แบบเก็บรายงานกิจกรรม
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                </h3>
                <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
              </div>
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered  table-hover table-striped ">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>รายการ</th>
                      <th>ราย</th>
                      <th>ครั้ง</th>

                    </tr>
                  </thead>
                  <tbody>
                          <?  //  $rw=0;
                               // while($row_result = pg_fetch_array($result)) 
                               // { 
                               // $rw++;
                          ?>
                          <tr class="ho" >
                            <td><?php //echo $rw; ?></td>
                            <td><?php //echo $row_result['name']; ?></td>
                            <td><?php //echo $row_result['rname']; ?></td>                                          
                            <td><?php //echo $row_result['kname']; ?></td>
                          </tr>
                          <?php  
                                    //    }
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
            $('#example3').DataTable()
            $('#example4').DataTable()
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