<?php
if ((isset($_POST['sex']) == "" || isset($_POST['sex']) == null || isset($_POST['age']) == "" || isset($_POST['age']) == null || isset($_POST['quser']) == "" || isset($_POST['quser']) == null
    || isset($_POST['q1']) == "" || isset($_POST['q1']) == null || isset($_POST['q2']) == "" || isset($_POST['q2']) == null || isset($_POST['q3']) == "" || isset($_POST['q3']) == null || isset($_POST['q4']) == "" || isset($_POST['q4']) == null)) {
    echo "<script>window.location ='index.php';</script>";
}
$age = $_POST['age'];
$sex = $_POST['sex'];
$quser = $_POST['quser'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
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
    <header class="header-navigation" id="header">
        <nav>
            <span>แบบสอบถามความพึงพอใจของผู้ใช้บริการระบบสารสนเทศ โรงพยาบาลเจ้าพระยาอภัยภูเบศร ประจำปีงบประมาณ 2563</span>
        </nav>
    </header>
    <br><br><br>
    <div class="container-fluid">
        <h1 class="detail">คำชี้แจง</h1>
        <div class="row">
            <div class="col-md-12 detail">แบบสอบถามความพึงพอใจสำหรับเจ้าหน้าที่ผู้ใช้บริการระบบสารสนเทศ</div>
            <div class="col-md-12 detail">โรงพยาบาลเจ้าพระยาอภัยภูเบศร ประจำปีงบประมาณ 2563 มีวัตถุประสงค์เพื่อสำรวจความพึงพอใจของผู้รับบริการผ่านระบบสารสนเทศของโรงพยาบาล</div>
            <div class="col-md-12 detail">ซึ่งผลการสำรวจครั้งนี้ จะเป็นข้อมูลในการที่จะปรับปรุงการให้บริการ</div>
        </div>
        <h1 class="detail"> แบบสำรวจแบ่งออกเป็น 3 ตอน ได้แก่</h1>
        <div class="row">
            <div class="col-md-12 detail">1. ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</div>
            <div class="col-md-12 detail ">2. ระดับความพึงพอใจการเข้าใช้งานระบบสารสนเทศ</div>
            <div class="col-md-12 detail mask">3. ข้อเสนอแนะ</div>
        </div>
    </div>
    <hr>
    <form action="frm_comp.php" method="POST" id="form1" >
        <h1 class="list"> ตอนที่ 3 ข้อเสนอแนะ </h1>
        <section>
            <input type="hidden" id="sex" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" id="age" name="age" value="<?php echo $age; ?>">
            <input type="hidden" id="quser" name="quser" value="<?php echo $quser; ?>">
            <input type="hidden" id="q1" name="q1" value="<?php echo $q1; ?>">
            <input type="hidden" id="q2" name="q2" value="<?php echo $q2; ?>">
            <input type="hidden" id="q3" name="q3" value="<?php echo $q3; ?>">
            <input type="hidden" id="q3" name="q4" value="<?php echo $q4; ?>">
            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
            <input type="hidden" id="q" name="q" value="<?php echo $q; ?>">
            <div class="container">
                <h2 class="detail">ข้อเสนอแนะอื่น ๆ</h2>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="other" value="" rows="5" autofocus></textarea>
                <br>
                <button type="submit" id="submit" name="submit" class="btn btn-outline-info btn-block" onClick="document.forms['form1'].submit()">ส่งแบบสอบถาม</button>
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