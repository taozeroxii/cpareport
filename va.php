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
           ข้อมูลผลคัดกรองสายตา
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="va.php">
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

        // $objConnect = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
        // $conn = pg_connect($objConnect);
        // pg_set_client_encoding($conn, "utf8");

        $datepickers    = $_POST['datepickers'];
        list($m,$d,$Y)  = split('/',$datepickers); 
        $datepickers    = trim($Y)."-".trim($m)."-".trim($d);

        $datepickert    = $_POST['datepickert'];
        list($m,$d,$Y)  = split('/',$datepickert); 
        $datepickert    = trim($Y)."-".trim($m)."-".trim($d);
/*
        $filName = "va/va_".date(YmdHis).".txt";
        $objWrite = fopen($filName, "w");
*/
        if($datepickers != "--") {


        $strSQL = " SELECT p.cid,p.pname,p.fname,p.lname,to_char(p.birthday, 'DD/MM/YYYY')AS birthday,p.sex,p.addrpart AS address,p.moopart AS moo,t.addressid AS aid,'F' AS unit
        ,CASE
        WHEN e.r01 = '20/20'  THEN '14'
        WHEN e.r01 = '20/30'  THEN '6'
        WHEN e.r01 = '20/40'  THEN '5'
        WHEN e.r01 = '20/50'  THEN '4'
        WHEN e.r01 = '20/70'  THEN '3'
        WHEN e.r01 = '20/100' THEN '2'
        WHEN e.r01 = '20/200' THEN '1'    
        WHEN e.r01 = '15/200' THEN '17' 
        WHEN e.r01 = '10/200' THEN '15' 
        WHEN e.r01 = '5/200'  THEN '16' 
        WHEN e.r01 = 'CF 3'   THEN '7'  
        WHEN e.r01 = 'CF 2'   THEN '8'  
        WHEN e.r01 = 'CF 1'   THEN '9'  
        WHEN e.r01 = 'HM'     THEN '10' 
        WHEN e.r01 = 'PJ'     THEN '11' 
        WHEN e.r01 = 'PL'     THEN '12' 
        WHEN e.r01 = 'no PL'  THEN '13' 
        ELSE ' '
        END AS va_r
        ,CASE
        WHEN e.l01 = '20/20'  THEN '14'
        WHEN e.l01 = '20/30'  THEN '6'
        WHEN e.l01 = '20/40'  THEN '5'
        WHEN e.l01 = '20/50'  THEN '4'
        WHEN e.l01 = '20/70'  THEN '3'
        WHEN e.l01 = '20/100' THEN '2'
        WHEN e.l01 = '20/200' THEN '1'    
        WHEN e.l01 = '15/200' THEN '17' 
        WHEN e.l01 = '10/200' THEN '15' 
        WHEN e.l01 = '5/200'  THEN '16' 
        WHEN e.l01 = 'CF 3'   THEN '7'  
        WHEN e.l01 = 'CF 2'   THEN '8'  
        WHEN e.l01 = 'CF 1'   THEN '9'  
        WHEN e.l01 = 'HM'     THEN '10' 
        WHEN e.l01 = 'PJ'     THEN '11' 
        WHEN e.l01 = 'PL'     THEN '12' 
        WHEN e.l01 = 'no PL'  THEN '13'       
        ELSE ' '
        END AS va_l
      --  ,o.vstdate AS va_date
       ,to_char(o.vstdate, 'YYYY/MM/DD')AS va_date
        ,'10665' AS hospcode
        FROM ovst AS o
        LEFT JOIN eye_screen AS e ON e.vn = o.vn
        INNER JOIN patient AS p ON p.hn = o.hn
        INNER JOIN thaiaddress AS t ON t.tmbpart = p.tmbpart AND t.amppart = p.amppart AND t.chwpart = p.chwpart 
        WHERE o.vstdate BETWEEN '".$datepickers."' AND '".$datepickert."'
        AND o.main_dep IN ('232','233','234','354','355')";
     //   $objQuery = pg_query($strSQL);
        $objdetail = pg_query($strSQL);
     /*  
        while($objResult = pg_fetch_array($objQuery))
        {
          fwrite($objWrite, "$objResult[cid]|");
          fwrite($objWrite, "$objResult[pname]|");
          fwrite($objWrite, "$objResult[fname]|");
          fwrite($objWrite, "$objResult[lname]|");
          fwrite($objWrite, "$objResult[birthday]|");
          fwrite($objWrite, "$objResult[sex]|");
          fwrite($objWrite, "$objResult[address]|");
          fwrite($objWrite, "$objResult[moo]|");
          fwrite($objWrite, "$objResult[aid]|");
          fwrite($objWrite, "$objResult[unit]|");
          fwrite($objWrite, "$objResult[va_r]|");
          fwrite($objWrite, "$objResult[va_l]|");
          fwrite($objWrite, "$objResult[va_date]|");
          fwrite($objWrite, "$objResult[hospcode] \r\n");
        }
        fclose($objWrite);
        */
        ?>
      </table>

    </body>
    </html>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">ข้อมูลระหว่างวันที่ <?php echo thaiDate($datepickers)." - ".thaiDate($datepickert); ?>
            <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
          </h3>


          <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
          <button class="btn btn-default pull-right" class="btn btn-info btn-lg" title="โหลดไฟล์ TXT"> 
            <?php echo "<a href=va_export.php?ds=$datepickers&de=$datepickert>Download</a>"; ?> 
          </button>

        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>#</th>
               <th>cid</th>
               <th>pname</th>
               <th>fname</th>
               <th>lname</th>
               <th>birthday</th>
               <th>sex</th>
               <th>addrpart</th>
               <th>moopart</th>
               <th>addressid</th>
               <th>unit</th>
               <th>va_r</th>
               <th>va_l</th>
               <th>va_date</th>
               <th>hospcode</th>
             </tr>
           </thead>
           <tbody>
            <? $rw=0;
            while($row_result = pg_fetch_array($objdetail))
            { 
              $rw++;
              ?>
              <tr>
                <td><?php echo $rw; ?></td>
                <td><?php echo $row_result['cid']; ?></td>
                <td><?php echo $row_result['pname']; ?></td>
                <td><?php echo $row_result['fname']; ?></td>
                <td><?php echo $row_result['lname']; ?></td>
                <td><?php echo $row_result['birthday']; ?></td>
                <td><?php echo $row_result['sex']; ?></td>
                <td><?php echo $row_result['aid']; ?></td>
                <td><?php echo $row_result['moo']; ?></td>
                <td><?php echo $row_result['address']; ?></td>
                <td><?php echo $row_result['unit']; ?></td>
                <td><?php echo $row_result['va_r']; ?></td>
                <td><?php echo $row_result['va_l']; ?></td>
                <td><?php echo $row_result['va_date']; ?></td>
                <td><?php echo $row_result['hospcode']; ?></td>

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
<!-- ทดสอบ cmd -->
</body>
</html>
