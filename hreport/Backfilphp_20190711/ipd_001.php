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
        รายงานผู้ป่วยใน > สรุปค่ารักษาผู้ป่วยใน
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="ipd_001.php">
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
$sql = " SELECT i.vn, i.an, i.hn, i.regdate as vstdate, i.dchdate,   
       p.cid, p.pname, p.fname, p.lname,  
       a.age_y,
       CONCAT(i.pttype,' | ',ptt.name) as ptty, cp.company_name as company_contact,   
       max(a.pdx) as pdx, max(i2.hospmain) as hmain, max(i2.hospsub) as hsub,  
       (select referin_number from referin where hn = i.hn and i.regdate between refer_date and expire_date limit 1) as referin_no,  
       (select refer_hospcode from referin where hn = i.hn and i.regdate between refer_date and expire_date limit 1) as refer_hcode,  
       (select refer_number from referout where vn = i.vn limit 1) as referout_no,  
       (select refer_hospcode from referout where vn = i.vn limit 1) as referout_hcode,  
       null::varchar(200) as icd9,
       dt.name as dchtype_name, concat(dc.licenseno,' ',dc.pname, dc.fname,' ',dc.lname) as dch_doc, 
       sum(o.sum_price)+sum(o.discount) as sum_price,sum(o.discount) as discount,  
       sum(case when o.paidst in ('02') then o.sum_price else null end) as finance_02, 
       sum(case when o.paidst in ('01') then o.sum_price else null end) as finance_01,
    sum(case when o.paidst in ('03') then o.sum_price else null end) as finance_03, 
       sum(case when o.finance_number is null then o.sum_price else null end) as finance_null,
  ( select sum(rp.total_amount) as total  
                                       from ipt ii                                                    
                                       left join rcpt_print rp on ii.an = rp.vn and rp.status='OK'    
                                       where ii.an=i.an and rp.pttype=i.pttype
                                    and ii.confirm_discharge = 'Y' )as bill_price
       from ipt i  
       inner join an_stat a on i.an = a.an  
       inner join opitemrece o on i.an = o.an  
       inner join ipt_pttype i2 on o.pttype = i2.pttype and o.an = i2.an  
       left join pttype ptt on ptt.pttype = i2.pttype
       inner join patient p on i.hn = p.hn  
       left join dchtype dt on i.dchtype = dt.dchtype 
       left join doctor dc on i.dch_doctor = dc.code 
       left outer join company_contact cp on i2.company_id = cp.company_id   
       where 1=1 
       and i.dchdate between '".$datepickers."' and '".$datepickert."'  
    and p.fname not like '%ทดสอบ%'
    and o.pttype in (select distinct pttype from ipt where dchdate between '".$datepickers."' and '".$datepickert."'  )
       group by i.an,i.hn, i.regdate, p.cid, p.pname, p.fname,  
       p.lname, a.age_y, ptty, company_contact, dchtype_name, dch_doc
    order by ptty,i.an ";

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
                    สรุปค่ารักษาผู้ป่วยใน
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