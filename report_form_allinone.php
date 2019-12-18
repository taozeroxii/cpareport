<!DOCTYPE html>
<html>
<?php
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/head.class.php";
include('config/my_con.class.php');
session_start();
$bm = new Timer;
$bm->start();
for ($i = 0; $i < 100000; $i++) {
    $i;
}

$sql         =  $_GET['sql'];
$send_excel =  $_GET['sql'];
$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '" . $sql . "'";
$res = mysqli_query($con, $topLevelItems);
foreach ($res as $item) {
    $sql_detail = $item['sql_code'];
    $sql_head   = $item['sql_head'];
}
include "config/timestampviewer.php"; //เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ
?>

<body class="hold-transition skin-blue sidebar-mini">
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <?php echo $sql_head; ?>
                <small><?php echo 'Viewer: ' . $countview; ?></small>
            </h1>
        </section>

        <section class="content">
            <div class="col-xs-12">
                <div class="box" style="padding:5px">
                    <div class="container-fluid">
                        <form class="form-inline" method="POST" action="#">
                            <div class="row">
                                <label for="datepickers">ช่วงวันที่มารับบริการ : </label>
                                <input type="text" class="form-control" id="datepickers" placeholder="ช่วงวันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off">
                                <input type="text" class="form-control" id="datepickert" placeholder="ถึงวันที่" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off">
                                <label>&nbsp; ช่วงอายุคนป่วย</label>
                                <select class="btn btn-default" name='beginage'required>
                                    <option selected >อายุเริ่ม..</option>
                                    <?php for ($fage = 0; $fage <= 120; $fage++) { ?>
                                        <option value="<? echo $fage; ?>"><?= $fage ?></option>
                                    <?php } ?>
                                </select>
                                <select class="btn btn-default" name='endage' required>
                                    <option selected>อายุถึง..</option>
                                    <?php for ($fage = 0; $fage <= 120; $fage++) { ?>
                                        <option value="<? echo $fage; ?>"><?= $fage ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <label>code และ hosguid : </label>
                                <select class="select2" name="diag_dental[]" id="diag_dental" multiple="multiple" style="width: 35%;"></select>
                                <label>&nbsp; สิทธิ</label>
                                <select class="select2" name="i_dropdown[]" id="i_dropdown" multiple="multiple" style="width: 15%;" placeholder="สิทธิ" title="เลือกสิทธิ์"></select>
                                <label>&nbsp; แพทย์</label>
                                <select class="select2" name="d_dropdown[]" id="d_dropdown" multiple="multiple" style="width: 15%;"></select>
                                <label>&nbsp; ห้องใช้งาน</label>
                                <select class="select2" name="r_dropdown[]" id="r_dropdown" multiple="multiple" style="width: 15%;"></select>
                            </div>
                            <div class="row">
                                <small style="color:red;">**หมายเหต: ข้อมูลจะจำกัดเพียง 1500 แถวเพื่อป้องกันการดึงข้อมูลที่มากเกินไปจนอาจทำให้ส่งผลต่อหน้างาน**</small>
                                <center><button type="submit" class="btn btn-default" style="width:50%;background-color:teal;margin-top:3px;color:white">Submit</button></center>
                            </div>
                        </form>
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

    $beginage    = $_POST['beginage'];
    $endage    = $_POST['endage'];

    $c_pttype       = $_POST['i_dropdown']; //เก็ฐค่าสิทธิ
    $d_doctor       = $_POST['d_dropdown']; //หมอ
    $dt_diag        = $_POST['diag_dental'];//ไดแอกทันตกรรม
    $r_room         = $_POST['r_dropdown'];//ห้อง

    if ($datepickers != "--") {
        $sql = " $sql_detail ";
        $sql = str_replace("{datepickers}", "'$datepickers'", $sql);
        $sql = str_replace("{datepickert}", "'$datepickert'", $sql);
        $sql = str_replace("{beginage}", "'$beginage'", $sql);
        $sql = str_replace("{endage}", "'$endage'", $sql);

        if (sizeof($c_pttype) > 0) {
            $sum_pttypes = "(";
            foreach ($c_pttype as $value) {
                $sum_pttypes .= "'" . $value . "',";
            }
            $sum_pttypes = rtrim($sum_pttypes, ',');
            $sum_pttypes .= ") ";
        } else {
            $selectypttype = 'SELECT pttype from pttype order by pttype';
            $querypttype = pg_query($selectypttype);


            $sum_pttypes = "(";
            while ($resultpty = pg_fetch_assoc($querypttype)) {
                $sum_pttypes .= "'" . $resultpty['pttype'] . "',";
            }
            $sum_pttypes = rtrim($sum_pttypes, ',');
            $sum_pttypes .= ") ";
            $sql = str_replace("{i_dropdown}", "$sum_pttypes", $sql);
        }
        $sql = str_replace("{i_dropdown}", "$sum_pttypes", $sql);

        // วนค่าเพิ่อแทนที่ตวแปรใร {d_doctor}  
        if (sizeof($d_doctor) > 0) {
            $sum_dc = "(";
            foreach ($d_doctor as $value) {
                $sum_dc .= "'" . $value . "',";
            }
            $sum_dc = rtrim($sum_dc, ',');
            $sum_dc .= ") ";
        } else {
            $selectdoctor = 'SELECT code from doctor order by code';
            $querydoctor = pg_query($selectdoctor);


            $sum_dc = "(";
            while ($resultdc = pg_fetch_assoc($querydoctor)) {
                $sum_dc .= "'" . $resultdc['code'] . "',";
            }
            $sum_dc = rtrim($sum_dc, ',');
            $sum_dc .= ") ";
            $sql = str_replace("{d_doctor}", "$sum_dc", $sql);
        }
        $sql = str_replace("{d_doctor}", "$sum_dc", $sql);



        // วนค่าเพิ่อแทนที่ตวแปรใน {diag_dental}  
        if (sizeof($dt_diag) > 0) {
            $sum_dtm = "(";
            foreach ($dt_diag as $value) {
                $sum_dtm .= "'" . $value . "',";
            }
            $sum_dtm = rtrim($sum_dtm, ',');
            $sum_dtm .= ") ";
        } else {
            $selectdtm = 'SELECT code from dttm order by code';
            $querydtm = pg_query($selectdtm);

            $sum_dtm = "(";
            while ($resultdtm = pg_fetch_assoc($querydtm)) {
                $sum_dtm .= "'" . $resultdtm['code'] . "',";
            }
            $sum_dtm = rtrim($sum_dtm, ',');
            $sum_dtm .= ")";
            $sql = str_replace("{diag_dental}", "$sum_dtm", $sql);
        }
        $sql = str_replace("{diag_dental}", "$sum_dtm", $sql);


        
        // วนค่าเพิ่อแทนที่ตวแปรใน {diag_dental}  
        if (sizeof($r_room) > 0) {
            $sum_r = "(";
            foreach ($r_room as $value) {
                $sum_r .= "'" . $value . "',";
            }
            $sum_r = rtrim($sum_r, ',');
            $sum_r .= ") ";
        } else {
            $selectksk = 'SELECT depcode from kskdepartment';
            $queryksk = pg_query($selectksk);

            $sum_r = "(";
            while ($resultksk = pg_fetch_assoc($queryksk)) {
                $sum_r .= "'" . $resultksk['depcode'] . "',";
            }
            $sum_r = rtrim($sum_r, ',');
            $sum_r .= ")";
            $sql = str_replace("{kskdepartment}", "$sum_r", $sql);
        }
        $sql = str_replace("{kskdepartment}", "$sum_r", $sql);

        $result = pg_query($sql);
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title co_dep"><?php echo " ข้อมูลช่วงวันที่ " . thaiDatefull($datepickers) . " ถึงวันที่ " . thaiDatefull($datepickert) ?>
                            <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
                        </h3>
                        <? if ($_SESSION['status'] == 1) { ?>
                            <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> SQL </button>
                        <? } ?>
                        <button type="" class="btn btn-default pull-right" class="btn btn-info btn-lg" onclick="export_excel()"> Excel </button>
                    </div>
                    <div class="box-body table-responsive"><span class="fcol"> </span>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class= "text-nowrap">
                                    <?php
                                        $i = pg_num_fields($result);
                                        for ($j = 0; $j < $i; $j++) {
                                            $fieldname = pg_field_name($result, $j);
                                            echo '<th>' . $fieldname . '</th>';
                                        }
                                        ?>
                                </tr>
                            </thead>
                            <tbody>
                                <? $rw = 0;
                                    while ($row_result = pg_fetch_array($result)) {
                                        $rw++;
                                        ?>
                                    <tr>
                                        <?php
                                                for ($j = 0; $j < $i; $j++) {
                                                    $fieldname = pg_field_name($result, $j);
                                                    echo '<td class= "text-nowrap">' . $row_result[$fieldname] . '</td>';
                                                }
                                                ?>
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

    <script type="text/javascript">
        function export_excel() {  
            document.location = "export_excel_f001.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>&i_dropdown=<?php echo $sum_pttypes; ?>&beginage=<?php echo $beginage; ?>&endage=<?php echo $endage; ?>&d_doctor=<?php echo $sum_dc; ?>&dental_diag=<?php echo $sum_dtm; ?>&room=<?php echo $sum_r; ?>";
        }
    </script>
</body>
</html>