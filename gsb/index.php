<?php
session_start();
date_default_timezone_set('asia/bangkok');
?>
<!DOCTYPE html>
<script type="text/javascript" >
  function date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
    d = date.getDate();
    day = date.getDay();
    days = new Array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสดี', 'ศุกร์', 'เสาร์');
    h = date.getHours();
    if (h < 10) {
      h = "0" + h;
    }
    m = date.getMinutes();
    if (m < 10) {
      m = "0" + m;
    }
    s = date.getSeconds();
    if (s < 10) {
      s = "0" + s;
    }
    result = 'วัน' + days[day] + ' ที่ ' + d + ' เดือน ' + months[month] + ' พ.ศ. ' + (year+543) + '  เวลา ' + h + ':' + m + ':' + s +' น.';
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("' + id + '");', '1000');
    return true;
  }
</script>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> | Seach Patient |</title>
  <!-- <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet"> -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <link href="css/bootstrap-theme.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="eak.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
  <meta property="og:title" content="Social Buttons for Bootstrap" />
    <meta property="og:description" content="A beautiful replacement for JavaScript's 'alert' for Bootstrap" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://lipis.github.io/bootstrap-sweetalert/" />
    <meta property="og:image" content="http://lipis.github.io/bootstrap-social/assets/bootstrap-sweetalert.png" />

    <title> LOAD EXCEL FILE  </title>

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <script src="//code.jquery.com/jquery-2.1.1.js"></script>
    <!-- <link href="assets/docs.css" rel="stylesheet"> -->

    <!-- This is what you need -->
    <script src="dist/sweetalert.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">
    <!--.......................-->

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-42119746-3', 'auto');
      ga('send', 'pageview');
    </script>

</head>
<body>

  <?php if ( (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) &&( $_SESSION['status'] !='4'  ||  $_SESSION['status'] !='1'   ) ) {
        echo "<script>window.location ='../login.php';</script>"; } ?>

   <br>     
  <div class="hmain">Patient GSB Member<sup> โรงพยาบาลเจ้าพระยาอภัยภูเบศร & ธนาคารออมสิน</sup> &nbsp;
    <a href="#" title="นำไฟล์ excel เข้าระบบ"><button type="button" class="btn btn-danger" onclick="fup()" > Upload Excel </button></a> &nbsp;
    <a href="#" title="นำเข้า excel ไฟล์"><button type="button" class="btn btn-primary" onclick="fim()"> Import Excel </button></a> &nbsp;
    <!-- <a href="uploadfile/index.php" title="นำไฟล์ excel เข้าระบบ"><button type="button" class="btn btn-danger" > Upload Excel </button></a> &nbsp;
    <a href="excel_import.php" title="นำเข้า excel ไฟล์"><button type="button" class="btn btn-primary" > Import Excel </button></a> &nbsp; -->
    <a href="../logout.php" title="กรุณาออกจากระบบทุกครั้งหลังการใช้งาน"><button type="button" class="btn btn-warning"> ออกจากระบบ</button></a> 
  </div>
  <hr>
  <div class="container ">
    <div class="row">
      <div class="col-md-12">
        <form class="form-inline" name="searchform" id="searchform">
          <div class="form-group wi">
            <label for="textsearch" ><!-- ttttt --></label>
            <input type="text" name="itemname" id="itemname" class="form-control" placeholder=" ค้นหา เลขบัตรประชชาชน หรือ ชื่อ หรือ นามสกุล || อย่างใดอย่างหนึ่ง " autocomplete="off"  autofocus/>
          </div>
          <button type="button" class="btn btn-info" id="btnSearch" title="">
            <span class="glyphicon glyphicon-search" ></span>
            ค้นหาข้อมูลผู้มีสิทธิ์
          </button>
          &nbsp;
          <button type="button" class="btn btn-light dtim" id="">
            <span id="date_time" class="dtim">
            </span> 
            <script type="text/javascript"> window.onload = date_time('date_time');</script> 
          </button>


        </form>
      </div>
    </div>

    <center><div class="loading">&nbsp;</div></center>

    <div class="row" id="list-data" style="margin-top: 10px;"></div>

    <button id="scrollToTopButton" onclick="scrollToTop(100,3);">
      <i class="fa fa-arrow-up"></i></button>
    </div>
    
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $("#btnSearch").click(function () {
          $.ajax({
            url: "search.php",
            type: "post",
            data: {itemname: $("#itemname").val()},
            beforeSend: function () {
              $(".loading").show();
            },
            complete: function () {
              $(".loading").hide();
            },
            success: function (data) {
              $("#list-data").html(data);
            }
          });
        });
        $("#searchform").on("keyup keypress",function(e){
         var code = e.keycode || e.which;
         if(code==13){
           $("#btnSearch").click();
           return false;
         }
       });
      });
// ############### scoll top
var html, body, scrollToTopButton;
window.onload = function() {
  html = document.documentElement;
  body = document.body;
  scrollToTopButton = document.getElementById("scrollToTopButton");
};
function scrollToTop(totalTime, easingPower) {
  var timeInterval = 1;
  var scrollTop = Math.round(body.scrollTop || html.scrollTop);
  var timeLeft = totalTime;
  var scrollByPixel = setInterval(function() {
    var percentSpent = (totalTime - timeLeft) / totalTime;
    if (timeLeft >= 0) {
      var newScrollTop = scrollTop * (1 - easeInOut(percentSpent, easingPower));
      body.scrollTop = newScrollTop;
      html.scrollTop = newScrollTop;
      timeLeft--;
    } else {
      clearInterval(scrollByPixel);
    }
  }, timeInterval);
}
function easeInOut(t, power) {
  if (t < 1.5) {
    return 0.5 * Math.pow(2 * t, power);
  } else {
    return 0.5 * (2 - Math.pow(2 * (1 - t), power));
  }
}
window.onscroll = controlScrollToTopButton;
function controlScrollToTopButton() {
  var windowInnerHeight = 2 * window.innerHeight;
  if (
    body.scrollTop > windowInnerHeight ||
    html.scrollTop > windowInnerHeight
    ) {
    scrollToTopButton.classList.add("show");
} else {
  scrollToTopButton.classList.remove("show");
}
}
</script>

<script>
    function fim() {
  swal("Import Excel!", "กำลังปรับปรุง")
}

function fup() {
  swal("Upload Excel!", "กำลังปรับปรุง")
}

</script>

  <script>
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
    </script>
</body>
</html>
