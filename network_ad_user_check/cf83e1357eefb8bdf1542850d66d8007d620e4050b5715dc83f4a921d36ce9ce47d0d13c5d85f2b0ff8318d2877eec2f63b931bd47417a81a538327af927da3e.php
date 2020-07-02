<?php
date_default_timezone_set('asia/bangkok');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Active Directory Users and Computers |</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="eak.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
var countDownDate = new Date("Sep 30, 2020 24:00:00").getTime();
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("demo").innerHTML =  " คงเหลือเวลาอีกแค่ " + days + " วัน "  + hours + " ชั่วโมง "
  + minutes + " นาที " + seconds + " วินาที แล้วสินะ สู้ ๆ ";
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
body{
    cursor: pointer;
}
        .bb {
            text-align: center;
            color: #fff;
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
</head>
<body title="รูดเมาส์ดิ">
    <div class="cen"> <span class="war">
    <p class="cpp" id="demo"></p>
    <span class="bb" title="รูดเมาส์ดิ"> ต้องฉลอง หลังงานเกษียณกันสักหน่อย 5555 </span>
    </span>
    </div>
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
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