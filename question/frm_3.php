<?php
if ((isset($_POST['sex']) == "" || isset($_POST['sex']) == null || isset($_POST['age']) == "" || isset($_POST['age']) == null)) {
    echo "<script>window.location ='index.php';</script>";
}
$age = $_POST['age'];
$sex = $_POST['sex'];
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
            <div class="col-md-12 detail mask">1. ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</div>
            <div class="col-md-12 detail">2. ระดับความพึงพอใจการเข้าใช้งานระบบสารสนเทศ</div>
            <div class="col-md-12 detail">3. ข้อเสนอแนะ</div>
        </div>
    </div>
    <hr>
    <form action="frm_4.php" method="POST" id="form1">
        <h1 class="list"> ตอนที่ 1 ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม (กลุ่มผู้ใช้บริการ)</h1>
        <section>
            <input type="hidden" id="sex" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" id="age" name="age" value="<?php echo $age; ?>">
            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
            <input type="hidden" id="q" name="q" value="<?php echo $q; ?>">
            <div class="cus">
                <input type="radio" id="control_01" name="quser" value="1" onClick="document.forms['form1'].submit()">
                <label for="control_01">
                    <h2 class="cus"> แพทย์</h2>
                </label>
            </div>
            <div>
                <input type="radio" id="control_02" name="quser" value="2" onClick="document.forms['form1'].submit()">
                <label for="control_02">
                    <h2 class="cus"> ทันตแพทย์</h2>
                </label>
            </div>
            <div class="cus">
                <input type="radio" id="control_03" name="quser" value="3" onClick="document.forms['form1'].submit()">
                <label for="control_03">
                    <h2 class="cus"> เภสัชกร</h2>
                </label>
            </div>
            <div>
                <input type="radio" id="control_04" name="quser" value="4" onClick="document.forms['form1'].submit()">
                <label for="control_04">
                    <h2 class="cus"> พยาบาล</h2>
                </label>
            </div>
            <div>
                <input type="radio" id="control_05" name="quser" value="5" onClick="document.forms['form1'].submit()">
                <label for="control_05">
                    <h2 class="cus">เจ้าหน้าที่อื่น ๆ</h2>
                </label>
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