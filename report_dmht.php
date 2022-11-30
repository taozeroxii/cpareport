<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/head.class.php";
include "config/my_con.class.php";
session_start();
$bm = new Timer;
$bm->start();
for ($i = 0; $i < 100000; $i++) {
    $i;
}
//include "config/timestampviewer.php";
?>
<style type="text/css">
    .diagshowinput {
        color: red;
        font-weight: bold;
    }

    .fcol {
        color: green;
        font-size: 1.2em;
    }

    .boxch {
        background: #045A8E !important;
        text-shadow: 4px 2px 4px #000;
        color: #fff;
        border-radius: 10px;
    }

    .foo {
        background: #060E62 !important;
        text-shadow: 4px 2px 4px #000;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        border-radius: 6px;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
        <section class="content ">
            <div class="container-fulid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="#">
                                            <input type="text" class="form-control" id="sdate" name="sdate" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่เริ่มต้น" title="คลิก">
                                            <input type="text" class="form-control" id="" name="edate" data-provide="datepicker" data-date-language="th" autocomplete="off" placeholder="วันที่สิ้นสุด" title="คลิก">
                                            <button type="submit" class="btn btn-default">ตกลง</button>
                                        </form>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $sdate    = $_POST['sdate'];
                list($m, $d, $Y)  = explode('/', $sdate);
                $sdate    = trim($Y) . "-" . trim($m) . "-" . trim($d);
                $edate    = $_POST['edate'];
                list($m, $d, $Y)  = explode('/', $edate);
                $edate    = trim($Y) . "-" . trim($m) . "-" . trim($d);

                if ($sdate != "--") {
                    // DD
                    $sql1 = " SELECT 'OPD แยกอำเภอ' as detail,ad.amphur as amam ,COUNT(DISTINCT a.hn) as total
                                    FROM ovst AS a
                                    LEFT JOIN ovst as c ON c.vn = a.vn
                                    LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                                    LEFT JOIN patient as p on p.hn = a.hn
                                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                                    WHERE 1 = 1
                                    AND b.icd10 BETWEEN  'E100' AND 'E149'
                                    AND a.vstdate BETWEEN '$sdate' AND '$edate'
                                    AND p.chwpart = '25'
                                    AND ad.amphur IS NOT NULL
                                    GROUP BY ad.amphur
                                    UNION 
                                    SELECT 'OPD แยกอำเภอ' as detail,'ที่อยู่อื่น' as amam ,COUNT(DISTINCT a.hn) as total
                                    FROM ovst AS a
                                    LEFT JOIN ovst as c ON c.vn = a.vn
                                    LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                                    LEFT JOIN patient as p on p.hn = a.hn
                                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                                    WHERE 1 = 1
                                    AND b.icd10 BETWEEN  'E100' AND 'E149'
                                        AND a.vstdate BETWEEN '$sdate' AND '$edate'
                                    AND p.chwpart <> '25'
                                    ORDER BY total DESC; ";
                    $result1 = pg_query($sql1);
                    //GG

                    $sqlgg = " SELECT ad.district as dis ,COUNT(DISTINCT a.hn) as total
                    FROM ovst AS a
                    LEFT JOIN ovst as c ON c.vn = a.vn
                    LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                    LEFT JOIN patient as p on p.hn = a.hn
                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                  LEFT JOIN lab_head  	as bb ON bb.vn = a.vn 
                  LEFT JOIN lab_order 	as cc ON cc.lab_order_number = bb.lab_order_number
                  LEFT JOIN lab_items	  as d ON d.lab_items_code = cc.lab_items_code
                    WHERE 1 = 1
                    AND b.icd10 BETWEEN 'E100' AND 'E149'
                    AND a.vstdate BETWEEN '$sdate' AND '$edate'
                    AND p.chwpart = '25'
                    AND p.amppart = '01'
                    AND d.lab_items_name = 'HbA1C' 
                    AND cc.lab_order_result >= '7.0'
                    AND ad.amphur IS NOT NULL
                    GROUP BY ad.district; ";
                    $resultgg = pg_query($sqlgg);

                    // gg2
                    $sqlgg2 = " SELECT ad.district as dis ,COUNT(DISTINCT a.hn) as total
	FROM ovst AS a
	LEFT JOIN ovst as c ON c.vn = a.vn
	LEFT JOIN ovstdiag as b ON b.vn = a.vn 
	LEFT JOIN patient as p on p.hn = a.hn
	LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
	LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
  LEFT JOIN lab_head  	as bb ON bb.vn = a.vn 
  LEFT JOIN lab_order 	as cc ON cc.lab_order_number = bb.lab_order_number
  LEFT JOIN lab_items	  as d ON d.lab_items_code = cc.lab_items_code
	WHERE 1 = 1
	AND b.icd10 BETWEEN 'E100' AND 'E149'
	AND a.vstdate BETWEEN '$sdate' AND '$edate'
	AND p.chwpart = '25'
	AND p.amppart = '01'
	AND d.lab_items_name = 'HbA1C' 
	AND cc.lab_order_result < '7.0'
	AND ad.amphur IS NOT NULL
	GROUP BY ad.district; ";
                    $resultgg2 = pg_query($sqlgg2);
                    // CC 
                    $sqlcc = " SELECT ad.district as tam ,COUNT(DISTINCT a.hn) as total
                    FROM ovst AS a
                    LEFT JOIN ovst as c ON c.vn = a.vn
                    LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                    LEFT JOIN patient as p on p.hn = a.hn
                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                    WHERE 1 = 1
                    AND b.icd10 BETWEEN 'E100' AND 'E149'
                    AND a.vstdate BETWEEN '$sdate' AND '$edate'
                    AND p.chwpart = '25'
                    AND p.amppart = '01'
                    AND ad.amphur IS NOT NULL
                    GROUP BY ad.district; ";
                    $resultcc = pg_query($sqlcc);

                    // JJ 
                    $sqljj = " SELECT ad.district as district ,COUNT(DISTINCT a.hn) as total
                    FROM ovst AS a
                    LEFT JOIN ovst as c ON c.vn = a.vn
                    LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                    LEFT JOIN patient as p on p.hn = a.hn
                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                  LEFT JOIN lab_head  	as bb ON bb.vn = a.vn 
                  LEFT JOIN lab_order 	as cc ON cc.lab_order_number = bb.lab_order_number
                  LEFT JOIN lab_items	  as d ON d.lab_items_code = cc.lab_items_code
                    WHERE 1 = 1
                    AND b.icd10 BETWEEN 'E100' AND 'E149'
                    AND a.vstdate BETWEEN '$sdate' AND '$edate'
                    AND p.chwpart = '25'
                    AND p.amppart = '01'
                    AND d.lab_items_name = 'HbA1C' 
                    AND cc.lab_order_result >= '7.0'
                    AND ad.amphur IS NOT NULL
                    GROUP BY ad.district; ";
                    $resultjj = pg_query($sqljj);

                    // FF 
                    $sqlff = " SELECT ad.amphur as amphur ,COUNT(a.hn) as total
  FROM ovst AS a
  LEFT JOIN ovst as c ON c.vn = a.vn
  LEFT JOIN ovstdiag as b ON b.vn = a.vn 
  LEFT JOIN patient as p on p.hn = a.hn
  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
  WHERE 1 = 1
  AND b.icd10 IN ('E105','E115','E125','E135','E145')
  AND a.vstdate BETWEEN '$sdate' AND '$edate'
  AND p.chwpart = '25'
  AND ad.amphur IS NOT NULL
  GROUP BY ad.amphur; ";
                    $resultff = pg_query($sqlff);

                    // AA 
                    $sqlaa = " SELECT ad.district as district ,COUNT(a.hn) as total
  FROM ovst AS a
  LEFT JOIN ovst as c ON c.vn = a.vn
  LEFT JOIN ovstdiag as b ON b.vn = a.vn 
  LEFT JOIN patient as p on p.hn = a.hn
  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
  WHERE 1 = 1
  AND b.icd10 IN ('E105','E115','E125','E135','E145')
  AND a.vstdate BETWEEN '$sdate' AND '$edate'
  AND p.chwpart = '25'
  AND p.amppart = '01'
  AND ad.amphur IS NOT NULL
  GROUP BY ad.district; ";
                    $resultaa = pg_query($sqlaa);

                    // BB 
                    $sqlbb = " SELECT ad.district as district ,COUNT(a.hn) as total
	FROM ovst AS a
	LEFT JOIN ovst as c ON c.vn = a.vn
	LEFT JOIN ovstdiag as b ON b.vn = a.vn 
	LEFT JOIN patient as p on p.hn = a.hn
	LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
	LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
	WHERE 1 = 1
	AND b.icd10 IN ('E105','E115','E125','E135','E145')
	AND a.vstdate BETWEEN '$sdate' AND '$edate'
		AND a.vn IN ( SELECT vn FROM ipt )
	AND p.chwpart = '25'
	AND p.amppart = '01'
	AND ad.amphur IS NOT NULL
	GROUP BY ad.district; ";
                    $resultbb = pg_query($sqlbb);

                    // EE 
                    $sqlee = " SELECT ad.amphur as amp ,COUNT(DISTINCT a.hn) as total
       FROM ovst AS a
       LEFT JOIN ovst as c ON c.vn = a.vn
       LEFT JOIN ovstdiag as b ON b.vn = a.vn 
       LEFT JOIN patient as p on p.hn = a.hn
       LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
       LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
       WHERE 1 = 1
       AND b.icd10 =  'I10' 
       AND a.vstdate BETWEEN '$sdate' AND '$edate'
       AND p.chwpart = '25'
       AND ad.amphur IS NOT NULL
       GROUP BY ad.amphur
       UNION 
       SELECT 'ที่อยู่อื่น' as amp,COUNT(DISTINCT a.hn) as total
       FROM ovst AS a
       LEFT JOIN ovst as c ON c.vn = a.vn
       LEFT JOIN ovstdiag as b ON b.vn = a.vn 
       LEFT JOIN patient as p on p.hn = a.hn
       LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
       LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
       WHERE 1 = 1
       AND b.icd10 = 'I10'
           AND a.vstdate BETWEEN '$sdate' AND '$edate'
       AND p.chwpart <> '25'; ";
                    $resultee = pg_query($sqlee);


                    // KK 
                    $sqlkk = " SELECT  ad.district,COUNT(DISTINCT a.hn) as total
                    FROM ovst AS a
                    INNER JOIN patient AS p ON p.hn = a.hn
                        LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                        LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                    LEFT JOIN sex AS s ON s.code = p.sex
                    LEFT JOIN pttype AS ppt ON ppt.pttype = a.pttype
                    LEFT JOIN spclty as sst ON sst.spclty = a.spclty
                    LEFT JOIN kskdepartment as kkk ON kkk.depcode = a.main_dep
                    LEFT JOIN pt_priority p3 ON p3.ID = a.pt_priority
                    WHERE 1 = 1
                    AND a.vstdate  BETWEEN '$sdate' AND '$edate'
                    AND a.vn in 
                    (
                    
                    select vn from ovstdiag where icd10 = 'E113'
                    INTERSECT
                    select vn from ovstdiag where icd10 = 'H3602'
                    )
                    
                        AND p.chwpart = '25'
                      AND p.amppart = '01'
                        AND ad.amphur IS NOT NULL
                     GROUP BY ad.district; ";
                    $resultkk = pg_query($sqlkk);


                    // LL 
                    $sqlll = "SELECT  ad.district,COUNT(DISTINCT a.hn) as total
                     FROM ovst AS a
                     INNER JOIN patient AS p ON p.hn = a.hn
                         LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                         LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                     LEFT JOIN sex AS s ON s.code = p.sex
                     LEFT JOIN pttype AS ppt ON ppt.pttype = a.pttype
                     LEFT JOIN spclty as sst ON sst.spclty = a.spclty
                     LEFT JOIN kskdepartment as kkk ON kkk.depcode = a.main_dep
                     LEFT JOIN pt_priority p3 ON p3.ID = a.pt_priority
                     WHERE 1 = 1
                     AND a.vstdate BETWEEN '$sdate' AND '$edate'
                     AND a.vn in 
                     (
                     
                     select vn from ovstdiag where icd10 = 'E113'
                     INTERSECT
                     select vn from ovstdiag where icd10 IN ('N183')
                    --  select vn from ovstdiag where icd10 IN ('N181','N182','N183')
                     )
                         AND p.chwpart = '25'
                       AND p.amppart = '01'
                         AND ad.amphur IS NOT NULL
                      GROUP BY ad.district ";
                    $resultll = pg_query($sqlll);

                    // MM 
                    $sqlmm = " SELECT  ad.district,COUNT(DISTINCT a.hn) as total
FROM ovst AS a
INNER JOIN patient AS p ON p.hn = a.hn
	LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
	LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
LEFT JOIN sex AS s ON s.code = p.sex
LEFT JOIN pttype AS ppt ON ppt.pttype = a.pttype
LEFT JOIN spclty as sst ON sst.spclty = a.spclty
LEFT JOIN kskdepartment as kkk ON kkk.depcode = a.main_dep
LEFT JOIN pt_priority p3 ON p3.ID = a.pt_priority
WHERE 1 = 1
AND a.vstdate BETWEEN '$sdate' AND '$edate'
AND a.vn in 
(

select vn from ovstdiag where icd10 = 'E113'
INTERSECT
select vn from ovstdiag where icd10 IN ('N184')
)
	AND p.chwpart = '25'
  AND p.amppart = '01'
	AND ad.amphur IS NOT NULL
 GROUP BY ad.district ";
                    $resultmm = pg_query($sqlmm);

                    // NN 
                    $sqlnn = "  SELECT  ad.district,COUNT(DISTINCT a.hn) as total
FROM ovst AS a
INNER JOIN patient AS p ON p.hn = a.hn
	LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
	LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
LEFT JOIN sex AS s ON s.code = p.sex
LEFT JOIN pttype AS ppt ON ppt.pttype = a.pttype
LEFT JOIN spclty as sst ON sst.spclty = a.spclty
LEFT JOIN kskdepartment as kkk ON kkk.depcode = a.main_dep
LEFT JOIN pt_priority p3 ON p3.ID = a.pt_priority
WHERE 1 = 1
AND a.vstdate BETWEEN '$sdate' AND '$edate'
AND a.vn in 
(

select vn from ovstdiag where icd10 = 'E113'
INTERSECT
select vn from ovstdiag where icd10 IN ('N185')
)
	AND p.chwpart = '25'
  AND p.amppart = '01'
	AND ad.amphur IS NOT NULL
 GROUP BY ad.district ";
                    $resultnn = pg_query($sqlnn);
                ?>
                    <div class="container">

                        <div class="row">

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[DD] ผู้ป่วยเบาหวานที่มารับบริการ รพ.เจ้าพระยาอภัยภูเบศร "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($row1 = pg_fetch_array($result1)) {
                                        $total += $row1['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $row1['amam']; ?></td>
                                            <td class="text-right "> <?php echo number_format($row1['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[GG] การควบคุมเบาหวาน Control DM"; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowgg = pg_fetch_array($resultgg)) {
                                        $total += $rowgg['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowgg['dis'];
                                                                    ?></td>
                                            <td class="text-right "> <?php echo number_format($rowgg['total'], 0);
                                                                        ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[GG2] การควบคุมเบาหวาน UnControl DM "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowgg2 = pg_fetch_array($resultgg2)) {
                                        $total += $rowgg2['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowgg2['dis'];
                                                                    ?></td>
                                            <td class="text-right "> <?php echo number_format($rowgg2['total'], 0);
                                                                        ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[CC] DM Uncontrol ในเขตอำเภอเมือง (ผู้เป็นเบาหวาน)"; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowcc = pg_fetch_array($resultcc)) {
                                        $total += $rowcc['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowcc['tam']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowcc['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[JJ] DM Uncontrol ในเขตอำเภอเมือง (Uncontrol DM) HbA1c >= 7%"; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowjj = pg_fetch_array($resultjj)) {
                                        $total += $rowjj['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowjj['district']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowjj['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[FF] DM fool Ulcer รักษา โรงพยาบาลเจ้าพระยาอภัยภูเบศร "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowff = pg_fetch_array($resultff)) {
                                        $total += $rowff['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowff['amphur']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowff['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[AA] DM Fool Ulcer เขตอำเภอเมือง "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowaa = pg_fetch_array($resultaa)) {
                                        $total += $rowaa['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowaa['district']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowaa['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[BB] DM Fool Ulcer นอน โรงพยาบาล "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowbb = pg_fetch_array($resultbb)) {
                                        $total += $rowbb['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowbb['district']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowbb['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[EE] ผู้ป่วยความดันโลหิตสูงที่มารับบริการ โรงพยาบาลเจ้าพระยาอภัยภูเบศร "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowee = pg_fetch_array($resultee)) {
                                        $total += $rowee['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowee['amp']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowee['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[KK] Diabetic Retinopathy  อำเภอเมือง "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowkk = pg_fetch_array($resultkk)) {
                                        $total += $rowkk['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowkk['district']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowkk['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="boxch"><?php echo "[KK] Diabetic Retinopathy CKD stage 3  อำเภอเมือง "; ?></div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <?php
                                    $total = 0;
                                    while ($rowll = pg_fetch_array($resultll)) {
                                        $total += $rowll['total'];
                                    ?>
                                        <tr class="text-left">
                                            <td class="text-left "> <?php echo $rowll['district']; ?></td>
                                            <td class="text-right "> <?php echo number_format($rowll['total'], 0); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center foo text-danger"> รวม </td>
                                        <td class="text-center foo text-danger"> <?php echo number_format($total, 0); ?></td>
                                    </tr>

                                </table>
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
</body>

</html>