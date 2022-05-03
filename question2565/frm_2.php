<?php
if ((isset($_POST['sex']) == "" || isset($_POST['sex']) == null)) {
    echo "<script>window.location ='index.php';</script>";
}
$sex =  $_POST['sex'];
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
<?php include"head.php";?> 
        <h1 class="detail"> แบบสำรวจแบ่งออกเป็น 3 ตอน ได้แก่</h1>
        <div class="row">
            <div class="col-md-12 detail mask">1. ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</div>
            <div class="col-md-12 detail">2. ระดับความพึงพอใจการเข้าใช้งานระบบสารสนเทศ</div>
            <div class="col-md-12 detail">3. ข้อเสนอแนะ</div>
        </div>
    </div>
    <hr>
    <form action="frm_3.php" method="POST" id="form1">
        <h1 class="list"> ตอนที่ 1 ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม (ช่วงอายุ)</h1>
        <section>
            <input type="hidden" id="sex" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
            <input type="hidden" id="q" name="q" value="<?php echo $q; ?>">
            <div class="cus">
                <input type="radio" id="control_01" name="age" value="1" onClick="document.forms['form1'].submit()">
                <label for="control_01">
                    <h2 class="cus"> ต่ำกว่า 20 ปี</h2>
                </label>
            </div>
            <div>
                <input type="radio" id="control_02" name="age" value="2" onClick="document.forms['form1'].submit()">
                <label for="control_02">
                    <h2 class="cus"> 20 - 30 ปี</h2>
                </label>
            </div>
            <div class="cus">
                <input type="radio" id="control_03" name="age" value="3" onClick="document.forms['form1'].submit()">
                <label for="control_03">
                    <h2 class="cus"> 31 - 40 ปี</h2>
                </label>
            </div>
            <div>
                <input type="radio" id="control_04" name="age" value="4" onClick="document.forms['form1'].submit()">
                <label for="control_04">
                    <h2 class="cus"> 41 - 50 ปี</h2>
                </label>
            </div>
            <div>
                <input type="radio" id="control_05" name="age" value="5" onClick="document.forms['form1'].submit()">
                <label for="control_05">
                    <h2 class="cus"> 50 ปีขึ้นไป</h2>
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