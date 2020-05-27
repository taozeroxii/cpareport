<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include "config/pg_con.class.php";
include "config/my_con.class.php";
include "config/func.class.php";
$cid    = $_SESSION['cid'];
$hn     = $_SESSION['hn'];
$searchuser = " SELECT  id,order_number_check,fname,lname,phone,adddess,cid,hn
moo,district,amphoe,province,zipcode,qcode,keycode,modify,status,flage,fileimg,dateupdate
FROM web_data_patient_pems
WHERE hn = '$hn' ";
$query = mysqli_query($con, $searchuser);
$row_result = mysqli_fetch_array($query);
?>

<?php if (isset($_SESSION['cid']) == "" || isset($_SESSION['hn']) == null) {
    echo "<script>window.location ='./index.php';</script>";
} ?>

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
$checkAp = "SELECT * FROM web_data_appoint  where hn ='$hn' and cid = '$cid' and date_appoint > CURRENT_DATE ORDER BY date_appoint";
$queryCheckAp = mysqli_query($con,$checkAp);
$oppid_check = mysqli_query($con,$checkAp);

$sql = " SELECT  o.nextdate AS dateapp ,C.NAME AS clinic
,o.hn
,p.cid
,o.oapp_id
,concat(P.pname,P.fname,'&nbsp;&nbsp;',P.lname) AS patientname
,d.NAME::TEXT AS doctor 
,CONCAT(pp.pttype,' ',pp.name) as insptty
FROM oapp o
LEFT JOIN vn_stat v ON v.vn = o.vn
LEFT  JOIN patient P ON P.hn = o.hn 
LEFT  JOIN clinic C ON C.clinic = o.clinic
LEFT  JOIN doctor d ON d.code = o.doctor
LEFT  JOIN kskdepartment K ON K.depcode = o.depcode
LEFT JOIN pttype as pp ON pp.pttype = v.pttype  
WHERE   1 = 1
AND p.hn = '$hn' ";
// AND o.oapp_id Not in ('1050932')";
if(sizeof($oppid_check)>0){
        $sql .= " AND o.oapp_id Not in (";
        while ($value = mysqli_fetch_array($oppid_check)) 
                {
                    $sql .="'" .$value['oapp_id']. "',";
                }
                    $sql = rtrim($sql,',');
                    $sql .= ") ";
                }
$sql .= " AND o.nextdate > CURRENT_DATE ";
$sql .= " AND (( o.oapp_status_id < 4 ) OR o.oapp_status_id IS NULL ) "; 
$sql .= " ORDER BY o.nextdate ";
$result = pg_query($conn, $sql);
$countdata = pg_num_rows($result);//เช็คมีนัดไม่มีนัด
echo $sql;
?>

<body>
    <div class="uk-container uk-padding">
        <h1> รายการนัด <sup>
                <h3>เลือกรายการส่งยาทางไปรษณีย์</h3>
            </sup></h1>
        <hr>

        <?php
        //ทดสอบเช็คหากมีการกดไปแล้วให้ไม่แสดง
        $i = 0;
          while ($row_result22 = mysqli_fetch_array($queryCheckAp)) {
            $i++;
            $date_appoint[$i] = $row_result22['date_appoint'];
            $clinic_appoint[$i] = $row_result22['clinic_appoint'];
            $doctor_appoint[$i] = $row_result22['doctor_appoint'];

           // echo '<br>data ['.$i.'] '.$date_appoint[$i].' '.$clinic_appoint[$i].' '.$doctor_appoint[$i];
         }
        ?>
    
        <form id="save" class="" autocomplete="" uk-grid method="POST" action="save.php">
            <?php
            $rw = 0;
            while ($row_result = pg_fetch_array($result)) {
                $rw++;
                $dateapp  =  $row_result['dateapp'];
                $clinic   =  $row_result['clinic'];
                $doctor   =  $row_result['doctor'];
                $hn       =  $row_result['hn'];
                $cid      =  $row_result['cid'];
                $oapp_id  =  $row_result['oapp_id'];

                //echo $dateapp .' '. $date_appoint[$rw];
                if($dateapp!= $date_appoint[$rw] &&  $clinic !=   $clinic_appoint[$rw] && $doctor !=  $doctor_appoint[$rw]   ){echo 'ยังไม่มีกดติก';
            ?>
                <div class="">
                    <div>
                        <input type="radio" id="<?= $rw; ?>" name="dateapp" value="<?php echo $dateapp."|".$clinic."|".$doctor."|".$hn."|".$cid."|".$oapp_id;?>" required>
                        <label for="<?= $rw; ?>">
                            <h2 class="hh2"><?php echo thaiDateFULL($row_result['dateapp']); ?></h2>
                            <p class="p1"><?php echo $row_result['clinic']; ?></p>
                            <p class="p2"><?php echo $row_result['doctor']; ?></p>
                        </label>
                    </div>
                </div>
                <br> 
            <?php  } } ?>
            <?php
            if ($countdata < 1) {
                echo "<center><h1>ไม่พบรายการนัดหมาย/ยืนยันรับยาครบแล้ว !!</h1><hr/></center>";
                $checkbutton = 1;
            }
            ?>

            <div>
                    <center><button type="submit" class="button" id="submit" name="submit" style="vertical-align:middle;font-size:16px"><span> ยืนยันรายการ </span></button> </center>
            </div>
        </form>
    </div>
</body>

</html>

<style>
    .button1 {
        display: inline-block;
        border-radius: 4px;
        background-color: #f4511e;
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 28px;
        padding: 20px;
        width: 200px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
    }

    .button1:hover {
        background-color: #f4511e;
        color: black;

    }
</style>