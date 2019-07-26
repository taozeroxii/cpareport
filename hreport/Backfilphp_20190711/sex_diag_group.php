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
          เวชกรรมสังคม > รายงานโรคผู้ป่วยทางเพศสัมพันธ์
        </h1>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <div class="container">
                    <form class="form-inline" method="POST" action="sex_diag_group.php">
                      <input type="text" class="form-control" placeholder="วันที่เริ่ม" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" >
                      <input type="text" class="form-control" placeholder="วันที่สิ้นสุด" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" >
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
          $sql = " SELECT  ov.hn,concat(pt.pname,' ',fname,' ',lname)AS fname_lname,pt.cid,
          case when pt.sex = '1' then 'ชาย' else 'หญิง' end AS sex,
          pt.birthday,EXTRACT(YEAR FROM age(cast(pt.birthday as date)))AS age,
          ov.vstdate,ksk.department AS clinic,ov.pttype AS code_sid ,pty.name AS sid_name,ovd.icd10,
          pt.addrpart,db.province,db.amphur,db.district,concat(pt.country,'(',nt.name,')') AS country
          FROM ovst ov 
          INNER JOIN ovstdiag ovd on ovd.vn = ov.vn AND ovd.icd10 
          in ('A500','A501','A502','A503','A504','A505','A506','A507','A508','A509','A51','A510','A511','A512','A513','A514',
          'A515','A519','A52','A520','A521','A522','A523','A527','A528','A529','A53','A530','A539','I980','M031','N290'
          'O981','A54','A540','A541','A542','A543','A544','A545','A546','A548','A549','K671','M730','N743','O982',
          'A55','A56','A560','A561','A562','N341','A57','A600','A601','A609','A630','A59','A590','A598','A599')
          LEFT JOIN patient pt on ov.hn = pt.hn
          LEFT JOIN pttype pty on pty.pttype = ov.pttype
          LEFT JOIN kskdepartment ksk on ov.main_dep = ksk.depcode
          LEFT JOIN dbaddress db on db.iddistrict = concat(pt.chwpart,pt.amppart,pt.tmbpart) 
          LEFT JOIN nationality nt on nt.nationality = pt.country
          WHERE ov.vstdate BETWEEN '".$datepickers."' AND '".$datepickert."'
          ORDER BY ov.vstdate ";

          $result = pg_query($sql);
          $total = pg_num_rows($result); 
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    รายงานโรคผู้ป่วยทางเพศสัมพันธ์
                    <small><?php echo " เวลาที่ใช้ในการประมวลผล ".$bm->stop()." วินาที "; ?></small>
                  </h3>
                  <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Template </button>
                </div>
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered  table-hover table-striped ">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>เลข ปปช.</th>
                        <th>เพศ</th>
                        <th>วันเกิด</th>
                        <th>อายุ</th>
                        <th>วันที่รับบริการ</th>
                        <th>คลินิก</th>
                        <th>สิทธิ์</th>
                        <th>icd</th>
                        <th>ที่อยู่</th>
                        <th>ตำบล</th>                        
                        <th>อำเภอ</th>
                        <th>จังหวัด</th>
                        <th>ประเทศ</th>
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
                          <td><?php echo $row_result['hn']; ?></td>
                          <td><?php echo $row_result['fname_lname']; ?></td>
                          <td><?php echo $row_result['cid']; ?></td>
                          <td><?php echo $row_result['sex']; ?></td>
                          <td><?php echo thaiDate($row_result['birthday']); ?></td>
                          <td><?php echo $row_result['age']; ?></td>
                          <td><?php echo thaiDate($row_result['vstdate']); ?></td>
                          <td><?php echo $row_result['clinic']; ?></td>
                          <td><?php echo $row_result['code_sid']." | ".$row_result['sid_name']; ?></td>
                          <td><?php echo $row_result['icd10']; ?></td>
                          <td><?php echo $row_result['addrpart']; ?></td>
                          <td><?php echo $row_result['district']; ?></td>  
                          <td><?php echo $row_result['amphur']; ?></td>                                                
                          <td><?php echo $row_result['province']; ?></td>
                          <td><?php echo $row_result['country']; ?></td> 
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
  </body>
  </html>