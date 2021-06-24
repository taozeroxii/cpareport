<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .inp1 {
            background-color: #E5E8E8;
            border: 0px solid;
            width: 600px;
            color: #000;
            border-radius: 3px;
        }

        textarea:focus,
        input:focus {
            outline: none;
        }

        .inp2,
        .inp3,
        .inp4,
        .inp5,
        .inp6 {
            background-color: #E5E8E8;
            border: 0px solid;
            color: #000;
            border-radius: 3px;
        }

        .bb {
            background-color: #005FFF;
            color: #fff;
            text-align: center;
        }

        .hh {
            color: #005FFF;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <?php
    require "..//config/pg_con.class.php";
    $todate = date('Ymd_His');
    $depcode    = "502";
    $st         = $_POST['st'];
    $ta         = $_POST['ta'];
    $scdate     =  $_POST['scdate'];
    $cdate      = $_POST['cdate'];
    $forwarder  = $_POST['forwarder'];
    $tel        = $_POST['tel'];





    ?>
    <form id="frm" name="frm" action="activecase.php" method="POST">
        <div class="container-fulid">
            <h3 class="hh"> ! แบบคัดกรอง/นำส่ง การดำเนินงานเฝ้าระวังและค้นหาเชิงรุก โรคติดเชื้อไวรัสโคโรนา 2019 (Covid-19)</h3>
            <p> ในประชากรกลุ่มเสี่ยงหรือสถานที่เสี่ยง (Active Case Finding / Sentinel Surveillance) ชนิดตัวอย่าง <input class="inp1" id="st" name="st" value="<?php echo $st; ?>"></p>
            <p> กลุ่มเป้าหมาย <input class="inp2" type="text" id="ta" name="ta" value="<?php echo $ta; ?>"> 
                วันที่เก็บตัวอย่าง <input class="inp3" type="date" id="scdate" name="scdate" value="<?php echo $scdate; ?>"> 
                ส่งตรวจวันที่ <input class="inp4" type="date" id="cdate" name="cdate" value="<?php echo $cdate; ?>"> 
                ผู้นำส่ง <input class="inp5" type="text" id="forwarder" name="forwarder" value="<?php echo $forwarder; ?>"> 
                โทร <input class="inp6" type="text" id="tel" name="tel" value="<?php echo $tel; ?>"> 
                <button type="submit" id="request" name="request" class="btn btn-labeled btn-success">Request</button>
                <!-- <button type="" class="btn btn-labeled btn-danger">To Excel</button> -->
                <a href="export_to_excel.php?depcode=<?=$depcode;?>&st=<?=$st;?>&ta=<?=$ta;?>&scdate=<?=$scdate;?>&cdate=<?=$cdate;?>&forwarder=<?=$forwarder;?>&tel=<?=$tel;?>" class="btn btn-labeled btn-danger">To Excel</a>
            </p>
    </form>
    <hr>

    <?php
    if (!empty($scdate)) {
    
    $sql = " SELECT row_number() over  (ORDER BY a.vn)  AS rw
    ,'' AS code
    ,b.cid AS idn
    ,b.pname,b.fname,b.lname
    ,b.birthday
    ,extract(year from age(CURRENT_DATE,b.birthday)) AS อายุ
    ,ROUND(s.waist,2) AS  น้ำหนัก
    ,ROUND(s.height,2) AS ส่วนสูง
    ,b.mobile_phone_number AS tel
    ,CONCAT(b.addrpart,' ':: TEXT ) AS เลขที่ 
    ,b.moopart AS หมู่ 
    ,ad.district AS ตำบล
    ,ad.amphur AS อำเภอ
    ,ad.province AS จังหวัด
    ,CASE
        WHEN b.sex = '1' THEN 'ชาย'
        WHEN b.sex = '2' THEN 'หญิง'
        ELSE ''
    END AS เพศ
    ,n.name AS สัญชาติ
    ,o.name AS อาชีพ
    ,CONCAT(p.pttype,' ',p.name) AS สิทธิการักษา 
    ,'' AS ผลการตรวจ
    -- ,CONCAT('[{DEPCODE:',k.depcode,',DATE:',a.vstdate,',STAFF:',a.staff,',PASSPORT:',b.passport_no,',Q:',a.oqueue,',DOCTOR:',a.doctor,'}]',NOW()) AS ckeckdate
    FROM ovst AS a
    INNER JOIN patient AS b on a.hn = b.hn
    LEFT JOIN thaiaddress AS r ON r.tmbpart = b.tmbpart AND r.amppart = b.amppart AND r.chwpart = b.chwpart 
    LEFT JOIN dbaddress AS ad ON ad.iddistrict = r.addressid
    LEFT JOIN nationality AS n ON n.nationality = b.nationality
    LEFT JOIN occupation AS o ON o.occupation = b.occupation
    LEFT JOIN pttype AS p ON p.pttype = a.pttype
    LEFT JOIN opdscreen AS s ON s.vn = a.vn
    INNER JOIN kskdepartment AS k ON k.depcode = a.main_dep
    WHERE 1 = 1
    AND a.vstdate = '$scdate'
    AND a.main_dep = '$depcode'
     ";
    $result = pg_query($sql);

    ?>


    <table class="table">
        <thead>
            <tr>
                <?php
                $i = pg_num_fields($result);
                for ($j = 0; $j < $i; $j++) {
                    $fieldname = pg_field_name($result, $j);
                    echo '<th class="bb">' . $fieldname . '</th>';
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
                        echo '<td>' . $row_result[$fieldname] . '</td>';
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </div>


    <?php
   pg_close($conn);

}
//echo "<br><center>No Data</center>";
    ?>
    
  
</body>

</html>