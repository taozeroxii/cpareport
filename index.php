<?php session_start();?>
<!DOCTYPE html>
<html>
<?php include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/sql.class.php";
$bm = new Timer; 
$bm->start();
include"config/head.index.class.php"; 
for( $i = 0 ; $i < 100000 ; $i++ )
{
 $i;
}
?>
<style type="text/css">
.header{
    /*background:#F00;*/
    /*height:100px;*/
    position:fixed;
    top:0;
    width:100%;
    z-index:1000;
}
.content{
    /*background:#0C0;*/
/*    margin-top:100px;
    height:2000px;
}*/
</style>
<body class="hold-transition skin-blue sidebar-mini">

  <?php include "config/menuleft.class.php"; ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        ข้อมูลบริการทั่วไป ข้อมูล ณ วันที่ <?php echo thaidatefull(date('Y-m-d'))." เวลา ".date('H:i:s')." น. ";?>
        <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3 col-lg-2">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover ">
                <tr>
                  <th class="cen">รายการ</th>
                  <!-- <th class="cen">Progress</th> -->
                  <th class="cen">จำนวน</th>
                </tr>
                <tr class="ffont">
                  <td>จำนวนผู้รับบริการ OPD </td>
                  <td class="cen">
                    <!-- <span class="badge bg-green"> -->
                      <div class="rt" id="realtime_opd">
                        <img src="image/loading2.gif" width="40px" height="20px">
                      </div>
                      <!-- </span> -->
                    </td>
                  </tr>
                  <tr class="ffont">
                    <td>จำนวนผู้ป่วยใน IPD </td>
                    <td class="cen">
                     <div class="rt" id="realtime_ipd">
                      <img src="image/loading2.gif" width="40px" height="20px">
                    </div>
                  </td>
                </tr>
                <tr class="ffont">
                  <td>จำนวนผู้ป่วยนัด </td>
                  <td class="cen">
                    <div class="rt" id="realtime_app">
                      <img src="image/loading2.gif" width="40px" height="20px">
                    </div>
                  </td>
                </tr>
                <tr class="ffont">
                  <td>จำนวน Admit </td>
                  <td class="cen">
                    <div class="rt" id="realtime_admit" data-toggle="modal" data-target="#myModal_rt_admit">
                      <img src="image/loading2.gif" width="40px" height="20px">
                    </div>
                  </td>
                </tr>
                <tr class="ffont">
                  <td>จำนวน DISc  </td>        
                  <td class="cen">
                    <div class="rt" id="realtime_dsc" data-toggle="modal" data-target="#myModal_rt_dsc">
                      <img src="image/loading2.gif" width="40px" height="20px">
                    </div>
                  </td>
                  <tr class="ffont">
                    <td>จำนวน เสียชีวิต  </td>        
                    <td class="cen">
                      <div class="rt" id="dhc_death" data-toggle="modal" data-target="#myModal_rt_death">
                        <img src="image/loading2.gif" width="40px" height="20px">
                      </div>
                    </td>

                  </tr>
                  <tr class="ffont">
                    <td>Refer in</td>
                    <td class="cen">
                      <div class="rt" id="realtime_referin">
                        <img src="image/loading2.gif" width="40px" height="20px">
                      </div>
                    </td>
                  </tr>
                  <tr class="ffont">
                    <td>Refer Out </td>
                    <td class="cen">
                      <div class="rt" id="realtime_referout">
                        <img src="image/loading2.gif" width="40px" height="20px">
                      </div>
                    </td>
                  </tr>

                  <tr class="ffont">
                    <td>จำนวนเตียงทั้งหมด </td>
                    <td class="cen">
                     <div class="rt" id=""> 495 </div>
                   </tr>                                
                   <tr class="ffont">
                    <td> จำนวนเตียงว่าง </td>
                    <td class="cen"> 
                      <div class="rt">
                        <?php echo number_format($bed,0); ?> 
                      </div> 
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-7">
            <div class="box">
              <div class="box-header with-border">
<<<<<<< HEAD
                <h3 class="box-title">ค่า CMI ปี 2563  <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
=======
                <h3 class="box-title">ค่า CMI ปี 2562  <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
>>>>>>> parent of cc06d78... เพิ่มกราฟยอดชมรายงาน
              </div>
              <div class="box-body">
                <div id="">  
                  <div id="container" style="min-width: 110px; height: 200px; margin: 0 auto"></div>
                  <table class="table" id="datatable">
                    <thead>
                      <tr>
                        <th>เดือน</th>
                        <th>ค่า CMI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while($result = pg_fetch_array($row_cmi))
                      {
                        $cmi = $result['cmi'];
                        ?>
                        <tr>
                          <td><?php echo $result['md']; ?></td>
                          <td><?php echo $cmi = ($cmi) ? $cmi : "0" ; ?></td>
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


          <div class="col-md-4 col-lg-3">
            <div class="box">
              <div class="box-header with-border">
                <h4>ช่วงอายุผู้ป่วยที่เข้ารับบริการ</h4>
                <p><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></p>
              </div>
              <div class="box-body">

                <table class="table table-bordered">
                  <tr>
                    <th class="cen">ช่วงอายุ</th>
                    <th class="cen">จำนวน(คน)</th>
                  </tr>
                  <tr class="ffont">
                    <td>ต่ำกว่า 16 ปี </td>
                    <td class="cen">
                      <div class="rt" id="realtime_age15">
                        <img src="image/loading2.gif" width="40px" height="20px">
                      </div>
                    </td>
                  </tr>

                  <tr class="ffont">
                    <td>16-25 ปี </td>
                    <td class="cen">
                      <div class="rt" id="realtime_age18">
                        <img src="image/loading2.gif" width="40px" height="20px">
                      </div>
                    </td>
                  </tr>

                  <tr class="ffont">
                    <td>26-30 ปี </td>
                    <td class="cen">
                     <div class="rt" id="realtime_age30">
                      <img src="image/loading2.gif" width="40px" height="20px">
                    </div>
                  </td>
                </tr>

                <tr class="ffont">
                  <td>31-40 ปี </td>
                  <td class="cen">
                   <div class="rt" id="realtime_age40">
                    <img src="image/loading2.gif" width="40px" height="20px">
                  </div>
                </td>
              </tr>

              <tr class="ffont">
                <td>41-50 ปี </td>
                <td class="cen">
                  <div class="rt" id="realtime_age50">
                    <img src="image/loading2.gif" width="40px" height="20px">
                  </div>
                </td>
              </tr>
              <tr class="ffont">
                <td>51-60 ปี </td>
                <td class="cen">
                  <div class="rt" id="realtime_age60">
                    <img src="image/loading2.gif" width="40px" height="20px">
                  </div>
                </td>
              </tr>
              <tr class="ffont">
                <td>61 -80 ปี </td>
                <td class="cen">
                  <div class="rt" id="realtime_age80">
                    <img src="image/loading2.gif" width="40px" height="20px">
                  </div>
                </td>
              </tr>
              <tr class="ffont">
                <td>มากกว่า 80 ปี  </td>        
                <td class="cen">
                  <div class="rt" id="realtime_age80up">
                    <img src="image/loading2.gif" width="40px" height="25px">
                  </div>
                </td>
              </tr>
            </table> 
            <br>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">ผู้มารับบริการ จำแนกตามสิทธิ์ <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
          </div>
          <div class="box-body">
            <div id="ptt" ></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">ผู้มารับบริการ จำแนกตามเพศ <small><?php echo " ข้อมูลวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
          </div>
          <div class="box-body">
            <div id="sex" ></div>
          </div>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">10 ลำดับโรคผู้ป่วยนอก 
              <small><?php echo "ข้อมูล ".thaidate($todate_mback_start)." - ".thaidate($todate_mback_stop); ?></small>
            </h3>
          </div>
          <div class="box-body">
            <div id="top10opd"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">10 ลำดับโรคผู้ป่วยใน 
              <small><?php echo "ข้อมูล ".thaidate($todate_mback_start)." - ".thaidate($todate_mback_stop); ?></small>
            </h3>
          </div>
          <div class="box-body">
            <div id="top10ipd"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">    
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
           <h3 class="box-title">10 ลำดับโรคผู้ป่วยนอก 
            <small><?php echo "ข้อมูล ".thaidate($todate_mback_start)." - ".thaidate($todate_mback_stop); ?></small></h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-hover ">
             <thead>
              <tr>
                <th>#</th>
                <th>CODE</th>
                <th>DIAG</th>
                <th>COUNT</th>
              </tr>
            </thead>
            <tbody>

             <? $rw=0;
             while($row_result = pg_fetch_array($result_diagopd)) 
             { 
              $rw++;
              ?>
              <tr class="ffont ">
                <td><?php echo $rw; ?></td>
                <td><?php echo $row_result['icd10']; ?></td>
                <td><?php echo $row_result['tname']; ?> </td>
                <td class="cen"><?php echo number_format($row_result['cc'],0); ?> </td>
              </tr>
              <?php  
            }
            ?>                                   
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">10 ลำดับโรคผู้ป่วยใน <small><?php echo "ข้อมูล ".thaidate($todate_mback_start)." - ".thaidate($todate_mback_stop); ?></small></h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
         <thead>
          <tr>
            <th>#</th>
            <th>CODE</th>
            <th>DIAG</th>
            <th>COUNT</th>
          </tr>
        </thead>
        <tbody>
         <? $rw=0;
         while($row_result = pg_fetch_array($result_diagipd)) 
         { 
          $rw++;
          ?>


          <tr class="ffont">
            <td><?php echo $rw; ?></td>
            <td><?php echo $row_result['pdx']; ?></td>
            <td><?php echo $row_result['tname']; ?> </td>
            <td class="cen"><?php echo number_format($row_result['cc'],0); ?> </td>
          </tr>
          <?php  
        }
        ?>                                   
      </tbody>
    </table>
  </div>
</div>
</div>


<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">datatest 
          <small><?php echo "ข้อมูล ".thaidate($todate_mback_start)." - ".thaidate($todate_mback_stop); ?></small>
        </h3>
      </div>
      <div class="box-body">
<<<<<<< HEAD
       <div id="ctreport"></div>
=======
       <div id="" style="height: 100%"></div>
>>>>>>> parent of cc06d78... เพิ่มกราฟยอดชมรายงาน
     </div>
   </div>
 </div>

 <div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">10 ลำดับโรคผู้ป่วยในเสียชีวิต 
        <small><?php echo "ข้อมูล ".thaidate($todate_mback_start)." - ".thaidate($todate_mback_stop); ?></small>
      </h3>
    </div>
    <div class="box-body">
      <div id="top10death"></div>
    </div>
  </div>
</div>
</div>




<!--   <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลการนัด <small><?php// echo " ข้อมูลการนัดวันที่ ".thaidatefull(date('Y-m-d')) ;?></small></h3>
            </div>
            <div class="box-body">
              <table  id="example1" class="table table-bordered table-hover">
                 <thead>
                  <tr>
                    <th>#</th>
                    <th>รายการคลินิก</th>
                    <th style="width: 40px">จำนวน</th>
                  </tr>
                </thead>
                <tbody>

                 <?php /* $rw=0;
                           while($row_result = pg_fetch_array($result)) 
                                { 
                                $rw++;
                                */
                 ?>
                                        <tr>
                                          <td><?php// echo $rw; ?></td>
                                          <td><?php// echo $row_result['clinic_name']; ?></td>
                                          <td><?php //echo $row_result['c_clinic']; ?> </td>
                                        </tr>
                                     <?php  
                                 //       }
                                     ?>                                   
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> -->

    </section>
  </div>

  <?php include"config/footer.class.php"; ?>
  <?php include"config/js.class.php" ?>
  <?php include"modal/modal.class.php" ?>
  <script src="hchart/js/highcharts.js"></script>
  <script src="hchart/js/data.js"></script>
  <script src="hchart/js/exporting.js"></script>  
  <script>
    $(function () {

      $('#container').highcharts({
        data: {
          table: 'datatable'
        },
        chart: {
          type: 'column'
        },
        title: {
          text: ' '
        },
        yAxis: {
          allowDecimals: false,
          title: {
            text: 'ค่า'
          }
        },
        tooltip: {
          formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
            this.point.y; + ' ' + this.point.name.toLowerCase();
          }
        }
      });
    });
  </script>
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
