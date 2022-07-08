<?php
if ((isset($_POST['sex']) == "" || isset($_POST['sex']) == null || isset($_POST['age']) == "" || isset($_POST['age']) == null || isset($_POST['quser']) == "" || isset($_POST['quser']) == null)) {
    echo "<script>window.location ='index.php';</script>";
}
$age = $_POST['age'];
$sex = $_POST['sex'];
$quser = $_POST['quser'];
$q  =  $_POST['q'];
$token =  $_POST['token'];

date_default_timezone_set("Asia/Bangkok");
$ipaddress = $_SERVER['REMOTE_ADDR'];
$datelog = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/qcss.css">
    <title>Question</title>
</head>

<body>
<?php include"head.php";?> 

        <h1 class="detail"> แบบสำรวจแบ่งออกเป็น 3 ตอน ได้แก่</h1>
        <div class="row">
            <div class="col-md-12 detail">1. ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</div>
            <div class="col-md-12 detail mask">2. ระดับความพึงพอใจการเข้าใช้งานระบบสารสนเทศ</div>
            <div class="col-md-12 detail">3. ข้อเสนอแนะ</div>
        </div>
    </div>
    <hr>
    <div class="row">
            <div class="col-md-3 "> <button type="button" class="btn btn-danger btn-sm btn-block"></button></div>
            <div class="col-md-3  "></div>
            <div class="col-md-3 "></div>
            <div class="col-md-3 "></div>
        </div>

    <form action="frm_5.php" method="POST" id="form1">
        <h1 class="list"> ตอนที่ 2 ระดับความพึงพอใจการเข้าใช้งานระบบสารสนเทศ </h1>
        <section>
            <input type="hidden" id="sex" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" id="age" name="age" value="<?php echo $age; ?>">
            <input type="hidden" id="quser" name="quser" value="<?php echo $quser; ?>">
            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
            <input type="hidden" id="q" name="q" value="<?php echo $q; ?>">
            <div class="container">
                <h2 class="detail color1">1.ความสะดวกรวดเร็วในการเข้าถึงระบบสารสนเทศ</h2>
                <button type="submit" id="q11" name="q1" value="5" class="btn btn-outline-success btn-block" onClick="document.forms['form1'].submit()">มากที่สุด</button>
                <button type="submit" id="q12" name="q1" value="4" class="btn btn-outline-info btn-block" onClick="document.forms['form1'].submit()">มาก</button>
                <button type="submit" id="q13" name="q1" value="3" class="btn btn-outline-warning btn-block" onClick="document.forms['form1'].submit()">ปานกลาง</button>
                <button type="submit" id="q14" name="q1" value="2" class="btn btn-outline-danger btn-block" onClick="document.forms['form1'].submit()">น้อย</button>
                <button type="submit" id="q15" name="q1" value="1" class="btn btn-outline-dark btn-block" onClick="document.forms['form1'].submit()">น้อยที่สุด</button>
            </div>
        </section>
    </form>
</body>

</html>
<script>
    var new_scroll_position = 0;
    var last_scroll_position;
    var header = document.getElementById("header");
    window.addEventListener('scroll', function(e) {
        last_scroll_position = window.scrollY;
        if (new_scroll_position < last_scroll_position && last_scroll_position > 80) {
            header.classList.remove("slideDown");
            header.classList.add("slideUp");
        } else if (new_scroll_position > last_scroll_position) {
            header.classList.remove("slideUp");
            header.classList.add("slideDown");
        }
        new_scroll_position = last_scroll_position;
    });
</script>