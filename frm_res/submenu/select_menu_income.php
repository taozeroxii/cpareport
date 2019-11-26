<?php
include "../../config/pg_con.class.php";
include "../../config/func.class.php";
include "../../config/time.class.php";
include "../../config/head.class.php";
include '../../config/my_con.class.php';
$incomes_id = isset($_POST['incomes']) ? $_POST['incomes'] : "";
$Query = "SELECT * FROM frm_res_labgroup where frm_fk_income = '{$incomes_id}' ";
$res = mysqli_query($con, $Query);

$Query2= "SELECT * FROM lab_specimen_items order by specimen_name";
$res2 = pg_query($conn, $Query2);



if ($incomes_id == '10') {
    echo '<div class="col-4 mt-3">
    <span class="nameofinput">กลุ่ม lab</span>
    <select class="form-control" name="spcltys"  require>
      <option value="" selected>โปรดเลือก ..</option>';
    while ($Result = mysqli_fetch_assoc($res)) {
        echo "<option value=\"" . $Result['frm_res_lab_groupname'] . "\">" . $Result['frm_res_lab_groupname'] . "</option>";
    }
    echo '</select></div>';
    echo '<div class="col-lg-1 col-6 col-sm-4 mt-3">
            <span class="nameofinput">หน่วย</span>
            <input class="form-control" type="text" placeholder="" name="labpoint">
         </div>
         <div class="col-lg-1  col-6 col-sm-4 mt-3">
            <span class="nameofinput">ค่าปกติ</span>
            <input class="form-control" type="text" placeholder="" name="normallylabpoint">
         </div>
         <div class="col-lg-1  col-6 col-sm-4 mt-3">
            <span class="nameofinput">Ecode</span>
            <input class="form-control" type="text" placeholder="" name="Ecode">
         </div>
    ';

    echo ' <div class="col-4 mt-3">
    <span class="nameofinput">Specimen</span>
    <select class="form-control" name="specimen" >
      <option value="" selected>โปรดเลือก ..</option>';
    while ($Result2 = pg_fetch_assoc($res2)) {
        echo "<option value=\"" . $Result2['specimen_name'] . "\">" . $Result2['specimen_name'] . "</option>";
    }
    echo '</select></div>';
} else echo '';
