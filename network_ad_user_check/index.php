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
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
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
    <script>
var countDownDate = new Date("Jul 1, 2020 24:00:00").getTime();
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("demo").innerHTML = "เหลือเวลา " + hours + " ชั่วโมง "
  + minutes + " นาที " + seconds + " วินาที ในการลงทะเบียน ";
  /*
  document.getElementById("demo").innerHTML = days + "d " + hours + " ชั่วโมง "
  + minutes + " นาที " + seconds + "วินาที ";
  */
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<style>
.cpp {
  text-align: center;
  font-size: 30px;
  margin-top: 0px;
}
.cp {
  text-align: center;
  font-size: 25px;
  margin-top: 0px;
  color: #E54703;
}
.rrar{
    color: #E54703;
    font-size: 1.4em;
}
.exp{
    font-size: 2.0em;
    font-weight: bold;
    color:#E80C20;
    text-align: center;
    cursor: pointer;
}
.exp:hover{
    font-size: 2.0em;
    font-weight: bold;
    color:green;
    text-align: center;
    cursor: pointer;
    background-color: #C7D1DA;
}
*{
    /* font-family: 'Kanit', sans-serif; */
}
</style>
</head>

<body>
    <br><br><br>
    <div class="hmain">ตรวจสอบ User ใช้งาน Authentication <sup> โรงพยาบาลเจ้าพระยาอภัยภูเบศร </sup> &nbsp;
    </div>
    <div class="cen coco">ระบบ Authentication คือ การยืนยันตัวตนในขณะที่เรากำลังใช้งานระบบใดๆ บนเครือข่ายอินเตอร์เน็ต
        ของโรงพยาบาล จุดประสงค์หลักของการ Authentication คือพิสูจน์ตัวบุคคล
        พร้อมทั้งทำการตรวจสอบสิทธิ์ว่าผู้ใช้งานระบบนั้นมีสิทธิ์ใช้ได้และเป็นเจ้าของข้อมูลเหล่านั้นจริงๆ
    </div>
    <hr>
    <div class="cen"><img src="news.png" width="50px" height="50px">
        <MARQUEE behavior=alternate direction=left scrollAmount=3 width="1%"></MARQUEE>
        <MARQUEE scrollAmount=1 direction=left width="2%">| | | | | | | | |</MARQUEE>
        <span class="fad"> การใช้งานอินเตอร์เน็ตของโรงพยาบาลจะต้องระบุตัวตนผู้ใช้งาน ตาม
            พระราชบัญญัติว่าด้วยการกระทำความผิดเกี่ยวกับคอมพิวเตอร์ </span>
        <MARQUEE scrollAmount=1 direction=right width="2%">| | | | | | | | |</MARQUEE>
        <MARQUEE behavior=alternate direction=right scrollAmount=3 width="1%"></MARQUEE>
    </div>
    <div class="cen"><span class="u"> ตรวจสอบ User ของท่านให้ตรงกับ ชื่อ - นามสกุล ของท่าน เพื่อใช้งาน Login
            เข้าใช้งานครั้งแรกด้วยรหัสผ่าน </span>
        <span class="pass" title=" P@123456 | หมายเหตุ : P = ตัวอักษรใหญ่ "> P@123456 </span><span class="u"> 
            </span> </div>
    <br>
    <div class="cen"><span class="war">   
        <!-- <span class="bspan">หากไม่พบให้ทำการ เพิ่มผู้ใช้งานใหม่</span>
            และรอการยืนยันจากผู้ดูแลระบบ ภายใน 24 ชั่วโมง </span> -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modalnote"><span
                class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;เอกสารน่ารู้ </button>
    </div>

    <div class="cen"> <span class="war">
    <!-- <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#Modalzone"><span
                class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;ตารางการเริ่มใช้งาน Authentication  </button>
                &nbsp;&nbsp;&nbsp;&nbsp; -->
    <!-- <p class="cpp" id="demo"></p> -->
    <!-- <span class="cp">หลังจากระบบปิด ถ้าท่านยังไม่ลงทะเบียนให้ติดต่อที่ศูนย์คอมพิวเตอร์</span> -->
    <!-- <span class="bb"> สิ้นสุดการลงทะเบียน</span>
    </span> -->
    </div>

    <br>
    
    <div class="exp">
        <span title="ตรวจสอบ USER ใช้งานได้ถึงวันที่ 20 สิหาคม 2563 กรุณาจดจำ ชื่อผู้ใช้งาน และ รหัสผ่าน ของท่าน ">ท่านสามารถตรวจสอบ USER ใช้งานได้ถึงวันที่ 20 สิหาคม 2563 </span>
    </div>

    <hr>
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" name="searchform" id="searchform">
                    <div class="form-group wi">
                        <label for="textsearch">
                        </label>
                        <input type="text" name="itemname" id="itemname" class="form-control"
                            placeholder=" ค้นหาด้วย ชื่อ   หรือ   นามสกุล หรือ หน่วยงาน | |  อย่างใดอย่างหนึ่ง " autocomplete="off"
                            autofocus />
                    </div>
                    <button type="button" class="btn success btn-lg" id="btnSearch" title="ระบบจะทำการปิดให้ตรวจสอบ USER ในวันที่ 20 สิงหาคม 2563 นี้">
                        <span class="glyphicon glyphicon-search"></span>
                        ตรวจสอบ
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal" title="หลังจากลงทะเบียนแล้ว รอการยืนยันเข้าใช้งานประมาณ 24 - 48 ชั่วโมง "><span
                            class="glyphicon glyphicon-user"></span> ลงทะเบียนล่าช้า </button>
                            <a href="https://cpa-hospital.watchguard.in.th:4100/" target="_blank" rel="noopener noreferrer" title="ตรวจสอบการเข้าใช้งาน Login & Logout"> <button type="button" class="btn btn-warning btn-lg" ><span
                            class="glyphicon glyphicon-off"></span> ออกจากระบบ </button></a>
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

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="	glyphicon glyphicon-lock"></span> กรุณากรอกข้อมูล ให้ถูกต้อง
                        ครบถ้วน </h4>
                        <center><div class="rrar">ลงทะเบียนล่าช้า </div></center>
                </div>
              
                <div class="modal-body">
                    <form action="#" id="form_add" name="form_add">
                        <div class="form-group">
                            <label for="firstname"><span class="glyphicon glyphicon-user"> ชื่อ:</label>
                            <input type="text" class="form-control" id="firstname" placeholder="ชื่อจริง..."
                                name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname"><span class="glyphicon glyphicon-user"> นามสกุล:</label>
                            <input type="text" class="form-control" id="lastname" placeholder="นามสกุลจริง..."
                                name="lastname">
                        </div>
                        <div class="form-group">
                            <label for="email"> <span class="glyphicon glyphicon-envelope"> Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="อีเมล์..." name="email"
                                onblur="check_email(this)">
                        </div>
                        <div class="form-group">
                            <label for="department"> <span class="glyphicon glyphicon-home"> หน่วยงาน:</label>
                            <input type="text" class="form-control" id="department" placeholder="หน่วยงาน..."
                                name="department">
                        </div>
                        <div class="form-group">
                            <label for="telephone"> <span class="glyphicon glyphicon-phone"> เบอร์มือถือ:</label>
                            <input type="text" class="form-control" id="telephone" placeholder="เบอร์มือถือ..."
                                name="telephone"
                                onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
                        </div>
                        <div class="form-group">
                            <label for="jobtitle"><span class="glyphicon glyphicon-stats"> ตำแหน่ง:</label>
                            <input type="text" class="form-control" id="jobtitle" placeholder="ตำแหน่ง..."
                                name="jobtitle">
                        </div>
                        <br>
                        <center><button type="submit" id="submit" class="btn btn-danger btn-lg"> <span
                                    class="glyphicon glyphicon-floppy-disk"> บันทึก</button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"> <span
                                    class="glyphicon glyphicon-off"> ยกเลิก</button>
                        </center>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title bb "><span class="glyphicon glyphicon-lock"></span> Time Expire สิ้นสุดการลงทะเบียน
                         </h4>
                </div>
                <div class="modal-body">
                <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@700&display=swap" rel="stylesheet">
    <style>
        .bb {
            text-align: center;
            color: crimson;
            font-weight: bold;
            font-size: 2.4em;
            font-family: 'Prompt', sans-serif;
            ;
        } 
        .cc {
            text-align: center;
            color: #169921;
            font-size: 1.4em;
            font-family: 'Prompt', sans-serif;
        }

        .hhh {
            text-align: center;
            color: #E70910;
            font-size: 1.4em;
            font-family: 'Prompt', sans-serif;
        }

        
    </style>


    <div><center><img src="img/exp.png" alt=""></center></div>
    <div class="bb"> </div>
    <br>
    <div class="cc"> สำหรับผู้ที่ไม่มีรายชื่อในระบบ หรือลงทะเบียนไม่ทันตามเวลาที่กำหนด</div>
    <div class="cc"> กรุณาติดต่อศูนย์คอมพิวเตอร์ โทร 3148 </div>
