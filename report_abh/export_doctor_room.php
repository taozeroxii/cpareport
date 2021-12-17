<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include "conn/pg_con.class.php";
$stdate   = $_GET['stdate'];
$endate   = $_GET['endate'];
$doctor   = $_GET['doctor'];
$room     = $_GET['room'];
/*if (isset($stdate)) {
}else{
header('location: opd_qty_doctor.php');
exit();
}
*/
$todate = date('Ymd_His');

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Export_Doctor_OUT_".$todate.".xls");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .colh {
            color: #0E6655;
            background-color: #D4E6F1;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    /*   $doctor = $_GET['doctor'];
    if (isset($doctor)) {
        */
    $sql_detail = " SELECT
        o.vstdate,
            o.vsttime,
        kk3.department AS main_department_name,
        doc.name as doctor_names,
      --   oq.doctor_list_text as doctor_name,
        o.hn,
        CAST ( concat ( P.pname, P.fname, ' ', P.lname ) AS VARCHAR ( 250 ) ) AS patient_name,
      --  i3.an AS admit_an
    FROM ovst o
        LEFT OUTER JOIN vn_stat v ON v.vn = o.vn
        LEFT JOIN doctor as doc ON doc.code = o.doctor 
        LEFT OUTER JOIN opdscreen oc ON oc.vn = o.vn
        LEFT OUTER JOIN patient P ON P.hn = o.hn
        LEFT OUTER JOIN pttype T ON T.pttype = o.pttype
        LEFT OUTER JOIN icd101 i ON i.code = v.main_pdx
        LEFT OUTER JOIN spclty s ON s.spclty = o.spclty
        LEFT OUTER JOIN ovstist sti ON sti.ovstist = o.ovstist
        LEFT OUTER JOIN ovstost st ON st.ovstost = o.ovstost
        LEFT OUTER JOIN ovst_seq oq ON oq.vn = o.vn
        LEFT OUTER JOIN opduser ou1 ON ou1.loginname = oq.pttype_check_staff
        LEFT OUTER JOIN ovst_nhso_send oo1 ON oo1.vn = o.vn
        LEFT OUTER JOIN kskdepartment K ON K.depcode = o.cur_dep
        LEFT OUTER JOIN kskdepartment k2 ON k2.depcode = oq.register_depcode
        LEFT OUTER JOIN kskdepartment kk3 ON kk3.depcode = o.main_dep
        LEFT OUTER JOIN hospital_department hd ON hd.ID = oq.hospital_department_id
        LEFT OUTER JOIN sub_spclty ssp ON ssp.sub_spclty_id = oq.sub_spclty_id
        LEFT OUTER JOIN pt_walk pw ON pw.walk_id = oc.walk_id
        LEFT OUTER JOIN patient_opd_file pf ON pf.hn = o.hn
        LEFT OUTER JOIN kskdepartment k3 ON k3.depcode = pf.last_depcode
        LEFT OUTER JOIN visit_type vt ON vt.visit_type = o.visit_type
        LEFT OUTER JOIN ipt i3 ON i3.vn = o.vn
        LEFT OUTER JOIN opduser ou ON ou.loginname = o.staff
        LEFT OUTER JOIN pt_priority p3 ON p3.ID = o.pt_priority
        LEFT OUTER JOIN pt_subtype ps1 ON ps1.pt_subtype = o.pt_subtype
        LEFT OUTER JOIN pttype_check_status pcs ON pcs.pttype_check_status_id = oq.pttype_check_status_id 
    WHERE o.vstdate BETWEEN '$stdate' AND '$endate' 
        AND ( o.anonymous_visit IS NULL OR o.anonymous_visit = 'N' ) 
        AND kk3.depcode = '$room'
      --   AND o.doctor = '$doctor'
         AND oq.doctor_list_text LIKE '%%$doctor%%'
    ORDER BY o.vstdate,o.vsttime DESC ";
    $result = pg_query($sql_detail);
    ?>

<style>
    .trrt{
        font-size: 0.7em;

    }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="table">
                    <table id="" class="table trrt" border="1px">
                        <thead>
                            <tr>
                                <?php
                                $i = pg_num_fields($result);
                                for ($j = 0; $j < $i; $j++) {
                                    $fieldname = pg_field_name($result, $j);
                                    echo '<th class="colh">' . $fieldname . '</th>';
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
                                        echo '<td>' . " " . $row_result[$fieldname] . '</td>';
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php // }
                ?>
            </div>
</body>

</html>