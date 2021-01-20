<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form1</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <?php
    include("../config/my_con.class.php");
    include("../config/pg_con.class.php");
    // GET SEL ดึง query มาตาม id 
    $sql_file = $_GET['sql'];
    $sqlgethosxp = "";
    $selectQuery_fromdb = "select cs.*,cmt.menu_type_id,cmt.menu_type_name_th from cpareport_sql  cs LEFT JOIN cpareport_menu_type cmt on cmt.menu_type_id = cs.sql_type where cs.sql_file ='$sql_file'";
    $query_fromGet = mysqli_query($con, $selectQuery_fromdb);
    // ------------------------------------------
    while ($sql_selecthos = mysqli_fetch_assoc($query_fromGet)) {
        $sqlhead      = $sql_selecthos['sql_head'];
        $sqltype      = $sql_selecthos['menu_type_name_th'];
        $sqltypeid    = $sql_selecthos['menu_type_id'];
        $sqlgethosxp  = $sql_selecthos['sql_code']; // ดึง query เพื่อ replace
    }

    // SELECT ค่าลง INPUT 
    if ($sqltypeid  == '1') { //OPD
        $selectpty = "select pttype,name from pttype order by  pttype";
        $qselect2pty = pg_query($conn, $selectpty);

        $selectspclty = "select spclty,name from spclty order by spclty";
        $qselectspclty = pg_query($conn, $selectspclty);
    } else if ($sqltypeid == '2') { //IPD
        $selectpty = "select pttype,name from pttype order by  pttype";
        $qselect2pty = pg_query($conn, $selectpty);

        $selectspclty = "select spclty,name from spclty order by spclty";
        $qselectspclty = pg_query($conn, $selectspclty);

        $selectward = "select ward,name from ward  where name not like '%ยกเลิก%'order by ward";
        $qselectward = pg_query($conn, $selectward);
    } else { // type อื่นๆ
        $selectpty = "select pttype,name from pttype order by  pttype";
        $qselect2pty = pg_query($conn, $selectpty);

        $selectspclty = "select spclty,name from spclty order by spclty";
        $qselectspclty = pg_query($conn, $selectspclty);

        $selectward = "select ward,name from ward  where name not like '%ยกเลิก%'order by ward";
        $qselectward = pg_query($conn, $selectward);
    }
    //

    //เช็คตัวแปร query ว่ามีค่าอะไรที่ต้องแปลงบ้างแล้วนำไปจัดการกับปุ่มเลือกข้อมูล
    $ckdatebegin = "";
    $ckdateend   = "";
    $ckpttype    = "";
    $ckspclty    = "";
    $ckward      = "";
    $messageInput = "";

    $ckdatebegin =  strpos($sqlgethosxp, "{datepickers}");
    if ($ckdatebegin !== false) {
        $messageInput .= ' วันเริ่มต้น ';
    }
    $ckdateend =  strpos($sqlgethosxp, "{datepickert}");
    if ($ckdateend !== false) {
        $messageInput .= ' วันเริ่มสิ้นสุด ';
    }
    $ckpttype =  strpos($sqlgethosxp, "{multiple_pttype}");
    if ($ckpttype !== false) {
        $messageInput .= ' สิทธิ ';
    }
    $ckspclty =  strpos($sqlgethosxp, "{multiple_spclty}");
    if ($ckspclty !== false) {
        $messageInput .= ' แผนก ';
    }
    $ckward =  strpos($sqlgethosxp, "{multiple_ward}");
    if ($ckward !== false) {
        $messageInput .= ' วอร์ด ';
    }

    function checkhavereplace($havereplace){//function เช็คตัวแปรที่เก็บค่าว่ามีคำนั้นๆในข้อความหรือไม่และให้ disabled กับ required ปุ่ม
        if ($havereplace == '' || $havereplace == null) { echo 'disabled'; } else {echo 'required';}
    }
    //เช็คตัวแปร query ว่ามีค่าอะไรที่ต้องแปลงบ้างแล้วนำไปจัดการกับปุ่มเลือกข้อมูล

    function cstring_multipleinput($getdatamultiple){ // function ต่อ string จาก select 2 
        if (sizeof($getdatamultiple) > 0) {
            $sums = "(";
            foreach ($getdatamultiple as $value) {
                $sums .= "'" . $value . "',";
            }
            $sums = rtrim($sums, ',');
            $sums .= ") ";
        }
        return($sums) ;
    }


    //นำ query มาแทนที่จากค่าที่เลือกใน form input----------------------------------------------------------------------------------
    if ($_POST['submit'] != '' || $_POST['submit'] != null) {
        $datepickers    = $_POST['datepickers'];
        $datepickert    = $_POST['datepickert'];
        $multiplepttype = $_POST['pttype'];
        $multipleSpclty = $_POST['spclty'];
        $multipleward   = $_POST['ward'];

        $sqlgethosxp = str_replace("{datepickers}", "'$datepickers'", $sqlgethosxp); // แทนค่า
        $sqlgethosxp = str_replace("{datepickert}", "'$datepickert'", $sqlgethosxp); // แทนค่า

        //multiple pttype
            // if (sizeof($multiplepttype) > 0) {
            //     $sum_pttypes = "(";
            //     foreach ($multiplepttype as $value) {
            //         $sum_pttypes .= "'" . $value . "',";
            //     }
            //     $sum_pttypes = rtrim($sum_pttypes, ',');
            //     $sum_pttypes .= ") ";
            // }
        //เปลี่ยนไปเรียกใช้ function การใช้งานแทนเพื่อลดการเขียนโค๊ดซ้ำไปมา

        $sqlgethosxp = str_replace("{multiple_pttype}", cstring_multipleinput($multiplepttype), $sqlgethosxp);
        $sqlgethosxp = str_replace("{multiple_spclty}", cstring_multipleinput($multipleSpclty), $sqlgethosxp);
        $sqlgethosxp = str_replace("{multiple_ward}"  , cstring_multipleinput($multipleward), $sqlgethosxp);
        $resultqueryhos = pg_query($conn, $sqlgethosxp . 'limit 3');
    }
    ?>


    <?php include "./navbar.php"; ?>
    <div class="container mt-1" style="background-color: white;padding:20px;">
        <div class="row mt-3">
            <div class="col-4"><small> <?php echo '<h2>' . $sqltype . '</h2>' . $sqlhead; ?></small></div>
            <div class="col-4 text-danger"><small> **ต้องมีฟิลล์ pttype,hospmain ใน query หากไม่มีจะ error **</small></div>
            <?php if ($sqlgethosxp != "" && $_POST['submit'] != '') { ?>
                <div class="col-2"><button type="button" class="btn btn-outline-primary  btn-block text-center" data-toggle="modal" data-target="#exampleModal"> sql</button></div>
                <div class="col-2"><button class="btn btn-outline-success  btn-block text-center" onclick="export_excel()">EXPORT Excel</button></div>
            <?php } ?>
            <!-- Modal SHOW SQL DATA-->
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $sqlhead; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" name="" id="" cols="30" rows="25" disabled>  <?php echo  $sqlgethosxp; ?></textarea>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal SHOW SQL DATA-->
        </div>

        <div class="col-12 "><?php echo '<p style="  text-align: right;color:red;">  โปรดเลือก :'.$messageInput.'<br>**หากexportแล้ว acc_code มาไม่ครบให้เปลี่ยนหน่วยในฟิลเป็นตัวเลขทศนิยม 5 ตำแหน่ง**</p>'; ?></div>

        <form class="form mt-5" method="POST" action="#">
            <div class="row">
                <div class="col-lg-4">
                    <label for="datepickers"> วันที่เริ่ม : </label>
                    <input type="date" class="form-control" id="datepickers" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off" required>
                </div>
                <div class="col-lg-4">
                    <label for="datepickert"> วันที่สิ้นสุด : </label>
                    <input type="date" class="form-control" id="datepickert" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off" required>
                </div>
                <div class="col-lg-4 ">
                    <label for="pttype"> โปรเลือกสิทธิ : </label>
                    <select class="js-example-basic-multiple form-control" name="pttype[]" multiple="multiple" <?php checkhavereplace($ckpttype); ?>>
                        <?php while ($datapty = pg_fetch_assoc($qselect2pty)) { ?>
                            <option value="<?php echo $datapty['pttype']; ?>"><?php echo  $datapty['pttype'] . ' : ' . $datapty['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <label for="spclty"> โปรดเลือกแผนก : </label>
                    <select class="js-example-basic-multiple form-control" name="spclty[]" multiple="multiple" <?php checkhavereplace($ckspclty);  ?>>
                        <?php while ($datasp = pg_fetch_assoc($qselectspclty)) { ?>
                            <option value="<?php echo $datasp['spclty']; ?>"><?php echo  $datasp['spclty'] . ' : ' . $datasp['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <?php if ($sqltypeid != '1') { ?>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <label for="spclty"> โปรดเลือกวอร์ด : </label>
                        <select class="js-example-basic-multiple form-control" name="ward[]" multiple="multiple" <?php checkhavereplace($ckward); ?>>
                            <?php while ($datasp = pg_fetch_assoc($qselectward)) { ?>
                                <option value="<?php echo $datasp['ward']; ?>"><?php echo  $datasp['ward'] . ' : ' . $datasp['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <button type="submit" name="submit" value="submit" class="btn btn-info btn-block" vaule='submit'>ยืนยัน</button>
                </div>
            </div>

        </form>




        <!-- ------------------------------ ส่วนของตารางแสดงผลข้อมูล  ---------------------------- ------------------------------>
        <?php if ($sqlgethosxp != "" && $_POST['submit'] != '') { ?>
            <h3 class="text-center mt-5">ข้อมูลตัวอย่าง</h3>
            <table id="example1" class="table-responsive table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <?php
                        $i = pg_num_fields($resultqueryhos);
                        for ($j = 0; $j < $i; $j++) {
                            $fieldname = pg_field_name($resultqueryhos, $j);
                            echo '<th>' . $fieldname . '</th>';
                        }
                        ?>
                        <th>acc_code</th>
                </thead>

                <?php
                while ($property2 = pg_fetch_assoc($resultqueryhos)) {
                    $rw++;
                    $checktd = 0;
                    echo '<tr>';
                    $pttype =  $property2['pttype'];
                    $hospmain =  $property2['hospmain'];
                    for ($j = 0; $j < $i; $j++) {
                        $fieldname = pg_field_name($resultqueryhos, $j);
                        echo '<td >' . $property2[$fieldname] . " " . '</td> ';
                    }
                    //เช็คประเภท OPD IPD เพื่อเอาไปmap กับสิทธิการเงิน
                    if ($sqltypeid != '1') {
                        $sqlgetfrompage = "select pttype,name,hospmain,op_acccode from cpareport_pttype_acc_ipd where pttype = '$pttype' AND ( hospmain = '$hospmain' OR hospmain is null)";
                    } else {
                        $sqlgetfrompage = "select pttype,name,hospmain,op_acccode from cpareport_pttype_acc_opd where pttype = '$pttype' AND ( hospmain = '$hospmain' OR hospmain is null)";
                    }

                    $resultquery = mysqli_query($con, $sqlgetfrompage);
                    while ($property = mysqli_fetch_assoc($resultquery)) {
                        if (($property['pttype'] == $property2['pttype']) && (($property['hospmain'] == $property2['hospmain']) || $property['hospmain'] == null)) {
                            $checktd = 1;
                            echo "<td> " . $property['op_acccode'] .  '</td>';
                        }
                    }
                    if ($checktd == 0) {
                        echo "<td>  </td>";
                    }
                }
                ?>
            </table>

    </div>
<?php } ?>


<script type="text/javascript">
    function export_excel() {
        document.location = "exportexcel.php?sql_file=<?php echo  $sql_file;?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>&multiple_pttype=<?php echo $sum_pttypes;?>&multiple_spclty=<?php echo $sum_spclty;?>&multiple_ward=<?php echo $sum_wards;?>";
    }

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>