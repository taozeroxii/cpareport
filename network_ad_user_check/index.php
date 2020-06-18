<?php
date_default_timezone_set('asia/bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- https://www.formget.com/submit-form-using-ajax-php-and-jquery/ -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Active Directory Users and Computers |</title>
  <!-- <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet"> -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="eak.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="add_ajax_script.js"></script>
  <script type='text/javascript'>
    function check_email(elm) {
      var regex_email = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
      if (!elm.value.match(regex_email)) {
        alert('กรุณาตรวจสอบ Email ให้ถูกต้อง');
      } else {
        //alert('you email true');
      }
    }
  </script>
</head>

<body>
  <br><br><br>
  <div class="hmain">ตรวจสอบ User ใช้งาน Authentication <sup> โรงพยาบาลเจ้าพระยาอภัยภูเบศร </sup> &nbsp;
  </div>
    <div class="cen coco">ระบบ Authentication คือ การยืนยันตัวตนในขณะที่เรากำลังใช้งานระบบใดๆ บนเครือข่ายอินเตอร์เน็ต ของโรงพยาบาล จุดประสงค์หลักของการ Authentication คือพิสูจน์ตัวบุคคล พร้อมทั้งทำการตรวจสอบสิทธิ์ว่าผู้ใช้งานระบบนั้นมีสิทธิ์ใช้ได้และเป็นเจ้าของข้อมูลเหล่านั้นจริงๆ
  </div>
  <hr>
  <div class="cen"><img src="news.png" width="50px" height="50px">
    <MARQUEE behavior=alternate direction=left scrollAmount=3 width="1%"></MARQUEE>
    <MARQUEE scrollAmount=1 direction=left width="2%">| | | | | | | | |</MARQUEE>
    <span class="fad"> การใช้งานอินเตอร์เน็ตของโรงพยาบาลจะต้องระบุตัวตนผู้ใช้งาน ตาม พระราชบัญญัติว่าด้วยการกระทำความผิดเกี่ยวกับคอมพิวเตอร์ </span>
    <MARQUEE scrollAmount=1 direction=right width="2%">| | | | | | | | |</MARQUEE>
    <MARQUEE behavior=alternate direction=right scrollAmount=3 width="1%"></MARQUEE>
  </div>
  <div class="cen"><span class="u"> ตรวจสอบ User ของท่านให้ตรงกับ ชื่อ - นามสกุล ของท่าน เพื่อใช้งาน Login เข้าใช้งานครั้งแรกด้วยรหัสผ่าน </span>
    <span class="pass" title=" P@123456 | หมายเหตุ : P = ตัวอักษรใหญ่ "> P@123456 </span><span class="u"> หลักจาก เข้าสู่ระบบแล้วให้ทำการเปลี่ยนรหัสผ่านทันที</span> </div>
  <br>
  <div class="cen"><span class="war"> ตรวจสอบข้อมูล หากไม่พบให้ทำการ <span class="bspan">เพิ่มผู้ใช้งานใหม่</span> และรอการยืนยันจากผู้ดูแลระบบ ภายใน 24 ชั่วโมง </span>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modalnote"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;เอกสารน่ารู้ </button>
  </div>
  <hr>
  <div class="container ">
    <div class="row">
      <div class="col-md-12">
        <form class="form-inline" name="searchform" id="searchform">
          <div class="form-group wi">
            <label for="textsearch">
            </label>
            <input type="text" name="itemname" id="itemname" class="form-control" placeholder=" ค้นหา  ชื่อ หรือ นามสกุล || อย่างใดอย่างหนึ่ง " autocomplete="off" autofocus />
          </div>
          <button type="button" class="btn success btn-lg" id="btnSearch" title="">
            <span class="glyphicon glyphicon-search"></span>
            ตรวจสอบ
          </button>
          &nbsp;
          <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> เพิ่มผู้ใช้งานใหม่ </button>
        </form>
      </div>
    </div>
    <center>
      <div class="loading">&nbsp;</div>
    </center>
    <div class="row" id="list-data" style="margin-top: 10px;"></div>
    <button id="scrollToTopButton" onclick="scrollToTop(100,3);">
      <i class="fa fa-arrow-up"></i></button>
  </div>
  <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $("#btnSearch").click(function() {
        $.ajax({
          url: "search.php",
          type: "post",
          data: {
            itemname: $("#itemname").val()
          },
          beforeSend: function() {
            $(".loading").show();
          },
          complete: function() {
            $(".loading").hide();
          },
          success: function(data) {
            $("#list-data").html(data);
          }
        });
      });
      $("#searchform").on("keyup keypress", function(e) {
        var code = e.keycode || e.which;
        if (code == 13) {
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

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="	glyphicon glyphicon-lock"></span> กรุณากรอกข้อมูล ให้ถูกต้อง ครบถ้วน </h4>
        </div>
        <!-- <h4 class="modal-title"> <?php //echo   $resultmax['maxid']; 
                                      ?></h4>      -->
        <div class="modal-body">
          <form action="#" id="form_add" name="form_add">
            <div class="form-group">
              <label for="firstname"><span class="glyphicon glyphicon-user"> ชื่อ:</label>
              <input type="text" class="form-control" id="firstname" placeholder="ชื่อจริง..." name="firstname">
            </div>
            <div class="form-group">
              <label for="lastname"><span class="glyphicon glyphicon-user"> นามสกุล:</label>
              <input type="text" class="form-control" id="lastname" placeholder="นามสกุลจริง..." name="lastname">
            </div>
            <div class="form-group">
              <label for="email"> <span class="glyphicon glyphicon-envelope"> Email:</label>
              <input type="email" class="form-control" id="email" placeholder="อีเมล์..." name="email" onblur="check_email(this)">
            </div>
            <div class="form-group">
              <label for="department"> <span class="glyphicon glyphicon-home"> หน่วยงาน:</label>
              <input type="text" class="form-control" id="department" placeholder="หน่วยงาน..." name="department">
            </div>
            <div class="form-group">
              <label for="telephone"> <span class="glyphicon glyphicon-phone"> เบอร์มือถือ:</label>
              <input type="text" class="form-control" id="telephone" placeholder="เบอร์มือถือ..." name="telephone" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
            </div>
            <div class="form-group">
              <label for="jobtitle"><span class="glyphicon glyphicon-stats"> ตำแหน่ง:</label>
              <input type="text" class="form-control" id="jobtitle" placeholder="ตำแหน่ง..." name="jobtitle">
            </div>
            <br>
            <center><button type="submit" id="submit" class="btn btn-danger btn-lg"> <span class="glyphicon glyphicon-floppy-disk"> บันทึก</button>&nbsp;&nbsp;
              <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"> <span class="glyphicon glyphicon-off"> ยกเลิก</button>
            </center>
          </form>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>

    </div>
  </div>


  <div id="Modalnote" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-hand-right"></span> เอกสารที่เกี่ยวข้อง </h4>
        </div>
        <div class="modal-body">

          <div class="heand" onclick="openWin1()"><span class="war heand"><span class="glyphicon glyphicon-paperclip"></span> หลักเกณฑ์การเก็บรักษาข้อมูลจราจรทางคอมพิวเตอร์ของผู้ให้บริการพ.ศ. ๒๕๕๐ </span></div>
          <br>
          <div class="heand" onclick="openWin2()"><span class="war heand"><span class="glyphicon glyphicon-paperclip"></span> พระราชบัญญัติว่าด้วยการกระทําความผิดเกี่ยวกับคอมพิวเตอร์พ.ศ. ๒๕๕๐</span></div>
          <br>
          <div class="heand" onclick="openWin3()"><span class="war heand"> <span class="glyphicon glyphicon-paperclip"></span> พระราชบัญญัติ ว่าด้วยการกระทําความผิดเกี่ยวกับคอมพิวเตอร์ (ฉบับที่ ๒)พ.ศ. ๒๕๖๐</span></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
      </div>

    </div>
  </div>
  <script>
    function openWin1() {
      window.open("img/law-computer2.pdf", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=600,height=800");
    }
    function openWin2() {
      window.open("img/law-comter1.pdf", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=600,height=800");
    }
    function openWin3() {
      window.open("img/LAW-PRB.pdf", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=600,height=800");
    }
  </script>
</body>

</html>