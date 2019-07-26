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
                <h1>
                    ผู้ป่วยผ่าตัดคลอด icd9 741-7499 </h1>
            </section>
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="queryO82.php">
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
                <hr>

                <?php

                $datepickers    = $_POST['datepickers'];
                list($m, $d, $Y)  = split('/', $datepickers);
                $datepickers    = trim($Y) . "-" . trim($m) . "-" . trim($d);
                $datepickert    = $_POST['datepickert'];
                list($m, $d, $Y)  = split('/', $datepickert);
                $datepickert    = trim($Y) . "-" . trim($m) . "-" . trim($d);

                if ($datepickers != "--") {

                    $sql = "select ipt.hn,ipt.an,ipto.icd9,icd9.name AS icdn,string_agg(iptd.icd10, ' || ') AS diag,
                    concat(pt.pname,' ',pt.fname,' ',pt.lname) AS patientname,
                    ipt.regdate,ipto.opdate,ipt.pttype AS codesit ,pty.name AS sit,ipt.admdoctor AS admitdoctor,
                    ipto.doctor AS oprtdoctor
                from ipt ipt 
                    inner join iptoprt  ipto on ipto.an = ipt.an AND icd9 like '74%' AND ipto.opdate  BETWEEN '" . $datepickers . "' and '" . $datepickert . "'
                    inner join patient pt on ipt.hn = pt.hn  
                    inner join pttype pty on pty.pttype = ipt.pttype 
                    inner join icd9cm1 icd9 on ipto.icd9 = icd9.code
                    left join iptdiag iptd on iptd.an = ipt.an
                group by ipt.hn,ipt.an,ipto.icd9,patientname,ipto.opdate,ipt.pttype,pty.name ,ipto.doctor,icd9.name
                order by ipto.icd9";
                    $result = pg_query($sql);

                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title co_dep"><?php echo "ข้อมูลช่วงวันที่ " . thaiDatefull($datepickers) . " ถึงวันที่ " . thaiDatefull($datepickert) ?>
                                        <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <?php $getdata = array();
                                    if ($_POST['submit'] != "") { ?>
                                        <table class="table table-bordered  table-hover table-striped " id="example1">
                                            <thead>
                                                <tr>
                                                    <th style='text-align:center'>hn</th>
                                                    <th style='text-align:center'>an</th>
                                                    <th style='text-align:center'>icd9</th>
                                                    <th style='text-align:center'>ชื่อโรค</th>
                                                    <th style='text-align:center'>diag</th>
                                                    <th style='text-align:center'>ชื่อผู้ป่วย</th>
                                                    <th style='text-align:center'>regdate</th>
                                                    <th style='text-align:center'>operdate</th>
                                                    <th style='text-align:center'>รหัสสิทธิ</th>
                                                    <th style='text-align:center'>สิทธิ</th>
                                                    <th style='text-align:center'>admit_doctor</th>
                                                    <th style='text-align:center'>oprt_doctor</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php while ($row_result2 = pg_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?php echo  $row_result2['hn']; ?></td>
                                                        <td><?php echo  $row_result2['an']; ?></td>
                                                        <td><?php echo  $row_result2['icd9']; ?></td>
                                                        <td><?php echo  $row_result2['icdn']; ?></td>
                                                        <td><?php echo  $row_result2['diag']; ?></td>
                                                        <td><?php echo  $row_result2['patientname']; ?></td>
                                                        <td><?php echo  $row_result2['regdate']; ?></td>
                                                        <td><?php echo  $row_result2['opdate']; ?></td>
                                                        <td><?php echo  $row_result2['codesit']; ?></td>
                                                        <td><?php echo  $row_result2['sit']; ?></td>
                                                        <td><?php echo  $row_result2['admitdoctor']; ?></td>
                                                        <td><?php echo  $row_result2['oprtdoctor']; ?></td>
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
        <?php
        }
        ?>

        <!--///////////////////////////////////////////// Modal รับ///////////////////////////////////////////////////////-->
        <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        SQL Query
                    </div>

                    <div class="model-body ml-5 mt-2">
                         <?php echo $result;?> 
                    </div>

                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

        <div class="modal fade bd-example-modal-xl" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        นิยาม
                    </div>

                    <div class="model-body ml-5 mt-2">
                        <img src="image/dh0101.jpg" alt="โหลดรูปไม่สำเร็จ" width="95%">
                    </div>

                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>
        </section>
    </div>


    <?php include "config/footer.class.php"; ?>
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