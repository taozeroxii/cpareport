<?php session_start();
date_default_timezone_set('asia/bangkok');
include "config/pg_con.class.php";
?>
<html>
<head>
    <title></title>
    <style type="text/css">
    #progressbox {
        border: 1px solid #4E616D;
        padding: 1px;
        position: relative;
        width: 400px;
        border-radius: 3px;
        margin: 10px;
        display: block;
        text-align: left;
    }

    #progressbar {
        height: 20px;
        border-radius: 3px;
        background-color: #D84A38;
        width: 1%;
    }

    #statustxt {
        top: 3px;
        left: 50%;
        position: absolute;
        display: inline-block;
        color: #003333;
    }

    input[type=text] {
        width: 30%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: #E0F8E8;
        background-image: url('searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        transition: width 0.4s ease-in-out;
    }
    .submit {
        width: 30%;
        box-sizing: border-box;
        border: 2px solid #bbb;
        border-radius: 4px;
        font-size: 16px;
        background-color: #F03C3C;
        background-image: url('searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        transition: width 0.4s ease-in-out;
        cursor: pointer;
    }
.submitadd
{
        width: 90%;
        box-sizing: border-box;
        border: 2px solid #bbb;
        border-radius: 4px;
        font-size: 16px;
        background-color: #055621;
        background-image: url('searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        transition: width 0.4s ease-in-out;
        cursor: pointer;
        color: #fff;
    }
    .submitadd:hover
{
        width: 90%;
        box-sizing: border-box;
        border: 2px solid #bbb;
        border-radius: 4px;
        font-size: 16px;
        background-color: #02009D;
        background-image: url('searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        transition: width 0.4s ease-in-out;
        cursor: pointer;
        color: #fff;
    }
    </style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript">
    </script>
</head>
<body>
    API Service Patient || HN เพิ่มรายการที่ระบุ 1 รายการตามที่ระบุ ยาไปรษณีย์
    <br>
    <form name="frm" id="frm" action="index.php" method="GET">
        <br>
        <input type="text" name="hn" value="" maxlength="9" placeholder="ลองใส่ HN ดูจ้า"
            onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required />
        <br>
        <br>
        <input type="submit" name="" class="submit" value="ใส่แล้วก็กด ตรงนี้นะจ้า">
        <br>
    </form>


</body>

</html>

<?php

$gethn = $_GET['hn'];

$hn =  str_pad($gethn,9,"0",STR_PAD_LEFT);

if ($hn != "000000000") {

$ssql = " SELECT  DISTINCT p.hn   AS hn
 ,p.pname     AS pname,p.fname     AS fname
,p.lname    AS lname
,pty.name   AS pttype
,p.addrpart AS adddess
,dbs.province AS province
,dbs.amphur    AS amphoe
,dbs.district  AS district
,p.moopart     AS moo
,r.full_name AS full_name
,p.mobile_phone_number AS phone
,p.birthday
,(SELECT pocode FROM thaiaddress WHERE pocode IS NOT NULL AND chwpart = p.chwpart AND amppart =  p.amppart AND tmbpart = '00' AND codetype = '2') as zipcode
,p.cid      AS cid
FROM ovst a
inner join patient p on a.hn = p.hn
INNER JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
LEFT JOIN dbaddress as dbs on dbs.iddistrict = r.addressid
LEFT JOIN pttype pty        ON pty.pttype       = p.pttype
WHERE   1 = 1 
AND p.hn = '$hn' ";

$have_user_yet = pg_query($conn, $ssql);
$result = pg_fetch_array($have_user_yet);

$hn         = $result['hn'];
$pname      = $result['pname'];
$fname      = $result['fname'];
$lname      = $result['lname'];
$pttype     = $result['pttype'];
$adddess    = $result['adddess'];
$province   = $result['province'];
$amphoe     = $result['amphoe'];
$district   = $result['district'];
$moo        = $result['moo'];
$full_name  = $result['full_name'];
$phone      = $result['phone'];
$birthday   = $result['birthday'];
$zipcode    = $result['zipcode'];
$cid        = $result['cid'];
?>

    <div id="mainform">
        <div id="form">
            <div>     
                <input id="hn" name="hn" type="hidden" value="<?php echo $hn;?>">  
                <input id="pname" name="pname" type="hidden" value="<?php echo $pname;?>">  
                <input id="fname" name="fname" type="hidden" value="<?php echo $fname;?>">  
                <input id="lname" name="lname" type="hidden" value="<?php echo $lname ;?>">  
                <input id="pttype" name="pttype" type="hidden" value="<?php echo $pttype;?>">  
                <input id="adddess" name="adddess" type="hidden" value="<?php echo $adddess;?>">  
                <input id="province" name="province" type="hidden" value="<?php echo $province;?>">  
                <input id="amphoe" name="amphoe" type="hidden" value="<?php echo $amphoe;?>">  
                <input id="district" name="district" type="hidden" value="<?php echo $district;?>">  
                <input id="moo" name="moo" type="hidden" value="<?php echo $moo;?>">
                <input id="full_name" name="full_name" type="hidden" value="<?php echo $full_name;?>">  
                <input id="phone" name="phone" type="hidden" value="<?php echo $phone;?>">  
                <input id="birthday" name="birthday" type="hidden" value="<?php echo $birthday;?>">  
                <input id="zipcode" name="zipcode" type="hidden" value="<?php echo $zipcode;?>">  
                <input id="cid" name="cid" type="hidden" value="<?php echo $cid;?>">    
      
                <input id="submitadd" class="submitadd" title="ตรวจสอบข้อมูล แล้วกดส่งข้อมูล" type="button" 
                       value="<?php echo  "ถูกต้องไหมจ้า ถ้าถูก กดส่งเลยจ้า HN:".$hn.' | '.$pname.''.$fname.' '.$lname.' | '.$pttype.' | '.$adddess.' | '.$province.' | '.$amphoe.' | '.$district.' | '.$moo.' | '.$full_name.' | '.$phone.' | '.$birthday.' | '.$zipcode.' | '.$cid." Chick Add";?>">
            </div>
        </div>
    </div>
<?php
}
else {
echo " ";
}
?>