</body>
<div class="cc"> ระหว่างวันที่ 8 - 10 กรกฎาคม 2563 </div>
<div><center><img src="img/gg.gif" alt="" width="40px" height="40px"></center></div>
<hr>

                </div>
            </div>

        </div>
    </div> -->



    <div id="Modalzone" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">ตารางการเริ่มใช้งาน Authentication</h4>
            </div>
            <div class="modal-body" id="">
            <img src="" alt="">
                <!-- <table class="tt">
                    <tr class="ttr">
                        <td>V2020</td>
                        <td>20</td>
                        <td>อาคารเฉลิมพระเกียรติฯ</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2022 </td>
                        <td>22</td>
                        <td>อาคารชวนโปรดทิพย์</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2024</td>
                        <td>24</td>
                        <td>อาคารสุวัทนา</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2025</td>
                        <td>25</td>
                        <td>อาคาร สูติกรรมพิเศษ 114เตียง</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2026 </td>
                        <td>26</td>
                        <td>อาคารแผนไทย</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2027 </td>
                        <td>27</td>
                        <td>อาคารอาชีวะ อาชีวเวชกรรม</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2028 </td>
                        <td>28</td>
                        <td>อาคาร 75 ปี</td>
                    </tr>
                    <tr class="ttr">
                        <td> V2029 </td>
                        <td>29</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2031 </td>
                        <td>31</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2032 </td>
                        <td>32</td>
                        <td>อาคารอุติเหตุฉุกเฉิน</td>
                    </tr>
                    <tr class="ttr">
                        <td> V2036 </td>
                        <td>36</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2043 </td>
                        <td>43</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2044</td>
                        <td>44</td>
                        <td>อาคาร สูติกรรมเก่า เพชรัตน์-สุวัทนา</td>
                    </tr>
                </table> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    </div>




    <div id="Modalnote" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title "><span class="glyphicon glyphicon-hand-right"></span> เอกสารที่เกี่ยวข้อง
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="heand" onclick="openWin1()"><span class="war heand"><span
                                class="glyphicon glyphicon-paperclip"></span>
                            หลักเกณฑ์การเก็บรักษาข้อมูลจราจรทางคอมพิวเตอร์ของผู้ให้บริการพ.ศ. ๒๕๕๐ </span></div>
                    <br>
                    <div class="heand" onclick="openWin2()"><span class="war heand"><span
                                class="glyphicon glyphicon-paperclip"></span>
                            พระราชบัญญัติว่าด้วยการกระทําความผิดเกี่ยวกับคอมพิวเตอร์พ.ศ. ๒๕๕๐</span></div>
                    <br>
                    <div class="heand" onclick="openWin3()"><span class="war heand"> <span
                                class="glyphicon glyphicon-paperclip"></span> พระราชบัญญัติ
                            ว่าด้วยการกระทําความผิดเกี่ยวกับคอมพิวเตอร์ (ฉบับที่ ๒)พ.ศ. ๒๕๖๐</span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>

        </div>
    </div>
    <script>
    function openWin1() {
        window.open("img/law-computer2.pdf", "_blank",
            "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=600,height=800");
    }

    function openWin2() {
        window.open("img/law-comter1.pdf", "_blank",
            "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=600,height=800");
    }

    function openWin3() {
        window.open("img/LAW-PRB.pdf", "_blank",
            "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=600,height=800");
    }
    </script>
</body>

</html>