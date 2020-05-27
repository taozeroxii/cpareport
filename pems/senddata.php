<?php session_start();
date_default_timezone_set('asia/bangkok');
include './config/pg_con.class.php';
include './config/my_con.class.php';
//$cid = $_SESSION['cid'];
$hn  = $_SESSION['hn'];
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/css/uikit.css">
    <link rel="stylesheet" href="jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> <!--load all styles -->

    <?php
    $checkinmysqlbase =  " SELECT * FROM web_data_patient_pems where hn = '" . $hn . "' ORDER BY dateupdate limit 1";
    //$checkinmysqlbase =  " SELECT * FROM web_data_patient_pems where cid = '" . $cid . "' AND hn = '" . $hn . "' ORDER BY dateupdate limit 1";
    $have_user_inmydb = mysqli_query($con, $checkinmysqlbase);
    $count = mysqli_num_rows($have_user_inmydb);

    if ($count == 0) {
        //echo ' <br/>' . 'is null data in mydb then check in pgsql on his hospital' . '<br/>';
        $searchuser = " SELECT p.fname     AS fname
        ,p.lname    AS lname
        ,pty.name   AS pttype
        ,p.addrpart AS adddess
        ,dbs.province AS province
        ,dbs.amphur    AS amphoe
        ,dbs.district  AS district
        ,p.moopart     AS moo
        ,p.mobile_phone_number AS phone
        ,(SELECT pocode FROM thaiaddress WHERE pocode IS NOT NULL AND chwpart = p.chwpart AND amppart =  p.amppart AND tmbpart = '00' AND codetype = '2') as zipcode
         -- ,r.pocode AS zipcode
        ,p.cid      AS cid
        ,p.hn       AS hn
        FROM patient p
        --  INNER JOIN dbaddress dbs    ON dbs.iddistrict   = concat(p.chwpart,p.amppart,p.tmbpart)
        --  INNER JOIN thaiaddress tha  ON tha.addressid    = concat(p.chwpart,p.amppart,p.tmbpart)
            INNER JOIN thaiaddress AS r ON r.tmbpart = p.tmbpart AND r.amppart = p.amppart AND r.chwpart = p.chwpart 
            LEFT JOIN dbaddress as dbs on dbs.iddistrict = r.addressid
            LEFT JOIN pttype pty        ON pty.pttype       = p.pttype
        WHERE p.hn = '" . $_SESSION['hn'] . "' ";

        $have_user_yet = pg_query($conn, $searchuser);
        $result = pg_fetch_assoc($have_user_yet);
    } else {
        //echo '<br/>' . 'is have data in mydb then show data in db' . '<br/>';
        $result = mysqli_fetch_assoc($have_user_inmydb);
    }
    ?>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-33058582-1', 'auto', {
            'name': 'Main'
        });
        ga('Main.send', 'event', 'jquery.Thailand.js', 'GitHub', 'Visit');
    </script>

</head>

<body>
    <?php if (isset($_SESSION['hn']) == null) { echo "<script>window.location ='index.php';</script>";} ?>
    <?php// if (isset($_SESSION['cid']) == "" || isset($_SESSION['hn']) == null) { echo "<script>window.location ='./checkdata.php';</script>";} ?>

    <div class="uk-container uk-padding">
        <h2>ข้อมูลของคุณ <?php echo $result['fname'] . ' ' . $result['lname'] ?></h2>
        <hr>
        <div id="loader">
            <div uk-spinner></div> รอสักครู่ กำลังโหลดฐานข้อมูล...
        </div>
        <form id="senddata" class="demo" style="display:none;" autocomplete="off" uk-grid method="post" action="insert.php">

            <input type="hidden" name="hn" value="<?php echo $result['hn'] ?>">
            <input type="hidden" name="cid" value="<?php echo $result['cid'] ?>">
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-male"></i>  ชื่อ </label>
                <input name="fname" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['fname'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2">นามสกุล</label>
                <input name="lname" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['lname'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-phone-square"></i>  เบอร์โทรศัพท์ </label>
                <input name="phone" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['phone'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-user-md"></i>  สิทธิ์</label>
                <input name="pttype" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['pttype'] ?>">
            </div>
<!--             <div class="uk-width-1-2@m">
                <label class="h2"><i class="fab fa-line"></i>  LINE ID:</label>
                <input name="lineid" class="uk-input uk-width-1-1" type="text">
            </div> -->
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-address-book"></i> บ้านเลขที่</label>
                <input name="adddess" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['adddess'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-address-book"></i> หมู่</label>
                <input name="moo" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['moo'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-address-book"></i> ตำบล / แขวง</label>
                <input name="district" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['district'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-address-book"></i> อำเภอ / เขต</label>
                <input name="amphoe" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['amphoe'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-address-book"></i> จังหวัด</label>
                <input name="province" class="uk-input uk-width-1-1" type="text" value="<?php echo $result['province'] ?>">
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2"><i class="fas fa-address-book"></i>  รหัสไปรษณีย์</label>
                <input name="zipcode" class="uk-input uk-width-1-1" type="text" value="<?php echo trim($result['zipcode'])?>" required>
            </div>
            <div class="uk-width-1-2@m">
                <button class="button" id="send" name="send" style="vertical-align:middle;font-size:16px;width:100%"><span> ยืนยัน/แก้ไขข้อมูล </span></button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>
    <script type="text/javascript" src="jquery.Thailand.js/dependencies/zip.js/zip.js"></script>
    <script type="text/javascript" src="jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <script type="text/javascript" src="jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script type="text/javascript">
        $.Thailand({
            database: 'jquery.Thailand.js/database/db.json',
            $district: $('#senddata [name="district"]'),
            $amphoe: $('#senddata [name="amphoe"]'),
            $province: $('#senddata [name="province"]'),
            $zipcode: $('#senddata [name="zipcode"]'),
            onDataFill: function(data) {
                console.info('Data Filled', data);
            },
            onLoad: function() {
                console.info('Autocomplete is ready!');
                $('#loader, .demo').toggle();
            }
        });
        $('#senddata [name="district"]').change(function() {
            console.log('ตำบล', this.value);
        });
        $('#senddata [name="amphoe"]').change(function() {
            console.log('อำเภอ', this.value);
        });
        $('#senddata [name="province"]').change(function() {
            console.log('จังหวัด', this.value);
        });
        $('#senddata [name="zipcode"]').change(function() {
            console.log('รหัสไปรษณีย์', this.value);
        });
    </script>

</body>

</html>


<style>

body{
    width: 100%;
    min-height: 96vh;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background: #a64bf4;
    background: -webkit-linear-gradient(45deg, #00dbde, #fc00ff);
    background: -o-linear-gradient(45deg, #00dbde, #fc00ff);
    background: -moz-linear-gradient(45deg, #00dbde, #fc00ff);
    background: linear-gradient(45deg, #00dbde, #fc00ff);
}
.uk-container.uk-padding{
    float: center;
    background: white;
    width: 75%;
    border-radius: 25px;
    box-shadow: black 5px 5px;
}

</style>