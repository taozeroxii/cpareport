<!DOCTYPE html>
<?php
//include 'connect.php';
date_default_timezone_set('asia/bangkok');
?>
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
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="eak.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php if ((isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null)|| $_SESSION['status']!='1') {
    echo "<script>window.location ='../login.php';</script>";
  } ?>
  <div class="hmain">Patient GSB Member<sup> โรงพยาบาลเจ้าพระยาอภัยภูเบศร & ธนาคารออมสิน</sup></div>
  <div class="container ">
    <div class="row">
      <div class="col-md-12">
        <form class="form-inline" name="searchform" id="searchform">
          <div class="form-group wi">
            <label for="textsearch" ><!-- ttttt --></label>
            <input type="text" name="itemname" id="itemname" class="form-control" placeholder=" ค้นหา เลขบัตรประชชาชน หรือ ชื่อ หรือ นามสกุล || อย่างใดอย่างหนึ่ง " autocomplete="off"  autofocus/>
          </div>
          <button type="button" class="btn success" id="btnSearch" title="">
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
</body>
</html>
