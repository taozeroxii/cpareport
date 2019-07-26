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
          รายงานผู้ป่วยใน >  ส่งเบิก Sip09  (สิทธิประกันสังคม IPD)
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="sss_sip09_ipd.php">
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
          $sql = " SELECT i.regdate,i.regtime,i.dchdate,i.dchtime,a.admdate,p.cid,p.hn,i.an,      
          p.pname,p.fname,p.lname,p.birthday,na.name as nationality_name, occ.name as occupation_name ,
          s.name as sex, a.age_y, dt.licenseno,dt.pname as dot_pname,dt.fname as dot_fname,dt.lname as dot_lname,
          i.dchstts,ds.name as dischargestatus,i.dchtype,dc.name as dischargetype,
          w.ward , w.name as ward_name,ip.pttype,ptt.name as pttype_name,
          d.icd10 as pri_diag,cc.icd10 as sec_diag , cc1.icd9 as icd9,
          dt2.pname as dx_diag_pname ,dt2.fname as dx_diag_fname,dt2.lname as dx_diag_lname, 

          sum(case when o.income in ('01') then o.sum_price else 0 end) as sum1,   
          sum(case when o.income in ('02') then o.sum_price else 0 end) as sum2,   
          sum(case when o.income in ('03') then o.sum_price else 0 end) as sum3,   
          sum(case when o.income in ('04') then o.sum_price else 0 end) as sum4, 
          sum(case when o.income in ('05') then o.sum_price else 0 end) as sum5, 
          sum(case when o.income in ('06') then o.sum_price else 0 end) as sum6,   
          sum(case when o.income in ('07') then o.sum_price else 0 end) as sum7,    
          sum(case when o.income in ('08') then o.sum_price else 0 end) as sum8,   
          sum(case when o.income in ('09') then o.sum_price else 0 end) as sum9,   
          sum(case when o.income in ('10') then o.sum_price else 0 end) as sum10,   
          sum(case when o.income in ('11') then o.sum_price else 0 end) as sum11,   
          sum(case when o.income in ('12') then o.sum_price else 0 end) as sum12,   
          sum(case when o.income in ('13') then o.sum_price else 0 end) as sum13,
          sum(case when o.income in ('14') then o.sum_price else 0 end) as sum14,
          sum(case when o.income in ('15') then o.sum_price else 0 end) as sum15,
          sum(case when o.income in ('16') then o.sum_price else 0 end) as sum16,
          sum(case when o.income in ('17') then o.sum_price else 0 end) as sum17,
          sum(case when o.income in ('18') then o.sum_price else 0 end) as sum18,
          sum(case when o.income in ('19') then o.sum_price else 0 end) as sum19,
          sum(case when o.income in ('20') then o.sum_price else 0 end) as sum20,
          sum(case when o.income not in ('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20') 
          then o.sum_price else 0 end) as sum_not, 
          sum(case when o.income <> '' then o.sum_price else 0 end) as total , 
          sum(case when o.finance_number is null then o.sum_price else 0 end) as finance_null , 
          ip.hospmain,concat(h.hosptype,h.name) as hospname
          from ovst ov
          inner join ipt i on i.an=ov.an
          inner join opitemrece o on o.an = ov.an  
          inner join ipt_pttype ip on ip.an = ov.an and o.pttype = ip.pttype  
          inner join patient p on p.hn = i.hn    
          left join an_stat a on ov.an = a.an  
          left join hospcode h on h.hospcode = ip.hospmain    
          left join sex s on s.code = p.sex   
          left join iptdiag d on d.an = i.an and d.diagtype = '1' and regexp_replace(left(d.icd10,1),'[a-zA-Z]','','g')='' 
          left join ipt_doctor_list idl on idl.an=i.an and idl.ipt_doctor_type_id='1' and idl.active_doctor='Y'
          left join doctor dt on dt.code=idl.doctor
          left join doctor dt2 on dt2.code=d.doctor
          left join dchstts ds on ds.dchstts=i.dchstts
          left join dchtype dc on dc.dchtype=i.dchtype
          left join ward w on w.ward=i.ward 
          left join pttype ptt on ptt.pttype=ip.pttype
          left join nationality na on na.nationality=p.nationality
          left join occupation occ on occ.occupation=p.occupation
          left join (select cc.an,array_to_string(array_agg(concat('(',diagtype,') ',cc.icd10)),',') as icd10   
          from (select i.an,ipd1.icd10 ,ipd1.diagtype
          from ipt i 
          left join iptdiag ipd1 on i.an=ipd1.an
          where i.dchdate between '".$datepickers."' and '".$datepickert."'
          and ipd1.icd10<>'' and diagtype<>'1' ) cc  
          group by cc.an ) cc on cc.an=i.an

          left join (select cc1.an,array_to_string(array_agg(cc1.icd9),',') as icd9 
          from (select i.an,ipo.icd9 
          from ipt i 
          left join iptoprt ipo on i.an=ipo.an
          where i.dchdate between '".$datepickers."' and '".$datepickert."'
          and ipo.icd9<>'' ) cc1  
          group by cc1.an ) cc1 on cc1.an=i.an

          where i.dchdate between '".$datepickers."' and '".$datepickert."'
          and ip.pttype='34'
          group by i.regdate,i.regtime,i.dchdate,i.dchtime,a.admdate,p.cid,p.hn,i.an,ip.hospmain,hospname,p.pname,p.    fname,p.lname,p.birthday,s.name,pri_diag, a.age_y ,dt.licenseno,dt.pname,dt.fname,dt.lname,i.dchstts,
          dischargestatus,i.dchtype,dischargetype,nationality_name,occupation_name,
          w.ward ,  ward_name , dot_pname,dot_fname,dot_lname,ip.pttype, pttype_name,sec_diag,icd9,
          dx_diag_pname ,dx_diag_fname,dx_diag_lname ";

          $result = pg_query($sql);
          $total = pg_num_rows($result); 
