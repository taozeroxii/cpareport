<!DOCTYPE html>
<html>
<?php include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
$bm = new Timer;
$bm->start();
include "config/head.class.php";
for ($i = 0; $i < 100000; $i++) {
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
                <h1>รายการผู้ป่วยโรคเบาหวานตามรหัส ICD10 E119 ห้องตรวจ 292</h1>
            </section>
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="opde119.php">
                                            <input type="text" class="form-control" id="datepickers" placeholder="วันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off">
                                            <input type="text" class="form-control" id="datepickert" placeholder="วันที่สิ้นสุด" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off">
                                            <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
                                        </form>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                $datepickers    = $_POST['datepickers'];
                list($m, $d, $Y)  = split('/', $datepickers);
                $datepickers    = trim($Y) . "-" . trim($m) . "-" . trim($d);
                $datepickert    = $_POST['datepickert'];
                list($m, $d, $Y)  = split('/', $datepickert);
                $datepickert    = trim($Y) . "-" . trim($m) . "-" . trim($d);

                if ($datepickers != "--") {

                    $sql = "SELECT ovs.hn,concat(pt.pname,' ',pt.fname,' ',pt.lname)AS patientname,ksk.department,
                    ovd.icd10,cm.regdate AS regbaowhan,cm.lastvisit AS lastvisit ,cm.note,cm.begin_year,
                        cms.clinic_member_status_name AS status
                    FROM ovst ovs
                        inner join ovstdiag ovd on ovd.hn = ovs.hn AND  ovd.icd10 = 'E119' 
                        and ovd.vstdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                        inner join kskdepartment ksk on ksk.depcode = ovs.main_dep
                        inner join icd101 icd on icd.code = ovd.icd10
                        left  join patient pt on pt.hn = ovd.hn
                        inner join ovstost ost on ost.ovstost = ovs.ovstost 
                        left join  clinicmember cm on cm.hn = ovs.hn 
                            and cm.clinic = '001' and cm.clinic_member_status_id in ('3','10')
                        LEFT JOIN clinic_member_status cms ON cms.clinic_member_status_id = cm.clinic_member_status_id
                    WHERE ovs.vstdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                    AND  ovs.ovstost not in ('52','04','54')  AND ovs.main_dep = '292'
                    group by ovs.hn,ksk.department,concat(pt.pname,' ',pt.fname,' ',pt.lname),ovd.icd10,icd.name,icd.tname,cm.regdate,cm.lastvisit,cm.note,cm.begin_year,status
                    ORDER BY cm.lastvisit desc";
                    $result = pg_query($sql);

                    $allrec = "SELECT ovs.hn,concat(pt.pname,' ',pt.fname,' ',pt.lname)AS patientname,ksk.department,
                        ovd.icd10,cm.regdate AS regbaowhan,cm.lastvisit AS lastvisit ,cm.note,cm.begin_year,
                        cms.clinic_member_status_name AS status
                    FROM ovst ovs
                        inner join ovstdiag ovd on ovd.hn = ovs.hn AND  ovd.icd10 = 'E119' 
                        and ovd.vstdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                        inner join kskdepartment ksk on ksk.depcode = ovs.main_dep
                        inner join icd101 icd on icd.code = ovd.icd10
                        left  join patient pt on pt.hn = ovd.hn
                        inner join ovstost ost on ost.ovstost = ovs.ovstost 
                        left join  clinicmember cm on cm.hn = ovs.hn 
                            and cm.clinic = '001' and cm.clinic_member_status_id in ('3','10')
                        LEFT JOIN clinic_member_status cms ON cms.clinic_member_status_id = cm.clinic_member_status_id
                    WHERE ovs.vstdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                    AND  ovs.ovstost not in ('52','04','54')  AND ovs.main_dep = '292'
                    group by ovs.hn,ksk.department,concat(pt.pname,' ',pt.fname,' ',pt.lname),ovd.icd10,icd.name,icd.tname,cm.regdate,cm.lastvisit,cm.note,cm.begin_year,status
                    ORDER BY lastvisit desc";
                    $queryalrecord = pg_query($allrec);

                    ?>


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title co_dep"><?php echo "ข้อมูลช่วงวันที่ " . thaiDatefull($datepickers) . " ถึงวันที่ " . thaiDatefull($datepickert) ?>
                                        <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
                                        <?php echo  '<p>ผู้ป่วยโรคเบาหวานทั้งหมด : ' . $totaldata = pg_num_rows($queryalrecord) . ' รายการ ตามHn</p>'; ?>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <?php $getdata = array();
                                    if ($_POST['submit'] != "") { ?>
                                        <table class="table table-bordered  table-hover table-striped " style='text-align:center' id="example1">
                                            <thead>
                                                <tr>
                                                    <th style='text-align:center'>hn</th>
                                                    <th style='text-align:center'>ชื่อผู้ป่วย</th>
                                                    <th style='text-align:center'>ห้องตรวจ</th>
                                                    <th style='text-align:center'>รหัสโรค</th>
                                                    <th style='text-align:center'>วันขึ้นทะเบียน</th>
                                                    <th style='text-align:center'>วันมาล่าสุด</th>
                                                    <th style='text-align:center'>NOTE</th>
                                                    <th style='text-align:center'>ปีที่เป็น</th>
                                                    <th style='text-align:center'>สถานะ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row_result2 = pg_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?php echo  $row_result2['hn']; ?> </td>
                                                        <td><?php echo  $row_result2['patientname']; ?> </td>
                                                        <td><?php echo  $row_result2['department']; ?></td>
                                                        <td><?php echo  $row_result2['icd10']; ?></td>
                                                        <td><?php echo  $row_result2['regbaowhan']; ?></td>
                                                        <td><?php echo  $row_result2['lastvisit']; ?></td>
                                                        <td><?php echo  $row_result2['note']; ?></td>
                                                        <td><?php echo  $row_result2['begin_year']; ?></td>
                                                        <td><?php echo  $row_result2['status']; ?></td>
                                                    <?php }
                                                } ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <?php include "config/footer.class.php"; ?>
        <?php
        }
        ?>



        <?php include "config/js.class.php" ?>
        <script>
            $(function() {
                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })
        </script>
</body>

</html>