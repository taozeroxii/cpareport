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
                <h1>รายการผู้ป่วยโรคความดันโลหิตสูงตามรหัสโรค I10 ห้องตรวจ 292</h1>
            </section>
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="opdi10.php">
                                            <small>ช่วงวันที่จับจาก vn ผู้ป่วย</small> 
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

                    $sql = "
                            SELECT ovs.vstdate,ovs.hn,ksk.department,concat(pt.pname,' ',pt.fname,' ',pt.lname)AS name,ovd.icd10,icd.name AS en_name,icd.tname AS th_name
                            FROM ovst ovs
                                inner join ovstdiag ovd on ovd.hn = ovs.hn AND  ovd.icd10 = 'I10' 
                                and ovd.vstdate BETWEEN '2019-01-01' AND '2019-06-27'
                                inner join kskdepartment ksk on ksk.depcode = ovs.main_dep
                                inner join icd101 icd on icd.code = ovd.icd10
                                left  join patient pt on pt.hn = ovd.hn
                            WHERE ovs.vstdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                            AND  ovs.ovstost not in ('52','04')  AND ovs.main_dep = '292'
                            group by ovs.vstdate,ovs.hn,ksk.department,concat(pt.pname,' ',pt.fname,' ',pt.lname),ovd.icd10,icd.name,icd.tname
                            ORDER BY ovs.vstdate ";

                                            $result = pg_query($sql);

                                            $allrec = "
                            SELECT ovs.vstdate,ovs.hn,ksk.department,concat(pt.pname,' ',pt.fname,' ',pt.lname)AS name,ovd.icd10,icd.name AS en_name,icd.tname AS th_name
                            FROM ovst ovs
                                inner join ovstdiag ovd on ovd.hn = ovs.hn AND  ovd.icd10 = 'I10' 
                                and ovd.vstdate BETWEEN '2019-01-01' AND '2019-06-27'
                                inner join kskdepartment ksk on ksk.depcode = ovs.main_dep
                                inner join icd101 icd on icd.code = ovd.icd10
                                left  join patient pt on pt.hn = ovd.hn
                            WHERE ovs.vstdate BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                            AND  ovs.ovstost not in ('52','04')  AND ovs.main_dep = '292'
                            group by ovs.vstdate,ovs.hn,ksk.department,concat(pt.pname,' ',pt.fname,' ',pt.lname),ovd.icd10,icd.name,icd.tname
                            ORDER BY ovs.vstdate ";
                    $queryalrecord = pg_query($allrec);

                    ?>


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title co_dep"><?php echo "ข้อมูลช่วงวันที่ " . thaiDatefull($datepickers) . " ถึงวันที่ " . thaiDatefull($datepickert) ?>
                                        <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
                                        <?php echo  '<p>ผู้ป่วยโรคความดันทั้งหมด : ' . $totaldata = pg_num_rows($queryalrecord) . ' รายการ ตามHn</p>'; ?>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <?php $getdata = array();
                                    if ($_POST['submit'] != "") { ?>
                                        <table class="table table-bordered  table-hover table-striped " style='text-align:center' id="example1">
                                            <thead>
                                                <tr>
                                                    <th style='text-align:center'>visit</th>
                                                    <th style='text-align:center'>hn</th>
                                                    <th style='text-align:center'>ห้องตรวจ</th>
                                                    <th style='text-align:center'>ชื่อผู้ป่วย</th>
                                                    <th style='text-align:center'>รหัสโรค</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row_result2 = pg_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?php echo  $row_result2['vstdate']; ?> </td>
                                                        <td><?php echo  $row_result2['hn']; ?> </td>
                                                        <td><?php echo  $row_result2['department']; ?></td>
                                                        <td><?php echo  $row_result2['name']; ?></td>
                                                        <td><?php echo  $row_result2['icd10']; ?></td>
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