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
        รายงานทั่วไปทดสอบ
        <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <div class="container">
                  <form class="form-inline" method="POST" action="index.php">
                  <input type="text" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                  <input type="text" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                  <select class="select2" name="c_department[]" id="c_department" multiple="multiple" style="width: 30%;" placeholder="คลินิก"></select>
                  <select class="select2" name="i_dropdown[]" id="i_dropdown" multiple="multiple" style="width: 30%;" placeholder="สิทธิ"></select>
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
$sql = " SELECT a.hn,a.vn
      ,a.vstdate,a.vsttime
      ,CONCAT(a.spclty,'|',sst.name) as dep_name
      ,CONCAT(a.main_dep,'|',kkk.department) as clinic_name
      ,CONCAT(a.pttype,'|',ppt.name) as ptty
      ,p.cid
      ,p.birthday
      ,CONCAT(p.pname,p.fname,' ',p.lname) AS fullname
      ,s.name AS sex
       ,(SELECT d1.icd10 FROM ovstdiag AS d1 WHERE a.vn  = d1.vn AND d1.diagtype = '1' GROUP BY d1.icd10) AS diag_type1      
       ,(SELECT string_agg(d1.icd10 , ' || ') AS icd10 FROM ovstdiag AS d1 WHERE a.vn  = d1.vn AND d1.diagtype = '2') AS diag_type2
       ,(SELECT string_agg(d1.icd10 , ' || ') AS icd10 FROM ovstdiag AS d1 WHERE a.vn  = d1.vn AND d1.diagtype = '3') AS diag_type3
       ,(SELECT string_agg(d1.icd10 , ' || ') AS icd10 FROM ovstdiag AS d1 WHERE a.vn  = d1.vn AND d1.diagtype = '4') AS diag_type4
       ,(SELECT string_agg(d1.icd10 , ' || ') AS icd10 FROM ovstdiag AS d1 WHERE a.vn  = d1.vn AND d1.diagtype = '5') AS diag_type5
       ,CONCAT(p.addrpart,'   หมู่.  ',p.moopart,' ',t.full_name ) addess
FROM ovst AS a
INNER JOIN patient AS p ON p.hn = a.hn
LEFT JOIN thaiaddress AS t ON t.tmbpart = p.tmbpart AND t.amppart = p.amppart AND t.chwpart = p.chwpart
LEFT JOIN ovstdiag AS b ON a.vn = b.vn
LEFT JOIN sex AS s ON s.code = p.sex
LEFT JOIN pttype AS ppt ON ppt.pttype = a.pttype
LEFT JOIN spclty as sst ON sst.spclty = a.spclty
LEFT JOIN kskdepartment as kkk ON kkk.depcode = a.main_dep
WHERE a.vstdate BETWEEN '".$datepickers."' AND '".$datepickert."' ";
if(sizeof($c_department)>0){
  $sql .= " AND a.main_dep in (";
    foreach ($c_department as $value) {
      $sql .="'" .$value. "',";
    }
    $sql = rtrim($sql,',');
    $sql .= ") ";
  }
if(sizeof($c_pttype )>0){
  $sql .= " AND a.pttype in (";
    foreach ($c_pttype as $value) {
      $sql .="'" .$value. "',";
    }
    $sql = rtrim($sql,',');
    $sql .= ") ";
  }
$sql .= " GROUP BY a.hn,a.vn,a.vstdate,fullname,s.name,addess,diag_type1,p.cid,p.birthday,a.vsttime,dep_name,ptty,clinic_name ";
$sql .= " ORDER BY diag_type1 DESC ";

$result = pg_query($sql);
$row_main = pg_fetch_array($result);
$total = pg_num_rows($result); 
//echo $sql;
?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ข้อมูล </h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>#</th>
                                        <th>hn</th>
                                        <th>vn</th>
                                        <th>vstdate</th>
                                        <th>vsttime</th>
                                        <th>dep_name</th>
                                        <th>clinic_name</th>
                                        <th>ptty</th>
                                        <th>cid</th>
                                        <th>birthday</th>
                                        <th>fullname</th>
                                        <th>sex</th>
                                        <th>diag_type1</th>
                                        <th>diag_type2</th>
                                        <th>diag_type3</th>
                                        <th>diag_type4</th>
                                        <th>diag_type5</th>
                                        <th>addess</th>
                </tr>
                </thead>
                <tbody>
                <? $rw=0;
                                while($row_result = pg_fetch_array($result)) 
                                { 
                                $rw++;
                            ?>
                                        <tr>
                                          <td><?php echo $rw; ?></td>
                                          <td><?php echo $row_result['hn']; ?></td>
                                          <td><?php echo $row_result['vn']; ?></td>
                                          <td><?php echo thaiDate($row_result['vstdate']); ?></td>
                                          <td><?php echo $row_result['vsttime']; ?></td>
                                          <td><?php echo $row_result['dep_name']; ?></td>
                                          <td><?php echo $row_result['clinic_name']; ?></td>
                                          <td><?php echo $row_result['ptty']; ?></td>
                                          <td><?php echo $row_result['cid']; ?></td>
                                          <td><?php echo $row_result['birthday']; ?></td>
                                          <td><?php echo $row_result['fullname']; ?></td>
                                          <td><?php echo $row_result['sex']; ?></td>
                                          <td><?php echo $row_result['diag_type1']; ?></td>
                                          <td><?php echo $row_result['diag_type2']; ?></td>
                                          <td><?php echo $row_result['diag_type3']; ?></td>
                                          <td><?php echo $row_result['diag_type4']; ?></td>
                                          <td><?php echo $row_result['diag_type5']; ?></td>
                                          <td><?php echo $row_result['addess']; ?></td>
                                        </tr>
                                     <?php  
                                        }
                                     ?>                                   
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                                        <th>hn</th>
                                        <th>vn</th>
                                        <th>vstdate</th>
                                        <th>vsttime</th>
                                        <th>dep_name</th>
                                        <th>clinic_name</th>
                                        <th>ptty</th>
                                        <th>cid</th>
                                        <th>birthday</th>
                                        <th>fullname</th>
                                        <th>sex</th>
                                        <th>diag_type1</th>
                                        <th>diag_type2</th>
                                        <th>diag_type3</th>
                                        <th>diag_type4</th>
                                        <th>diag_type5</th>
                                        <th>addess</th>
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
