<!DOCTYPE html>
<html>
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
        color: red;
        font-size: 1.2em;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
        <!-- <section class="content-header">
				<h1>
					<?php echo $sql_head; ?>
					<small><?php //echo 'Viewer: '.$countview; 
                            ?></small>
				</h1>
			</section> -->
        <section class="content">

            <div class="row">
                <div class="col-xs-6">
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
                <?php
                $sdate    = $_POST['sdate'];
                list($m, $d, $Y)  = explode('/', $sdate);
                $sdate    = trim($Y) . "-" . trim($m) . "-" . trim($d);
                $edate    = $_POST['edate'];
                list($m, $d, $Y)  = explode('/', $edate);
                $edate    = trim($Y) . "-" . trim($m) . "-" . trim($d);

                if ($sdate != "--") {
                    $sql1 = " SELECT 'จำนวนเบาหวานทั้งหมด' as detail,a.tatal + b.tatal as total
                                FROM
                            (SELECT COUNT(DISTINCT a.hn) as tatal
                            FROM ovst AS a
                            LEFT JOIN ovst as c ON c.vn = a.vn
                            LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                            WHERE 1 = 1
                            AND b.icd10 BETWEEN  'E100' AND 'E149') as a
                            ,(SELECT COUNT(DISTINCT a.hn) as tatal
                            FROM ipt AS a
                            LEFT JOIN iptdiag as b ON b.an = a.an 
                            WHERE 1 = 1
                            AND b.icd10 BETWEEN  'E100' AND 'E149') as b ";
                    $result1 = pg_query($sql1);
                    $row1 = pg_fetch_array($result1);

                    $sql2 = " SELECT 'OPD แยกอำเภอ' as detail,ad.amphur as amp ,COUNT(DISTINCT a.hn) as tatal
                   FROM ovst AS a
                   LEFT JOIN ovst as c ON c.vn = a.vn
                   LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                   LEFT JOIN patient as p on p.hn = a.hn
                   LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                   LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                   WHERE 1 = 1
                   AND b.icd10 BETWEEN  'E100' AND 'E149'
                   AND p.chwpart = '25'
                   AND ad.amphur IS NOT NULL
                   GROUP BY ad.amphur
                   UNION 
                   SELECT 'OPD แยกอำเภอ' as detail,'ที่อยู่อื่น' as amp,COUNT(DISTINCT a.hn) as tatal
                   FROM ovst AS a
                   LEFT JOIN ovst as c ON c.vn = a.vn
                   LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                   LEFT JOIN patient as p on p.hn = a.hn
                   LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                   LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                   WHERE 1 = 1
                   AND b.icd10 BETWEEN  'E100' AND 'E149'
                   AND p.chwpart <> '25'
                   ORDER BY tatal DESC ";
                    $result2 = pg_query($sql2);

                    $sql22 = " SELECT 'IPD แยกอำเภอ' as detail,ad.amphur as amp ,COUNT(DISTINCT a.hn) as tatal
                    FROM ipt AS a
                    LEFT JOIN ovst as c ON c.hn = a.hn
                    LEFT JOIN iptdiag as b ON b.an = a.an 
                    LEFT JOIN patient as p on p.hn = a.hn
                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                    WHERE 1 = 1
                    AND b.icd10 BETWEEN  'E100' AND 'E149'
                    AND p.chwpart = '25'
                    AND ad.amphur IS NOT NULL
                    GROUP BY ad.amphur
                    UNION 
                    SELECT 'IPD แยกอำเภอ' as detail,'ที่อยู่อื่น' as amp,COUNT(DISTINCT a.hn) as tatal
                    FROM ipt AS a
                    LEFT JOIN ovst as c ON c.hn = a.hn
                    LEFT JOIN iptdiag as b ON b.an = a.an  
                    LEFT JOIN patient as p on p.hn = a.hn
                    LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                    LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                    WHERE 1 = 1
                    AND b.icd10 BETWEEN  'E100' AND 'E149'
                    AND p.chwpart <> '25' 
                    ORDER BY tatal DESC";
                     $result22 = pg_query($sql22);
 

                     $sql3 = " SELECT 'ที่ขึ้นทะเบียน' as tatal ,COUNT(*) as total
                     FROM clinicmember 
                     WHERE clinic IN ('001','026','013') ";
                        $result3 = pg_query($sql3);
                        $row3 = pg_fetch_array($result3);

                        $sql6 = " SELECT  ' ผู้ป่วยเบาหวาน Admit ' as detail,COUNT(DISTINCT a.hn) as total
                        FROM ipt AS a
                        LEFT JOIN iptdiag as b ON b.an = a.an 
                        WHERE 1 = 1
                        AND a.dchdate BETWEEN '$sdate' AND '$edate'
                        AND b.icd10 BETWEEN  'E100' AND 'E149' ";
                           $result6 = pg_query($sql6);
                           $row6 = pg_fetch_array($result6);


                           $sql9 = " SELECT  COUNT(DISTINCT a.hn) as total
                           FROM ipt AS a
                           LEFT JOIN iptdiag as b ON b.an = a.an 
                           LEFT JOIN icd101 as icd ON icd.code = b.icd10
                               LEFT JOIN patient as p on p.hn = a.hn
                           WHERE 1 = 1
                           AND a.dchdate BETWEEN '$sdate' AND '$edate'
                           AND b.icd10 IN('E105','E115','E125','E135','E145') ";
                              $result9 = pg_query($sql9);
                              $row9 = pg_fetch_array($result9);



                              $sql12 = " SELECT ' ผู้ป่วยเบาหวาน ภาวะแทรกซ้อนทางตา' as detail,a.tatal + b.tatal as total
                              FROM
                                  (SELECT COUNT(DISTINCT a.hn) as tatal
                                  FROM ovst AS a
                                  LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                                  WHERE 1 = 1
                                  AND a.vstdate BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 IN ('E103','E113','E123','E133','E143')) as a
                                  ,(SELECT COUNT(DISTINCT a.hn) as tatal
                                  FROM ipt AS a
                                  LEFT JOIN iptdiag as b ON b.an = a.an 
                                  WHERE 1 = 1
                                  AND a.dchdate BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 IN ('E103','E113','E123','E133','E143'))as b ";
                              $result12 = pg_query($sql12);
                              $row12 = pg_fetch_array($result12);

                              $sql13 = " SELECT ' ผู้ป่วยเบาหวาน ภาวะแทรกซ้อนทางไต' as detail,a.tatal + b.tatal as total
                              FROM
                                  (SELECT COUNT(DISTINCT a.hn) as tatal
                                  FROM ovst AS a
                                  LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                                  WHERE 1 = 1
                                  AND a.vstdate BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 IN ('E102','E112','E122','E132','E142')) as a
                                  ,(SELECT COUNT(DISTINCT a.hn) as tatal
                                  FROM ipt AS a
                                  LEFT JOIN iptdiag as b ON b.an = a.an 
                                  WHERE 1 = 1
                                  AND a.dchdate BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 IN ('E102','E112','E122','E132','E142'))as b ";
                              $result13 = pg_query($sql13);
                              $row13 = pg_fetch_array($result13);

                              $sql14 = " SELECT ' ผู้ป่วยเบาหวาน ภาวะแทรกซ้อนทางเท้า' as detail,a.tatal + b.tatal as total
                              FROM
                                  (SELECT COUNT(DISTINCT a.hn) as tatal
                                  FROM ovst AS a
                                  LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                                  WHERE 1 = 1
                                  AND a.vstdate BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 IN ('E104','E114','E124','E134','E144')) as a
                                  ,(SELECT COUNT(DISTINCT a.hn) as tatal
                                  FROM ipt AS a
                                  LEFT JOIN iptdiag as b ON b.an = a.an 
                                  WHERE 1 = 1
                                  AND a.dchdate BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 IN ('E104','E114','E124','E134','E144'))as b ";
                              $result14 = pg_query($sql14);
                              $row14 = pg_fetch_array($result14);


                              $sql10 = " SELECT 'ตัดขาที่เท้าไม่ซ้ำราย' as detail,COUNT(DISTINCT a.hn) as total
                              FROM ipt a 
                              INNER JOIN iptoprt  i on i.an = a.an 
                                    AND icd9 like '8412' 
                                    AND i.opdate  BETWEEN '$sdate' AND '$edate'
                              INNER JOIN patient pt on a.hn = pt.hn  
                              INNER JOIN icd9cm1 cd on i.icd9 = cd.code
                              LEFT JOIN iptdiag b on b.an = a.an
                              WHERE 1 =  1
                                AND a.dchdate  BETWEEN '$sdate' AND '$edate'
                                  AND b.icd10 BETWEEN 'E100' AND 'E149' ";
                              $result10 = pg_query($sql10);
                              $row10 = pg_fetch_array($result10);


                              $sql7 = " SELECT  CONCAT(b.icd10,' | ',icd.name) as detail,COUNT(b.icd10) as total
                              FROM ipt AS a
                              LEFT JOIN iptdiag as b ON b.an = a.an 
                              LEFT JOIN icd101 as icd ON icd.code = b.icd10
                              WHERE 1 = 1
                              AND a.dchdate BETWEEN '$sdate' AND '$edate'
                              AND b.icd10 BETWEEN  'E100' AND 'E149'
                              GROUP BY detail
                              ORDER BY total DESC
                              LIMIT 5 ";
                              $result7 = pg_query($sql7);
        

                              $sql8o1 = " SELECT  ' OPD ที่มีแผลที่เท้า แยกอำเภอ' as detail,ad.amphur ,COUNT(DISTINCT a.hn) as total
                              FROM ovst AS a
                              LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                              LEFT JOIN icd101 as icd ON icd.code = b.icd10
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE 1 = 1
                              AND a.vstdate BETWEEN '$sdate' AND '$edate'
                              AND b.icd10 IN('E105','E115','E125','E135','E145')
                              AND p.chwpart = '25'
                              GROUP BY ad.amphur
                              ORDER BY total DESC ";
                              $result8o1 = pg_query($sql8o1);

                              $sql8o2 = " SELECT  ' OPD  อำเภอเมือง แยกตำบล ที่มีแผลที่เท้า' as detail,ad.district ,COUNT(DISTINCT a.hn) as total
                              FROM ovst AS a
                              LEFT JOIN ovstdiag as b ON b.vn = a.vn 
                              LEFT JOIN icd101 as icd ON icd.code = b.icd10
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE 1 = 1
                              AND a.vstdate BETWEEN '$sdate' AND '$edate'
                              AND b.icd10 IN('E105','E115','E125','E135','E145')
                              AND p.chwpart = '25'
                              AND p.amppart = '01'
                              GROUP BY district
                              ORDER BY total DESC ";
                              $result8o2 = pg_query($sql8o2);

                              $sql8i1 = " SELECT  ' IPD ที่มีแผลที่เท้า แยกอำเภอ' as detail,ad.amphur ,COUNT(DISTINCT a.hn) as total
                              FROM ipt AS a
                              LEFT JOIN iptdiag as b ON b.an = a.an 
                              LEFT JOIN icd101 as icd ON icd.code = b.icd10
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE 1 = 1
                              AND a.dchdate BETWEEN '$sdate' AND '$edate'
                              AND b.icd10 IN('E105','E115','E125','E135','E145')
                              AND p.chwpart = '25'
                              GROUP BY ad.amphur
                              ORDER BY total DESC ";
                              $result8i1 = pg_query($sql8i1);

                              $sql8i2 = " SELECT  ' IPD  อำเภอเมือง แยกตำบล ที่มีแผลที่เท้า' as detail,ad.district ,COUNT(DISTINCT a.hn) as total
                              FROM ipt AS a
                              LEFT JOIN iptdiag as b ON b.an = a.an 
                              LEFT JOIN icd101 as icd ON icd.code = b.icd10
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE 1 = 1
                              AND a.dchdate BETWEEN '$sdate' AND '$edate'
                              AND b.icd10 IN('E105','E115','E125','E135','E145')
                              AND p.chwpart = '25'
                              AND p.amppart = '01'
                              GROUP BY district
                              ORDER BY total DESC ";
                              $result8i2 = pg_query($sql8i2);

                              $sql4 = " SELECT 'ขึ้นทะเบียน แยกอำเภอ' as detail,ad.amphur as amphur ,COUNT(DISTINCT a.hn) as total
                              FROM clinicmember as a 
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE a.clinic IN ('001','026','013')
                              AND p.chwpart = '25'
                              GROUP BY ad.amphur
                              UNION
                              SELECT 'ขึ้นทะเบียน แยกอำเภอ' as detail,'ที่อยู่อื่น' as amphur,COUNT(DISTINCT a.hn) as total
                              FROM clinicmember as a 
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE a.clinic IN ('001','026','013')
                              AND p.chwpart <> '25' ";
                              $result4 = pg_query($sql4);

                              $sql5 = " SELECT 'ขึ้นทะเบียน อำเภอเมือง แยกตำบล' as detail,ad.district ,COUNT(DISTINCT a.hn) as tatal
                              FROM clinicmember as a 
                                  LEFT JOIN patient as p on p.hn = a.hn
                                  LEFT JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
                                  LEFT JOIN dbaddress as ad on ad.iddistrict = r.addressid
                              WHERE a.clinic IN ('001','026','013')
                              AND p.chwpart = '25'
                              AND p.amppart = '01'
                              GROUP BY ad.district ";
                              $result5 = pg_query($sql5);

                ?>
                    <div class="col-xs-6">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="#">
                                            <div class="form-control"><?php echo " ข้อมูลช่วงวันที่ " . thaiDatefull($sdate) . " ถึงวันที่ " . thaiDatefull($edate); ?></div>
                                            <small><?php echo " เวลาที่ใช้ในการประมวลผล " . $bm->stop() . " วินาที "; ?></small>
                                        </form>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 1. จำนวนผู้ป่วย DM ทั้งโรงพยาบาล (ราย)"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row1['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>

                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 3. จำนวนผู้ป่วย DM ที่ขึ้นทะเบียนทั้งหมด (ราย)"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row3['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>

                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 6. ผู้ป่วย DM Admit (ราย)"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row6['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>
                
                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 9. ผู้ป่วย DM มีแผลที่เท้าและ Admit (ราย)"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row9['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>

            </div>

            <div class="row">
                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 10. ผู้ป่วย DM ถูกตัดอวัยวะที่เท้า (ราย) "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row10['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>
                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 12. ผู้ป่วย DM มีภาวะแทรกซ้อนทางตา (ราย) "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row12['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>
                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 13. ผู้ป่วย DM มีภาวะแทรกซ้อนทางไต (ราย) "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row13['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>

                <div class="col-xs-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 14. ผู้ป่วย DM มีภาวะแทรกซ้อนทางเท้า (ราย) "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <tr><?php echo number_format($row14['total'], 0); ?></tr>
                        </div>
                    </div>                   
                </div>
                

            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 2. จำนวนผู้ป่วย DM ในโรงพยาบาลทั้งหมดแยกอำเภอ (ราย) [ OPD ]"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row2 = pg_fetch_array($result2)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row2['amp']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row2['tatal'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 4. จำนวนผู้ป่วย DM ที่ขึ้นทะเบียนทั้งหมด แยกอำเภอ"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row4 = pg_fetch_array($result4)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row4['amphur']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row4['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 5. จำนวนผู้ป่วย DM ที่ขึ้นทะเบียนในเขตอำเภอเมือง แยกตำบล"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row5 = pg_fetch_array($result5)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row5['district']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row5['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 2. จำนวนผู้ป่วย DM ในโรงพยาบาลทั้งหมดแยกอำเภอ (ราย) [ IPD ]"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row22 = pg_fetch_array($result22)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row22['amphur']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row22['tatal'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 8. จำนวนผู้ป่วย DM ที่มีแผลที่เท้า แยกอำเภอ OPD "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row8o1 = pg_fetch_array($result8o1)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row8o1['amphur']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row8o1['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 8. จำนวนผู้ป่วย DM ที่มีแผลที่เท้า อำเภอเมือง แยกตำบล OPD"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row8o2 = pg_fetch_array($result8o2)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row8o2['district']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row8o2['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 8. จำนวนผู้ป่วย DM ที่มีแผลที่เท้า แยกอำเภอ IPD "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row8i1 = pg_fetch_array($result8i1)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row8i1['amphur']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row8i1['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 8. จำนวนผู้ป่วย DM ที่มีแผลที่เท้า อำเภอเมือง แยกตำบล IPD"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row8i2 = pg_fetch_array($result8i2)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row8i2['district']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row8i2['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php echo " 7. จำนวนผู้ป่วย DM ที่ Admit สาเหตุแรกที่ Admin 5 อันดับ "; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                                while ($row7 = pg_fetch_array($result7)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php echo $row7['detail']; ?></td>
                                            <td class="text-right"> <?php echo number_format($row7['total'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                        </div>
                        </table>
                    </div>
                </div>
                <!-- <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title co_dep">
                                <div><?php // echo " 2. จำนวนผู้ป่วย DM ในโรงพยาบาลทั้งหมดแยกอำเภอ (ราย) [ IPD ]"; ?></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive fcol">
                            <table id="example1" class="table table-bordered table-striped">
                                <?php
                               // while ($row22 = pg_fetch_array($result22)) {
                                ?>
                                    <table class="table table-hover table-dark">
                                        <tr>
                                            <td class="text-left"> <?php // echo $row22['amp']; ?></td>
                                            <td class="text-right"> <?php // echo number_format($row22['tatal'], 0); ?></td>
                                        </tr>
                                    </table>
                                <?php
                              //  }
                                ?>
                        </div>
                        </table>
                    </div>
                </div> -->
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