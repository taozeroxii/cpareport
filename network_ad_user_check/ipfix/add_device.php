<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Add Device</title>
</head>
<?php
date_default_timezone_set('asia/bangkok');
$connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($connect, "utf8");
$today =  date('Y-m-d');
$ttime =  date('H:i:s');


$sql = " SELECT MAX(u_id) as uid FROM network_check_ups WHERE 1=1 ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($res);
$nid = $row['uid'];
$uuu = substr($nid, 1) + 1;
$newid = str_pad($uuu, 3, "0", STR_PAD_LEFT);
?>

<body>

    <div class="w3-container">
        <h2 class="w3-text-blue">Add Device UPS<?php echo " :idNew: U" . $newid; ?></h2>
    </div>

    <form class="w3-container w3-card-4" action="#" method="POST">
        <div class="w3-row-padding">
            <input class="w3-input w3-border" name="u_id" type="hidden">
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_product" type="text" placeholder="ups_product ยี่ห้อ ตัวอย่าง : Syndome , APC" required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_model" type="text" placeholder="ups_model รุ่น ตัวอย่าง : Srt10kxli" required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_serial" type="text" placeholder="ups_serial ตัวอย่าง Serial: A9184xxxxxx418" required>
            </div>
        </div>
        <br>

        <div class="w3-row-padding">
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_ip" type="text" placeholder="ups_ip ตัวอย่าง : UPS SERVER ,UPS NETWORK " required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_rate" type="text" placeholder="ups_rate ตัวอย่าง  : 6 kva/4.2 kw" required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_startdate" type="date" placeholder="ups_startdate วันที่เริ่มใช้งาน" required>
            </div>
        </div>
        <br>

        <div class="w3-row-padding">
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_expdate" type="date" placeholder="ups_expdate วันหมดอายุ หรือหมดประกัน MA" required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_ma" type="text" placeholder="ups_ma ตัวอย่าง : MA Battery , NO MA ยังไม่เปลี่ยน" required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_detail" type="text" placeholder="ups_detail ตัวอย่าง :  เปลี่ยนแบต+MA 1 ปี , NO MA ยังไม่เปลี่ยน" required>
            </div>
        </div>
        <br>

        <div class="w3-row-padding">
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_ma_tel" type="text" placeholder="ups_ma_tel เบอร์ติดต่อผู้ดูแลหรือบริษัท : " required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_note" type="text" placeholder="ups_note ตัวอย่าง : Main Server ,Main Network , Other Server" required>
            </div>
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_zone" type="text" placeholder="ups_zone ตัวอย่าง : Server Room " required>
            </div>
        </div>
        <br>

        <div class="w3-row-padding">
            <div class="w3-third">
                <input class="w3-input w3-border" name="ups_location" type="text" placeholder="ups_location ตัวอย่าง : เฉลิมพระเกียรติฯ ชั้น 3" required>
            </div>
            <!-- <div class="w3-third">
                <input class="w3-input w3-border" name="keycode" type="text" placeholder="Keycode" required>
            </div> -->
            <div class="w3-third">
                <button class="w3-btn w3-blue" type="submit" value="">เพิ่มรายการ Add Device UPS </button></p>

            </div>
        </div>
        <br>
    </form>
    <!-- 
    UPS RACK  
  
  1 ห้องบัตรOPD ชั้น1 อาคารเฉลิมพระเกียรติ
  2 ห้องยาบันไดชั้นลอย 
  3 จิตเวช/จักษุ ชั้น2 
  * server ชั้น3 
  4 บัญชี ชั้น5 
  5 หลังลิฟท์ ap wifi ชั้น5 
  6 ชั้น2 สุวัทนา
  7 ห้องพักพยาบาล ชั้น1 ชินวันทนานน(สูติ-นรีเวช)
  8 ห้องพักพยาบาล ชั้น2 
  9 ห้องพักพยาบาล ชั้น3 
  10 ห้องไฟ ชั้น1 เด็ก/พิเศษ
  11 ห้องพักแพทย์ ชั้น2 ศัลยกรรม
  12 ห้องคลอดเก่า ชั้น2 
  13 ห้องพักแพทย์ ชั้น1 ยาใน
  14 ชั้น1 สำราญสำรวจกิจ(75ปี)
  * server ชั้น2 
  15 ชั้น3 
  16 ชั้น4 
  17 ชั้น5 
  18 แผนเทยเก่าชั้น1 ตรวจโควิท
  19 ห้องธนาคารเลือด ชั้น2 X-ray/Lab
  20 บัตรIPD ชั้น1 อาชีวะเวชกรรม
  21 ห้องป้าแคทรียา ชั้น2 
  22 ชั้น2 อาคารเภสัชกรรม
  23 ชั้น2 อาคารคลังเวชภัณฑ์ยา/มิใช่ยา
  * server ชั้น2 อาคารอุบัติเหตุและฉุกเฉิน
  24 ชั้น3 
  25 ชั้น4 
  26 ชั้น5 -->


    <?php
    // $token    =     MD5($_POST['keycode']);
    // if ($token != '7b8025f2e8713caf76bbeb26808a27e3') {
    //     Header("Location: add_device.php?errorkeycode!");  
       
    // }

    $u_id           = "U" . $newid;
    $ups_product    = $_POST['ups_product'];
    $ups_model      = $_POST['ups_model'];
    $ups_serial     = $_POST['ups_serial'];
    $ups_ip         = $_POST['ups_ip'];
    $ups_rate       = $_POST['ups_rate'];
    $ups_status     = "Y";
    $ups_startdate  = $_POST['ups_startdate'];
    $ups_expdate    = $_POST['ups_expdate'];
    $ups_ma         = $_POST['ups_ma'];
    $ups_detail     = $_POST['ups_detail'];
    $ups_ma_tel     = $_POST['ups_ma_tel'];
    $ups_type       = "xxx";
    $ups_note       = $_POST['ups_note'];
    $ups_group      = "xxx";
    $ups_zone       = $_POST['ups_zone'];
    $ups_location   = $_POST['ups_location'];


    $sqlinsert = " INSERT INTO network_check_ups (u_id,ups_product,ups_model,ups_serial,ups_ip,ups_rate,ups_status,ups_startdate,ups_expdate,ups_ma,ups_detail,ups_ma_tel,ups_type,ups_note,ups_group,ups_zone,ups_location) 
    VALUES ('$u_id','$ups_product','$ups_model','$ups_serial','$ups_ip','$ups_rate','$ups_status','$ups_startdate','$ups_expdate','$ups_ma','$ups_detail','$ups_ma_tel','$ups_type','$ups_note','$ups_group','$ups_zone','$ups_location')";
    $querynew = mysqli_query($connect, $sqlinsert);

    if ($querynew) {
        echo "<script language='javascript'>";
        echo "if(!alert('OK Add Device UPS Successful ')){
        window.location.replace('add_device.php');
    }";
        echo "</script>";
    } else {
        // echo "ERROR INSERT DATA";
    }
    mysqli_close($connect);

    ?>

</body>

</html>