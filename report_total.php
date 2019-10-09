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
<?php include "config/menuleft.class.php"; ?>
   <div class="content-wrapper">
    <section class="content-header">
      <h1>
        ข้อมูลบริการทั่วไป
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="report_total.php">
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


$sql_s = " SELECT SUM(CASE WHEN admdate = 0 THEN 1
                  ELSE admdate
                  END ) as sleep_adm
            FROM an_stat
            WHERE dchdate BETWEEN '".$datepickers."' and '".$datepickert."' ";
$result_s = pg_query($sql_s);
$row__s = pg_fetch_array($result_s);

$sql_d = " SELECT COUNT(hn) AS total
          FROM death 
          WHERE death_date BETWEEN '".$datepickers."' and '".$datepickert."'";
$result_d = pg_query($sql_d);
$row__d = pg_fetch_array($result_d);

$sql = " SELECT 'OPD' as oi,count(distinct case when opi.pttype in('23','20','24','21','46') then ov.vn else null end) as sks, 
                count(distinct case when opi.pttype in('26') then ov.vn else null end) as opt,
                count(distinct case when opi.pttype in('13','61','63','51','53','44','43','94','99','95','11') then ov.vn else null end) as uc,
                count(distinct case when opi.pttype in('35','37','34','31','42','39','38','45') then ov.vn else null end) as sss,
                count(distinct case when opi.pttype in('10') then ov.vn else null end) as finance,
                count(distinct case when opi.pttype in('47','36') then ov.vn else null end) as ins,
                count(distinct case when p.nationality in('46','48','56','57') then ov.vn else null end) as ufo,
                count(distinct ov.vn) as all_vn, 
                count(distinct ov.hn) as all_hn
        from ovst ov    
        join opitemrece opi on ov.vn = opi.vn    
        join pttype pt on opi.pttype = pt.pttype
        left join patient p on p.hn = ov.hn
        where ov.vstdate between '".$datepickers."' and '".$datepickert."' 
        and opi.pttype <> '' 
        and (ov.an is null or ov.an =' ')";
$result = pg_query($sql);
$row_main = pg_fetch_array($result);

$sql_2 = "  SELECT 'IPD' as oi,count(distinct case when opi.pttype in('23','20','24','21','46') then w.an else null end) as sks,
              count(distinct case when opi.pttype in('26') then w.an else null end) as opt, 
              count(distinct case when opi.pttype in('13','61','63','51','53','44','43','94','99','95','11') then w.an else null end) as uc,
              count(distinct case when opi.pttype in('35','37','34','31','42','39','38','45') then w.an else null end) as sss,
              count(distinct case when opi.pttype in('10') then w.an else null end) as finance,
              count(distinct case when opi.pttype in('47','36') then w.an else null end) as ins,
              count(distinct case when p.nationality in('46','48','56','57') then w.an else null end) as ufo,
              count(distinct w.an) as all_an, 
              count(distinct opi.hn) as all_hn
        from ipt_bed_stat w
        join opitemrece opi on w.an = opi.an 
        join pttype pt on opi.pttype = pt.pttype 
        left join patient p on p.hn = opi.hn
        where w.adm_date between '".$datepickers."' and '".$datepickert ."' 
        and opi.pttype <> '' ";
$result_2 = pg_query($sql_2);
$row_main_2 = pg_fetch_array($result_2);
?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">หมายเหตุประกอบงบ  ข้อมูลระหว่างวันที่ <?php echo thaiDateFULL($datepickers)." ถึงวันที่ ".thaiDateFULL($datepickert); ?> 
              <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
             </h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ชื่อรายการ</th>
                  <th>จำนวนครั้งทั้งหมด (VN,AN)</th>
                  <th>จำนวนผู้รับบริการทั้งหมด (HN)</th>
                  <th>ประกันสุขภาพ</th>
                  <th>ประกันสังคม</th>
                  <th>ข้าราชการ</th>
                  <th>อปท.</th>
                  <th>ต่างด้าว</th>
                  <th>พรบ.</th>
                  <th>ชำระเงิน</th>
                </tr>
                <tr>
                  <td class="fo_resout">จำนวนครั้งของผู้ป่วยนอก</td>
                  <td class="rr"><?php echo number_format($row_main['all_vn'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['all_hn'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['uc'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['sss'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['sks'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['opt'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['ufo'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['ins'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main['finance'],0);?></td>
                </tr>
                <tr>
                  <td class="fo_resout">จำนวนครั้งของผู้ป่วยใน</td>
                  <td class="rr"><?php echo number_format($row_main_2['all_an'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['all_hn'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['uc'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['sss'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['sks'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['opt'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['ufo'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['ins'],0);?></td>
                  <td class="rr"><?php echo number_format($row_main_2['finance'],0);?></td>
                </tr>
                <tr>
                  <td class="fo_resout">จำนวนวันนอน</td>
                  <td colspan="9" class="fo_resout fo"><?php echo number_format($row__s['sleep_adm'],0); ?></td>
                </tr>
                <tr>
                  <td class="fo_resout">จำนวนเสียชีวิต (ราย)</td>
                  <td colspan="9" class="fo_resout fo"><?php echo number_format($row__d['total'],0);?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

    </section>
<?php
}
?>
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