//echo $sql;
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    Sip09
                    <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                  </h3>
                  <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
                  <a href="excel_sip09.php?dt=<?php echo $datepickers;?>&&de=<?php echo $datepickert ;?>" target="_blank"><button type="" class="btn btn-default pull-right" class="btn btn-success btn-lg">
                    <!-- <img src="image/excel_iocn.png" width="80px" height="20px"> -->Excel
                  </button>
                </a>
              </div>
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered  table-hover table-striped ">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>regdate</th>
                      <th>regtime</th>
                      <th>dchdate</th>
                      <th>dchtime</th>
                      <th>admdate</th>
                      <th>cid</th>
                      <th>hn</th>
                      <th>an</th>
                      <th>pname</th>
                      <th>fname</th>
                      <th>lname</th>
                      <th>birthday</th>
                      <th>nationality_name</th>
                      <th>occupation_name</th>
                      <th>sex</th>
                      <th>age_y</th>
                      <th>licenseno</th>
                      <th>dot_pname</th>
                      <th>dot_fname</th>
                      <th>dot_lname</th>
                      <th>dchstts</th>
                      <th>dischargestatus</th>
                      <th>dchtype</th>
                      <th>dischargetype</th>
                      <th>ward</th>
                      <th>ward_name</th>
                      <th>pttype</th>
                      <th>pttype_name</th>
                      <th>pri_diag</th>
                      <th>sec_diag</th>
                      <th>icd9</th>
                      <th>dx_diag_pname</th>
                      <th>dx_diag_fname</th>
                      <th>dx_diag_lname</th>
                      <th>sum1</th>
                      <th>sum2</th>
                      <th>sum3</th>
                      <th>sum4</th>
                      <th>sum5</th>
                      <th>sum6</th>
                      <th>sum7</th>
                      <th>sum8</th>
                      <th>sum9</th>
                      <th>sum10</th>
                      <th>sum11</th>
                      <th>sum12</th>
                      <th>sum13</th>
                      <th>sum14</th>
                      <th>sum15</th>
                      <th>sum16</th>
                      <th>sum17</th>
                      <th>sum18</th>
                      <th>sum19</th>
                      <th>sum20</th>
                      <th>sum_not</th>
                      <th>total</th>
                      <th>finance_null</th>
                      <th>hospmain</th>
                      <th>hospname</th>
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
                        <td><?php echo thaiDate($row_result['regdate']); ?></td>
                        <td><?php echo $row_result['regtime']; ?></td>
                        <td><?php echo thaiDate($row_result['dchdate']); ?></td>
                        <td><?php echo $row_result['dchtime']; ?></td>
                        <td><?php echo $row_result['admdate']; ?></td>
                        <td><?php echo " ".$row_result['cid']; ?></td>
                        <td><?php echo $row_result['hn']; ?></td>
                        <td><?php echo $row_result['an']; ?></td>
                        <td><?php echo $row_result['pname']; ?></td>
                        <td><?php echo $row_result['fname']; ?></td>
                        <td><?php echo $row_result['lname']; ?></td>
                        <td><?php echo thaiDate($row_result['birthday']); ?></td>
                        <td><?php echo $row_result['nationality_name']; ?></td>
                        <td><?php echo $row_result['occupation_name']; ?></td>
                        <td><?php echo $row_result['sex']; ?></td>
                        <td><?php echo $row_result['age_y']; ?></td>
                        <td><?php echo $row_result['licenseno']; ?></td>
                        <td><?php echo $row_result['dot_pname']; ?></td>
                        <td><?php echo $row_result['dot_fname']; ?></td>
                        <td><?php echo $row_result['dot_lname']; ?></td>
                        <td><?php echo $row_result['dchstts']; ?></td>
                        <td><?php echo $row_result['dischargestatus']; ?></td>
                        <td><?php echo $row_result['dchtype']; ?></td>
                        <td><?php echo $row_result['dischargetype']; ?></td>
                        <td><?php echo $row_result['ward']; ?></td>
                        <td><?php echo $row_result['ward_name']; ?></td>
                        <td><?php echo $row_result['pttype']; ?></td>
                        <td><?php echo $row_result['pttype_name']; ?></td>
                        <td><?php echo $row_result['pri_diag']; ?></td>
                        <td><?php echo $row_result['sec_diag']; ?></td>
                        <td><?php echo $row_result['icd9']; ?></td>
                        <td><?php echo $row_result['dx_diag_pname']; ?></td>
                        <td><?php echo $row_result['dx_diag_fname']; ?></td>
                        <td><?php echo $row_result['dx_diag_lname']; ?></td>
                        <td><?php echo $row_result['sum1']; ?></td>
                        <td><?php echo $row_result['sum2']; ?></td>
                        <td><?php echo $row_result['sum3']; ?></td>
                        <td><?php echo $row_result['sum4']; ?></td>
                        <td><?php echo $row_result['sum5']; ?></td>
                        <td><?php echo $row_result['sum6']; ?></td>
                        <td><?php echo $row_result['sum7']; ?></td>
                        <td><?php echo $row_result['sum8']; ?></td>
                        <td><?php echo $row_result['sum9']; ?></td>
                        <td><?php echo $row_result['sum10']; ?></td>
                        <td><?php echo $row_result['sum11']; ?></td>
                        <td><?php echo $row_result['sum12']; ?></td>
                        <td><?php echo $row_result['sum13']; ?></td>
                        <td><?php echo $row_result['sum14']; ?></td>
                        <td><?php echo $row_result['sum15']; ?></td>
                        <td><?php echo $row_result['sum16']; ?></td>
                        <td><?php echo $row_result['sum17']; ?></td>
                        <td><?php echo $row_result['sum18']; ?></td>
                        <td><?php echo $row_result['sum19']; ?></td>
                        <td><?php echo $row_result['sum20']; ?></td>
                        <td><?php echo $row_result['sum_not']; ?></td>
                        <td><?php echo $row_result['total']; ?></td>
                        <td><?php echo $row_result['finance_null']; ?></td>
                        <td><?php echo $row_result['hospmain']; ?></td>
                        <td><?php echo $row_result['hospname']; ?></td>
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