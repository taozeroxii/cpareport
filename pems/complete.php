<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include"config/my_con.class.php";
include"config/func.class.php";
//$cid    = $_SESSION['cid'];
$hn     = $_SESSION['hn'];

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/css/uikit.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/radio.css">
</head>
<?php
$searchuser = " SELECT  * 
FROM web_data_patient_pems 
WHERE 1 = 1 
AND hn = '".$hn."' ";
$query = mysqli_query($con,$searchuser);
$row_result = mysqli_fetch_array($query);

$fname      = $row_result['fname'];
$lname      = $row_result['lname'];
$adddess    = $row_result['adddess'];
$moo        = $row_result['moo'];
$district   = $row_result['district'];
$amphoe     = $row_result['amphoe'];
$province   = $row_result['province'];
$zipcode    = $row_result['zipcode'];
$hn      = $row_result['hn'];
$phone      = $row_result['phone'];

if ($hn > 0) {
    ?>  
    <body>
        <div class="uk-container uk-padding">
            <h2><img src="img/iconsend.jpg" class="iimg">Patient Address.</h2><span class="fon">ปรับปรุงล่าสุด วันที่ <?php echo thaiDateFULL($row_result['cdate'])." เวลา ".$row_result['ctime']." น.";?></span>
            <hr>
            <h3 class="fon">กรุณาตรวจสอบข้อมูลก่อนพิมพ์ <a href="senddata.php"><span class="aa" title="ตรวจสอบข้อมูล และแก้ไขข้อมูลที่แสดงอยู่ให้ถูกต้อง">[แก้ไขข้อมูล]</span></a></h5> 
                <div class="">
                    <div class="hh2 fon"><span class="fon">คุณ</span><?php echo $row_result['fname']."  ".$row_result['lname']." ( HN : ".$row_result['hn']." )";?></div>
                    <div class="hh2 fon"><span class="fon">เบอร์โทรศัพท์ </span><?php echo $row_result['phone']; ?></div>
                    <hr>

                    <div class="hh2 fon"><?php echo " เลขที่ ".$row_result['adddess']." หมู่ ".$row_result['moo'];?></div>
                    <div class="hh2 fon"><?php echo " ตำบล".$row_result['district']." อำเภอ".$row_result['amphoe'];?>
                    <div class="hh2 fon"><?php echo " จังหวัด".$row_result['province']." ".$row_result['zipcode'];?></div>
                </div>
            </div>
            <br>

            <form name="form1" style="" action="print_pems.php" method="post" target="_blank">
                <input type="hidden" name="fname"     value="<?php echo $fname; ?>"  required />
                <input type="hidden" name="lname"     value="<?php echo $lname; ?>"  required />
                <input type="hidden" name="adddess"   value="<?php echo $adddess; ?>"  required />
                <input type="hidden" name="moo"       value="<?php echo $moo; ?>"  required />
                <input type="hidden" name="district"  value="<?php echo $district; ?>"  required />
                <input type="hidden" name="amphoe"    value="<?php echo $amphoe; ?>"  required />
                <input type="hidden" name="province"  value="<?php echo $province; ?>"  required />
                <input type="hidden" name="zipcode"   value="<?php echo $zipcode; ?>"  required />
                <input type="hidden" name="hn"   value="<?php echo $hn; ?>"  required />
                <input type="hidden" name="phone"   value="<?php echo $phone; ?>"  required />

                    <div class="col-12">
                       <button class="button" id="send" type="submit" name="send" title="พิมพ์รายการที่แสดง" style="vertical-align:middle;font-size:16px;width:100%">พิมพ์ A5-L </button>
                      <!--  <button class="button" type="submit" formaction="print_pems5.php" style="vertical-align:middle;font-size:16px;width:40%">พิมพ์ A5</button> -->
                        </div>
                </form>

                <!-- <div class="uk-width-1-2@m"> -->
                    <a href="index.php"><button class="button btn" id="" name="" title="กลับไปค้นหาข้อมูลใหม่อีกครั้ง" style="vertical-align:middle;font-size:16px;width:100%"><span> ค้นหาข้อมูลใหม่ </span></button></a>
                    <!-- </div> -->
                    <?php
                } 
                else {
                    header("Location: index.php");
                }
                ?>

            </body>
            </html>