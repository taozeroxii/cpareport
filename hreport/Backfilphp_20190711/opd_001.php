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
        รายงานผู้ป่วยนอก > สรุปค่ารักษาผู้ป่วยนอก
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="opd_001.php">
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
$sql = " SELECT ov.vn, '' as an, ov.hn, ov.vstdate, null as dchdate,  
     p.cid, p.pname, p.fname, p.lname,  
      CONCAT(ov.pttype,' | ',ptt.name) as ptty, '' as company_contact,  
     (select string_agg(icd10,', ') from ovstdiag where vn = ov.vn and REGEXP_REPLACE(left(icd10,1), '[0-9]', '')='') as icd9,  
     max(v1.pdx) as pdx, max(v2.hospmain) as hmain, max(v2.hospsub) as hsub,  
     (select referin_number from referin where hn = ov.hn and ov.vstdate between refer_date and coalesce(expire_date,refer_date) limit 1) as referin_no,  
     (select refer_hospcode from referin where hn = ov.hn and ov.vstdate between refer_date and coalesce(expire_date,refer_date) limit 1) as refer_hcode, 
     (select refer_number from referout where vn = ov.vn limit 1) as referout_no,  
     (select refer_hospcode from referout where vn = ov.vn limit 1) as referout_hcode,  
     sum(o.sum_price) as sum_price,sum(o.discount) as discount,  
     sum(case when o.paidst in ('02') then o.sum_price else null end) as finance_02, 
     sum(case when o.paidst in ('01') then o.sum_price else null end) as finance_01, 
   sum(case when o.paidst in ('03') then o.sum_price else null end) as finance_03,
     sum(case when o.finance_number is null then o.sum_price else null end) as finance_null, 
     (select sum(rp.total_amount) from rcpt_print rp where ov.vn = rp.vn and rp.status='OK' ) as bill_price 
     from ovst ov    
     left join vn_stat v1 on ov.vn=v1.vn   
     left join opitemrece o on ov.vn = o.vn  
     left join visit_pttype v2 on o.pttype = v2.pttype and o.vn = v2.vn  
     left join pttype ptt on ptt.pttype = v2.pttype
     left join patient p on v1.hn = p.hn  
     where ov.vstdate between '".$datepickers."' and '".$datepickert."' 
     and p.fname not like '%ทดสอบ%' 
     and (ov.anonymous_visit is null or ov.anonymous_visit = 'N' ) 
     group by ov.vn,ov.hn, ov.vstdate, p.cid, p.pname, p.fname, p.lname, ptty
   order by ov.vstdate,ov.hn,ptty ";

$result = pg_query($sql);
$row_main = pg_fetch_array($result);
$total = pg_num_rows($result); 
//echo $sql;
?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                    สรุปค่ารักษาผู้ป่วยนอก
                  <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
              </h3>
               <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered  table-hover table-striped ">
                <thead>
                <tr>
                                        <th>#</th>
                                        <th>vn</th>
                                        <th>hn</th>
                                        <th>an</th>
                                        <th>vstdate</th>
                                        <th>dchdate</th>
                                        <th>cid</th>
                                        <th>pname</th>
                                        <th>fname</th>
                                        <th>lname</th>
                                        <th>pttype</th>
                                        <th>company_contact</th>
                                        <th>icd9</th>
                                        <th>pdx</th>
                                        <th>hmain</th>
                                        <th>hsub</th>
                                        <th>referin_no</th>
                                        <th>refer_hcode</th>
                                        <th>referout_no</th>
                                        <th>referout_hcode</th>
                                        <th>sum_prince</th>
                                        <th>discount</th>
                                        <th>finance_02</th>
                                        <th>finance_01</th>
                                        <th>finance_03</th>
                                        <th>finance_null</th>
                                        <th>bill_price</th>
                </tr>
                </thead>
                <tbody>
                <? $rw=0;
                                while($row_result = pg_fetch_array($result)) 
                                { 
                                $rw++;
                            ?>
                                        <tr class="ho" >
                                          <td><?php echo $rw; ?></td>
                                          <td><?php echo $row_result['vn']; ?></td>
                                          <td><?php echo $row_result['hn']; ?></td>
                                          <td><?php echo $row_result['an']; ?></td>
                                          <td><?php echo thaidate($row_result['vstdate']); ?></td>
                                          <td><?php echo $row_result['dchdate']; ?></td>
                                          <td><?php echo $row_result['cid']; ?></td>
                                          <td><?php echo $row_result['pname']; ?></td>
                                          <td><?php echo $row_result['fname']; ?></td>
                                          <td><?php echo $row_result['lname']; ?></td>
                                          <td><?php echo $row_result['ptty']; ?></td>
                                          <td><?php echo $row_result['company_contact']; ?></td>
                                          <td><?php echo $row_result['icd9']; ?></td>
                                          <td><?php echo $row_result['pdx']; ?></td>
                                          <td><?php echo $row_result['hmain']; ?></td>
                                          <td><?php echo $row_result['hsub']; ?></td>
                                          <td><?php echo $row_result['referin_no']; ?></td>
                                          <td><?php echo $row_result['refer_hcode']; ?></td>
                                          <td><?php echo $row_result['referout_no']; ?></td>
                                          <td><?php echo $row_result['referout_hcode']; ?></td>
                                          <td><?php echo $row_result['sum_prince']; ?></td>
                                          <td><?php echo $row_result['discount']; ?></td>
                                          <td><?php echo $row_result['finance_02']; ?></td>
                                          <td><?php echo $row_result['finance_01']; ?></td>
                                          <td><?php echo $row_result['finance_03']; ?></td>
                                          <td><?php echo $row_result['finance_null']; ?></td>
                                          <td><?php echo $row_result['bill_price']; ?></td>
                                        </tr>
                                     <?php  
                                        }
                                     ?>                                   
                </tbody>
                <tfoot>
                <tr>
               <th>#</th>
                                        <th>vn</th>
                                        <th>hn</th>
                                        <th>an</th>
                                        <th>vstdate</th>
                                        <th>dchdate</th>
                                        <th>cid</th>
                                        <th>pname</th>
                                        <th>fname</th>
                                        <th>lname</th>
                                        <th>pttype</th>
                                        <th>company_contact</th>
                                        <th>icd9</th>
                                        <th>pdx</th>
                                        <th>hmain</th>
                                        <th>hsub</th>
                                        <th>referin_no</th>
                                        <th>refer_hcode</th>
                                        <th>referout_no</th>
                                        <th>referout_hcode</th>
                                        <th>sum_prince</th>
                                        <th>discount</th>
                                        <th>finance_02</th>
                                        <th>finance_01</th>
                                        <th>finance_03</th>
                                        <th>finance_null</th>
                                        <th>bill_price</th>
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