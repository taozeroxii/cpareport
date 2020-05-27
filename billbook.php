<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/css/uikit.css">
    <link rel="stylesheet" type="text/css" href="..//pwms/css/style.css">
    <link href="fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> 
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body>
    <div class="uk-container uk-padding">
        <form name="form1" style=" margin-top:15%;" action="#" method="post">
            <div class="uk-width-1-2@m">
                <label class="h2"> เล่มที่ <i class="fas fa-address-card"></i></label>
                <input type="text" name="book_number" value="" placeholder="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required />
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2">เลขที่ (HN) </label>
                <input type="text" name="bill_number" value=""  placeholder="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required />
            </div>
            <button class="button" type="submit" style="vertical-align:middle;font-size:16px;margin-top:20px" name="submit" value="submit"><span> ตรวจสอบ</span></button>
        </form>
    </div>

    <?php
    include 'config/pg_con.class.php';
    if (isset($_POST['submit'])) {
         
            $hn = $_POST['hn'];
            $cid = $_POST['cid'];
        
        $searchuser = " SELECT r.*,
    concat ( P.pname, P.fname, ' ', P.lname ) AS patient_name,
    rc.NAME AS credit_card_type_name,
    y.NAME AS pttype_name,
    fp.finance_pay_type_name,
    o.NAME AS staff_name 
FROM    rcpt_print r
    LEFT OUTER JOIN patient P ON P.hn = r.hn
    LEFT OUTER JOIN opduser o ON o.loginname = r.bill_staff
    LEFT OUTER JOIN pttype y ON y.pttype = r.pttype
    LEFT OUTER JOIN finance_pay_type fp ON fp.finance_pay_type_id = r.finance_pay_type_id
    LEFT OUTER JOIN rcpt_credit_card_type rc ON rc.credit_card_id = r.credit_card_id 
WHERE 1 = 1 
AND (r.book_number = '18056' AND r.bill_number = '35') 
ORDER BY r.bill_date_time ";
        $have_user_yet = pg_query($conn, $searchuser);
        $count = pg_num_rows($have_user_yet);
        echo $have_user_yet['hn'];



        if ($count > 0) {
            session_start();
            $accoutUsser = pg_fetch_assoc($have_user_yet);
            echo $_SESSION['hn']  =  $accoutUsser['hn'];
            echo ' <br>';
           // echo $_SESSION['cid'] = $accoutUsser['cid'];
            //$password = $con->real_escape_string md5((md5($_POST['cid'])));//decode
           // echo "<script>alertify.success('พบข้อมูล');</script>";
         //   header('location:senddata.php');
        } else {
         //   echo "<script>alertify.error('ไม่พบข้อมูลผู้ป่วย');</script>";
        }
    }
    ?>
</body>

</html>

<style>

/*    body {
        background: -webkit-linear-gradient(left, #6a11cb, #2575fc);
        min-height: 96.9vh;
        padding: 15px;
        color: white;
    }

    input {
        box-sizing: border-box;
        width: 100%;
        max-width: 100%;
        height: 40px;
        vertical-align: middle;
        display: inline-block;
        line-height: 38px;
        border-radius: 25px;
        padding: 20px;
    }
    */
</style>